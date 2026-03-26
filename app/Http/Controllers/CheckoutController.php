<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Show checkout page
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

    // Process checkout
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_postal_code' => 'nullable|string',
            'shipping_phone' => 'required|string',
            'notes' => 'nullable|string',
            'payment_method' => 'required|in:cod,gcash'
        ]);

        $cartItems = CartItem::where('user_id', Auth::id())
                             ->with('product')
                             ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Check stock availability
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->with('error', "Not enough stock for {$item->product->name}. Only {$item->product->stock} available.");
            }
        }

        DB::beginTransaction();

        try {
            // Calculate total
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $total,
                'status' => $request->payment_method === 'gcash' ? 'awaiting_payment' : 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'gcash' ? 'pending' : 'unpaid',
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_phone' => $request->shipping_phone,
                'notes' => $request->notes
            ]);

            // Create order items and update stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);

                // Update product stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            CartItem::where('user_id', Auth::id())->delete();

            DB::commit();

            // If GCash, redirect to payment page
            if ($request->payment_method === 'gcash') {
                return redirect()->route('payment.gcash', $order)
                    ->with('success', 'Order created! Please complete payment.');
            }

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully! Order #: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // GCash Payment Page
    public function gcashPayment(Order $order)
    {
        // Make sure order belongs to user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('payment.gcash', compact('order'));
    }

    // Verify GCash Payment
    public function verifyPayment(Request $request, Order $order)
    {
        $request->validate([
            'reference_number' => 'required|string',
            'payment_screenshot' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Save payment proof
        $path = $request->file('payment_screenshot')->store('payment_proofs', 'public');

        // Update order
        $order->update([
            'payment_status' => 'awaiting_verification',
            'payment_reference' => $request->reference_number,
            'payment_proof' => $path
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Payment proof submitted! We will verify your payment soon.');
    }
}