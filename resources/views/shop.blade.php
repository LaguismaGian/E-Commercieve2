<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Shop Candles</h1>
        <p class="mt-2 text-lg">Find the perfect scent for your space</p>
    </header>

    <!-- Navigation -->
    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 font-semibold hover:text-orange-500">Home</a>
            <a href="/about" class="text-gray-800 font-semibold hover:text-orange-500">About</a>
            <a href="/shop" class="text-gray-800 font-semibold hover:text-orange-500">Shop</a>
            <a href="/contact" class="text-gray-800 font-semibold hover:text-orange-500">Contact</a>
            <a href="/cart" class="text-gray-800 font-semibold hover:text-orange-500">Cart</a>
        </div>
        
        @auth
            <div class="flex items-center space-x-4">
                <!-- Admin Panel Button in Navigation -->
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.products.index') }}" class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 text-sm">
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

    <!-- Welcome Message for Logged-in Users -->
    @auth
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 mx-6 mt-4 rounded-lg">
        <p class="text-lg">
            🎉 Welcome back, <strong>{{ Auth::user()->name }}</strong>! 
            Ready to find your next favorite candle? ✨
        </p>
    </div>
    @endauth

    <!-- Admin Quick Actions (only visible to admin) -->
    @auth
        @if(Auth::user()->isAdmin())
            <div class="flex justify-center gap-4 mt-4">
                <a href="{{ route('admin.products.create') }}" 
                   class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-semibold shadow-md">
                    ➕ Add New Product
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 font-semibold shadow-md">
                    📋 View All Products
                </a>
            </div>
        @endif
    @endauth

    <!-- Shop Products -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-md text-center p-4 hover:shadow-lg transition duration-300">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover rounded-md">
                @else
                    <div class="w-full h-48 bg-gray-200 rounded-md flex items-center justify-center text-4xl">
                        🕯️
                    </div>
                @endif
                
                <h3 class="mt-3 font-bold text-lg">{{ $product->name }}</h3>
                <p class="text-gray-600 mt-1 text-sm">{{ Str::limit($product->description, 60) }}</p>
                
                @if($product->category)
                    <p class="text-gray-400 text-xs mt-1">{{ $product->category }}</p>
                @endif
                
                <span class="text-orange-500 font-semibold mt-2 block text-xl">${{ number_format($product->price, 2) }}</span>
                
                @if($product->stock > 0)
                    <p class="text-green-500 text-xs mt-1">✓ In Stock ({{ $product->stock }} available)</p>
                @else
                    <p class="text-red-500 text-xs mt-1">✗ Out of Stock</p>
                @endif
                
                <a href="#" 
                   class="inline-block mt-3 px-4 py-2 {{ $product->stock > 0 ? 'bg-orange-500 hover:bg-orange-600' : 'bg-gray-400 cursor-not-allowed' }} text-white rounded font-semibold w-full">
                    {{ $product->stock > 0 ? 'Buy Now' : 'Out of Stock' }}
                </a>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No products available yet. Check back soon!</p>
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.products.create') }}" class="inline-block mt-4 bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">
                            + Add Your First Product
                        </a>
                    @endif
                @endauth
            </div>
        @endforelse
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-6">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html>