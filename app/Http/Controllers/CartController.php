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
        // Get the quantity and scent from the form
        $requestedQuantity = (int) $request->input('quantity', 1);
        $selectedScent = $request->input('scent', 'Default');
    
        if ($product->stock <= 0) {
            return back()->with('error', 'This product is out of stock!');
        }
    
        // Check for existing item with the same product AND scent
        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->where('scent', $selectedScent) // Ensure scent matching
                            ->first();
    
        if ($cartItem) {
            // 3. Check if current cart + new request exceeds stock
            if ($cartItem->quantity + $requestedQuantity > $product->stock) {
                return back()->with('error', 'Cannot add more. Only ' . $product->stock . ' available!');
            }
            
            $cartItem->quantity += $requestedQuantity;
            $cartItem->save();
            $message = "Added {$requestedQuantity} more " . $product->name . " ({$selectedScent}) to your collection!";
        } else {
            // 4. Double check stock for new entries
            if ($requestedQuantity > $product->stock) {
                return back()->with('error', 'Only ' . $product->stock . ' in stock!');
            }
    
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $requestedQuantity,
                'scent' => $selectedScent,
            ]);
            $message = "{$requestedQuantity}x " . $product->name . " added to your collection!";
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

    // Remove item from cart
    public function remove(CartItem $cartItem)
    {
        // Security check: Ensure the item belongs to the logged-in user
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }
    
        $productName = $cartItem->product->name;
        $cartItem->delete();
    
        return redirect()->route('cart.index')->with('success', $productName . ' removed from your collection.');
    }

    // Clear entire cart
    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();
        
        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}