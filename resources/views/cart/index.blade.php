<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Your Shopping Cart</h1>
        <p class="mt-2 text-lg">Review your items before checkout</p>
    </header>

    <!-- Navigation with Cart Counter -->
    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 hover:text-orange-500 font-semibold">Home</a>
            <a href="/about" class="text-gray-800 hover:text-orange-500 font-semibold">About</a>
            <a href="/shop" class="text-gray-800 hover:text-orange-500 font-semibold">Shop</a>
            <a href="/contact" class="text-gray-800 hover:text-orange-500 font-semibold">Contact</a>
            <a href="/cart" class="text-orange-500 font-semibold relative">
                🛒 Cart
                @auth
                    @php $totalQuantity = Auth::user()->cartItems->sum('quantity'); @endphp
                    @if($totalQuantity > 0)
                        <span class="absolute -top-2 -right-4 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $totalQuantity }}
                        </span>
                    @endif
                @endauth
            </a>
        </div>
        
        @auth
            <div class="flex items-center space-x-4">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.products.index') }}" class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700">
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
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                ❌ {{ session('error') }}
            </div>
        @endif

        @if($cartItems->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-4 text-left">Product</th>
                            <th class="p-4 text-left">Price</th>
                            <th class="p-4 text-left">Quantity</th>
                            <th class="p-4 text-left">Subtotal</th>
                            <th class="p-4 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">
                                <div class="flex items-center space-x-3">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-12 h-12 object-cover rounded">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-2xl">🕯️</div>
                                    @endif
                                    <span class="font-semibold">{{ $item->product->name }}</span>
                                </div>
                             </td>
                            <td class="p-4">${{ number_format($item->product->price, 2) }}</td>
                            <td class="p-4">
                                <!-- Quantity with + and - buttons -->
                                <div class="flex items-center space-x-2">
                                    <!-- Decrease Quantity Button -->
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                        <button type="submit" 
                                                class="w-8 h-8 bg-gray-200 rounded-full hover:bg-gray-300 font-bold text-lg flex items-center justify-center"
                                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            -
                                        </button>
                                    </form>
                                    
                                    <!-- Current Quantity Display -->
                                    <span class="w-10 text-center font-semibold text-lg">{{ $item->quantity }}</span>
                                    
                                    <!-- Increase Quantity Button -->
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                        <button type="submit" 
                                                class="w-8 h-8 bg-gray-200 rounded-full hover:bg-gray-300 font-bold text-lg flex items-center justify-center"
                                                {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                            +
                                        </button>
                                    </form>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Stock: {{ $item->product->stock }}</p>
                             </td>
                            <td class="p-4 font-semibold">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <td class="p-4">
                                <!-- Remove Item Form -->
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                        Remove
                                    </button>
                                </form>
                             </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <div>
                        <p class="text-lg font-semibold">Total: <span class="text-orange-500 text-2xl">${{ number_format($total, 2) }}</span></p>
                        <p class="text-sm text-gray-500 mt-1">Shipping calculated at checkout</p>
                    </div>
                    <div class="flex space-x-3">
                        <!-- Clear Cart Form -->
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 font-semibold" 
                                    onclick="return confirm('Clear your entire cart?')">
                                Clear Cart
                            </button>
                        </form>
                        <a href="/shop" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 font-semibold">
                            Continue Shopping
                        </a>
                        <a href="{{ route('checkout.index') }}" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 font-semibold">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🛒</div>
                <p class="text-gray-500 text-lg">Your cart is empty</p>
                <a href="/shop" class="inline-block mt-4 bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 font-semibold">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>

    <script>
        // Auto-hide success/error messages after 3 seconds
        setTimeout(function() {
            let messages = document.querySelectorAll('.bg-green-100, .bg-red-100');
            messages.forEach(function(message) {
                message.style.display = 'none';
            });
        }, 3000);
    </script>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-12">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html>