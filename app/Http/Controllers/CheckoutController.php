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
    public function index(Request $request)
    {
        // NEW: Grab the selected items from the URL
        $selectedItems = $request->input('selected_items');

        // NEW: Security check - if they bypassed the cart page
        if (!$selectedItems || !is_array($selectedItems)) {
            return redirect()->route('cart.index')->with('error', 'Please select at least one item to checkout.');
        }

        // NEW: Fetch ONLY the cart items they selected
        $cartItems = CartItem::where('user_id', Auth::id())
                             ->whereIn('id', $selectedItems)
                             ->with('product')
                             ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Invalid items selected.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // NEW: We must pass $selectedItems to the view so the form can remember them
        return view('checkout.index', compact('cartItems', 'total', 'selectedItems'));
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
            'payment_method'   => 'required|in:cod,gcash',
            'selected_items'   => 'required|array' // NEW: Validate selected items exist
        ]);

        // NEW: Fetch ONLY the selected items
        $cartItems = CartItem::where('user_id', Auth::id())
                             ->whereIn('id', $request->selected_items)
                             ->with('product')
                             ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your selected items are invalid!');
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
                'selected_items' => $request->selected_items, // NEW: Remember selected items in session
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
                'payment_status'    => 'unpaid',
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

            // 3. Clear ONLY the checked out items from the Cart (CRITICAL FIX)
            CartItem::where('user_id', Auth::id())
                    ->whereIn('id', $request->selected_items)
                    ->delete();

            DB::commit();

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

        // NEW: Fetch ONLY the selected items from the session data
        $cartItems = CartItem::where('user_id', Auth::id())
                             ->whereIn('id', $checkoutData['selected_items'])
                             ->with('product')
                             ->get();

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
            // NEW: Fetch ONLY the selected items from session
            $cartItems = CartItem::where('user_id', Auth::id())
                                 ->whereIn('id', $checkoutData['selected_items'])
                                 ->with('product')
                                 ->get();

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
                'payment_proof'     => $filename, 
                'shipping_address'  => $checkoutData['shipping_data']['shipping_address'],
                'shipping_city'     => $checkoutData['shipping_data']['shipping_city'],
                'shipping_phone'    => $checkoutData['shipping_data']['shipping_phone'],
                'notes'             => $checkoutData['shipping_data']['notes'] ?? null,
            ]);

            // orderItems and reduce Stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price
                ]);
                $item->product->decrement('stock', $item->quantity);
            }

            // Cleanup: Delete ONLY checked out items
            CartItem::where('user_id', Auth::id())
                    ->whereIn('id', $checkoutData['selected_items'])
                    ->delete();
                    
            session()->forget('pending_checkout');

            DB::commit(); 

            return redirect()->route('orders.show', $order)->with('success', 'Payment proof submitted!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }
}