<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page (Shipping Address Form)
     */
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
                             ->with('product')
                             ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Step 1: Handle Form Submission (Splits GCash and COD logic)
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_city'    => 'required|string',
            'shipping_phone'   => 'required|string',
            'payment_method'   => 'required|in:cod,gcash'
        ]);

        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // ==========================================
        // FLOW 1: GCASH (Save to Session, redirect to QR)
        // ==========================================
        if ($request->payment_method === 'gcash') {
            session(['pending_checkout' => [
                'shipping_data'  => $request->only(['shipping_address', 'shipping_city', 'shipping_phone', 'notes']),
                'payment_method' => 'gcash',
                'total_amount'   => $total,
                'order_number'   => 'ORD-' . strtoupper(uniqid()),
            ]]);

            return redirect()->route('payment.gcash');
        }

        // ==========================================
        // FLOW 2: CASH ON DELIVERY (Immediate DB Commit)
        // ==========================================
        DB::beginTransaction();

        try {
            // Final Stock Check
            foreach ($cartItems as $item) {
                $product = Product::lockForUpdate()->find($item->product_id);
                if ($item->quantity > $product->stock) {
                    throw new \Exception("Sorry, {$product->name} just went out of stock!");
                }
            }

            // 1. Create the Order directly in DB
            $order = Order::create([
                'user_id'           => Auth::id(),
                'order_number'      => 'ORD-' . strtoupper(uniqid()),
                'total_amount'      => $total,
                'status'            => 'pending',
                'payment_method'    => 'cod',
                'payment_status'    => 'unpaid', // Remains unpaid until delivery
                'shipping_address'  => $request->shipping_address,
                'shipping_city'     => $request->shipping_city,
                'shipping_phone'    => $request->shipping_phone,
                'notes'             => $request->notes ?? null,
            ]);

            // 2. Create OrderItems & Reduce Stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price
                ]);
                
                $item->product->decrement('stock', $item->quantity);
            }

            // 3. Clear the Cart
            CartItem::where('user_id', Auth::id())->delete();

            DB::commit();

            // Redirect straight to order receipt
            return redirect()->route('orders.show', $order)
                             ->with('success', 'Order placed successfully! Please prepare exact cash for delivery.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Step 2: Show GCash Page (Pull from Session)
     */
    public function gcashPayment()
    {
        $checkoutData = session('pending_checkout');

        if (!$checkoutData) {
            return redirect()->route('cart.index')->with('error', 'Session expired. Please start over.');
        }

        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();

        return view('payment.gcash', compact('checkoutData', 'cartItems'));
    }

    /**
     * Step 3: THE FINAL GCASH COMMIT (Verify payment and create DB record)
     */
    public function verifyPayment(Request $request)
    {
        $checkoutData = session('pending_checkout');

        if (!$checkoutData) {
            return redirect()->route('cart.index')->with('error', 'Session expired.');
        }

        $request->validate([
            'reference_number'   => 'required|string',
            'payment_screenshot' => 'required|image|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();

            // Final Stock Check with Row Locking
            foreach ($cartItems as $item) {
                $product = Product::lockForUpdate()->find($item->product_id);
                if ($item->quantity > $product->stock) {
                    throw new \Exception("Sorry, {$product->name} just went out of stock!");
                }
            }

            $file = $request->file('payment_screenshot');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/payments'), $filename);
            
            $order = Order::create([
                'user_id'           => Auth::id(),
                'order_number'      => $checkoutData['order_number'],
                'total_amount'      => $checkoutData['total_amount'],
                'status'            => 'pending',
                'payment_method'    => 'gcash',
                'payment_status'    => 'awaiting_verification',
                'payment_reference' => $request->reference_number,
                'payment_proof'     => $filename, // <--- Just the filename here!
                'shipping_address'  => $checkoutData['shipping_data']['shipping_address'],
                'shipping_city'     => $checkoutData['shipping_data']['shipping_city'],
                'shipping_phone'    => $checkoutData['shipping_data']['shipping_phone'],
                'notes'             => $checkoutData['shipping_data']['notes'] ?? null,
            ]);

            // 2. Create OrderItems & Reduce Stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price
                ]);
                $item->product->decrement('stock', $item->quantity);
            }

            // 3. Cleanup
            CartItem::where('user_id', Auth::id())->delete();
            session()->forget('pending_checkout');

            DB::commit(); 

            return redirect()->route('orders.show', $order)->with('success', 'Payment proof submitted!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }
}