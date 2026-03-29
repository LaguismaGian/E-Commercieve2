<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Checkout</h1>
        <p class="mt-2 text-lg">Complete your order</p>
    </header>

    <!-- Navigation -->
    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 hover:text-orange-500 font-semibold">Home</a>
            <a href="/shop" class="text-gray-800 hover:text-orange-500 font-semibold">Shop</a>
            <a href="/cart" class="text-gray-800 hover:text-orange-500 font-semibold">Cart</a>
        </div>
        
        @auth
            <div class="flex items-center space-x-4">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.products.index') }}" class="bg-purple-600 text-white px-3 py-1 rounded text-sm">
                        📋 Manage Products
                    </a>
                @endif
                <a href="/profile" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 font-semibold">
                    👤 My Profile
                </a>
                <span class="text-gray-700">Welcome, {{ Auth::user()->name }}! 👋</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <a href="/login" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold">Sign In</a>
        @endauth
    </nav>

    <div class="container mx-auto px-6 py-8">
        <!-- Error Messages -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Summary - Left Column -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold mb-4 border-b pb-2">Order Summary</h2>
                    
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($cartItems as $item)
                        <div class="flex justify-between items-center border-b pb-2">
                            <div class="flex-1">
                                <p class="font-semibold">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                            </div>
                            <p class="font-semibold">₱{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-4 pt-4 border-t">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total:</span>
                            <span class="text-orange-500 text-xl">₱{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Form - Right Column -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Shipping Information</h2>
                    
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Street Address *</label>
                                <input type="text" 
                                       name="shipping_address" 
                                       value="{{ old('shipping_address') }}" 
                                       required
                                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                                       placeholder="123 Main St, Barangay, City">
                                @error('shipping_address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">City *</label>
                                <input type="text" 
                                       name="shipping_city" 
                                       value="{{ old('shipping_city') }}" 
                                       required
                                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                                       placeholder="Manila">
                                @error('shipping_city')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Postal Code</label>
                                <input type="text" 
                                       name="shipping_postal_code" 
                                       value="{{ old('shipping_postal_code') }}"
                                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                                       placeholder="1000">
                                @error('shipping_postal_code')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Phone Number *</label>
                                <input type="tel" 
                                       name="shipping_phone" 
                                       value="{{ old('shipping_phone') }}" 
                                       required
                                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                                       placeholder="09123456789">
                                @error('shipping_phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Order Notes (Optional)</label>
                                <textarea name="notes" 
                                          rows="3" 
                                          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                                          placeholder="Special instructions, delivery notes, etc.">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Payment Method *</label>
                                <div class="space-y-2">
                                    <label class="flex items-center space-x-3 p-2 border rounded cursor-pointer hover:bg-gray-50">
                                        <input type="radio" 
                                               name="payment_method" 
                                               value="gcash" 
                                               checked 
                                               class="w-4 h-4 text-orange-500">
                                        <span class="font-medium">GCash</span>
                                        <span class="text-sm text-gray-500 ml-auto">Pay via GCash QR Code</span>
                                    </label>
                                    <label class="flex items-center space-x-3 p-2 border rounded cursor-pointer hover:bg-gray-50">
                                        <input type="radio" 
                                               name="payment_method" 
                                               value="cod" 
                                               class="w-4 h-4 text-orange-500">
                                        <span class="font-medium">Cash on Delivery (COD)</span>
                                        <span class="text-sm text-gray-500 ml-auto">Pay when you receive</span>
                                    </label>
                                </div>
                                @error('payment_method')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="flex gap-3 mt-6 pt-4 border-t">
                            <a href="{{ route('cart.index') }}" 
                               class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 font-semibold">
                                ← Back to Cart
                            </a>
                            <button type="submit" 
                                    class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 font-semibold flex-1">
                                Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-12">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html>