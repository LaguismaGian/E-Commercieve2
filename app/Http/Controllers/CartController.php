<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
                             ->with('product')
                             ->get();
        
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Add item to cart
    public function add(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return back()->with('error', 'This product is out of stock!');
        }

        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // Check if adding one more exceeds stock
            if ($cartItem->quantity + 1 > $product->stock) {
                return back()->with('error', 'Cannot add more. Only ' . $product->stock . ' in stock!');
            }
            $cartItem->quantity += 1;
            $cartItem->save();
            $message = 'Added another ' . $product->name . ' to cart!';
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
            $message = $product->name . ' added to cart!';
        }

        return back()->with('success', $message);
    }

    // Update quantity
    public function update(Request $request, CartItem $cartItem)
    {
        // Check if cart item belongs to logged-in user
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $newQuantity = $request->quantity;
        
        // Validate quantity
        if ($newQuantity < 1) {
            return redirect()->route('cart.index')->with('error', 'Quantity cannot be less than 1.');
        }
        
        if ($newQuantity > $cartItem->product->stock) {
            return redirect()->route('cart.index')->with('error', 'Only ' . $cartItem->product->stock . ' items available in stock.');
        }

        $cartItem->update(['quantity' => $newQuantity]);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    // Clear entire cart
    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();
        
        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}