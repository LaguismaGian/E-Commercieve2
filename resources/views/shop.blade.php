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

    <!-- Navigation - UPDATED with authentication logic -->
    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 font-semibold hover:text-orange-500">Home</a>
            <a href="/about" class="text-gray-800 font-semibold hover:text-orange-500">About</a>
            <a href="/shop" class="text-gray-800 font-semibold hover:text-orange-500">Shop</a>
            <a href="/contact" class="text-gray-800 font-semibold hover:text-orange-500">Contact</a>
        </div>
        
        <!-- ========== AUTHENTICATION LOGIC ========== -->
        <!-- Shows different buttons based on login status -->
        @auth
            <div class="flex items-center space-x-4">
                <!-- Profile button - links to user profile page -->
                <a href="/profile" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 font-semibold transition duration-300">
                    👤 My Profile
                </a>
                <!-- Welcome message with user's name -->
                <span class="text-gray-700">Welcome, {{ Auth::user()->name }}! 👋</span>
                <!-- Logout form -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <!-- Show Sign In button for guests (not logged in) -->
            <a href="/login" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold">Sign In</a>
        @endauth
        <!-- ========== END AUTHENTICATION LOGIC ========== -->
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

    <!-- Shop Products - This will be dynamic when you add products to database -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <!-- ========== PRODUCTS FROM DATABASE WILL GO HERE ========== -->
        @forelse($products ?? [] as $product)
            <div class="bg-white rounded-lg shadow-md text-center p-4 hover:shadow-lg transition duration-300">
                <!-- Product Image -->
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full rounded-md h-48 object-cover">
                @else
                    <img src="https://via.placeholder.com/220x220.png?text={{ urlencode($product->name) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full rounded-md">
                @endif
                
                <!-- Product Name -->
                <h3 class="mt-3 font-bold text-lg">{{ $product->name }}</h3>
                
                <!-- Product Description -->
                <p class="text-gray-600 mt-1 text-sm">{{ Str::limit($product->description, 60) }}</p>
                
                <!-- Product Price -->
                <span class="text-orange-500 font-semibold mt-2 block">${{ number_format($product->price, 2) }}</span>
                
                <!-- Stock Status -->
                @if($product->stock > 0)
                    <p class="text-green-500 text-xs mt-1">In Stock: {{ $product->stock }}</p>
                @else
                    <p class="text-red-500 text-xs mt-1">Out of Stock</p>
                @endif
                
                <!-- Buy Now Button -->
                <a href="#" 
                   class="inline-block mt-3 px-4 py-2 {{ $product->stock > 0 ? 'bg-orange-500 hover:bg-orange-600' : 'bg-gray-400 cursor-not-allowed' }} text-white rounded font-semibold transition duration-300">
                    {{ $product->stock > 0 ? 'Buy Now' : 'Out of Stock' }}
                </a>
            </div>
        @empty
            <!-- Show this message if no products exist yet -->
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
        <!-- ========== END PRODUCTS SECTION ========== -->
    </section>

    <!-- Admin Quick Link (only visible to admin users) -->
    @auth
        @if(Auth::user()->isAdmin())
            <div class="text-center mt-4">
                <a href="{{ route('admin.products.index') }}" 
                   class="inline-block bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 text-sm">
                    🔧 Admin: Manage Products
                </a>
            </div>
        @endif
    @endauth

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-6">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html>