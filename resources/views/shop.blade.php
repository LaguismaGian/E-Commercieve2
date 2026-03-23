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
        </div>
        <a href="/login" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold">Sign In</a>
    </nav>

<<<<<<< Updated upstream
    <!-- Shop Products -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <!-- Product Card Example -->
        <div class="bg-white rounded-lg shadow-md text-center p-4">
            <img src="https://via.placeholder.com/220x220.png?text=Candle+1" alt="Vanilla Delight" class="w-full rounded-md">
            <h3 class="mt-3 font-bold text-lg">Vanilla Delight</h3>
            <p class="text-gray-600 mt-1 text-sm">Sweet vanilla scented candle</p>
            <span class="text-orange-500 font-semibold mt-2 block">$12.99</span>
            <a href="#" class="inline-block mt-3 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">Buy Now</a>
        </div>
=======
    <!-- Welcome Message for Logged-in Users -->
    @auth
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 mx-6 mt-4 rounded-lg">
        <p class="text-lg">
            🎉 Welcome back, <strong>{{ Auth::user()->name }}</strong>! 
            Ready to find your next favorite candle? ✨
        </p>
    </div>
    @endauth

   <!-- Shop Products - Display products from database -->
<section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
    @forelse($products as $product)
        <div class="bg-white rounded-lg shadow-md text-center p-4 hover:shadow-lg transition duration-300">
            <!-- Product Image -->
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-48 object-cover rounded-md">
            @else
                <div class="w-full h-48 bg-gray-200 rounded-md flex items-center justify-center text-4xl">
                    🕯️
                </div>
            @endif
            
            <!-- Product Name -->
            <h3 class="mt-3 font-bold text-lg">{{ $product->name }}</h3>
            
            <!-- Product Description -->
            <p class="text-gray-600 mt-1 text-sm">{{ Str::limit($product->description, 60) }}</p>
            
            <!-- Product Category (optional) -->
            @if($product->category)
                <p class="text-gray-400 text-xs mt-1">{{ $product->category }}</p>
            @endif
            
            <!-- Product Price -->
            <span class="text-orange-500 font-semibold mt-2 block text-xl">${{ number_format($product->price, 2) }}</span>
            
            <!-- Stock Status -->
            @if($product->stock > 0)
                <p class="text-green-500 text-xs mt-1">✓ In Stock ({{ $product->stock }} available)</p>
            @else
                <p class="text-red-500 text-xs mt-1">✗ Out of Stock</p>
            @endif
            
            <!-- Buy Now Button -->
            <a href="#" 
               class="inline-block mt-3 px-4 py-2 {{ $product->stock > 0 ? 'bg-orange-500 hover:bg-orange-600' : 'bg-gray-400 cursor-not-allowed' }} text-white rounded font-semibold transition duration-300">
                {{ $product->stock > 0 ? 'Buy Now' : 'Out of Stock' }}
            </a>
        </div>
    @empty
        <!-- Show this message if no products exist -->
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
        <!-- ========== END PRODUCTS SECTION ========== -->
    </section>
>>>>>>> Stashed changes

        <div class="bg-white rounded-lg shadow-md text-center p-4">
            <img src="https://via.placeholder.com/220x220.png?text=Candle+2" alt="Lavender Bliss" class="w-full rounded-md">
            <h3 class="mt-3 font-bold text-lg">Lavender Bliss</h3>
            <p class="text-gray-600 mt-1 text-sm">Relaxing lavender aroma</p>
            <span class="text-orange-500 font-semibold mt-2 block">$14.99</span>
            <a href="#" class="inline-block mt-3 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">Buy Now</a>
        </div>

        <div class="bg-white rounded-lg shadow-md text-center p-4">
            <img src="https://via.placeholder.com/220x220.png?text=Candle+3" alt="Citrus Sunrise" class="w-full rounded-md">
            <h3 class="mt-3 font-bold text-lg">Citrus Sunrise</h3>
            <p class="text-gray-600 mt-1 text-sm">Fresh and zesty citrus scent</p>
            <span class="text-orange-500 font-semibold mt-2 block">$11.99</span>
            <a href="#" class="inline-block mt-3 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">Buy Now</a>
        </div>

        <div class="bg-white rounded-lg shadow-md text-center p-4">
            <img src="https://via.placeholder.com/220x220.png?text=Candle+4" alt="Rose Garden" class="w-full rounded-md">
            <h3 class="mt-3 font-bold text-lg">Rose Garden</h3>
            <p class="text-gray-600 mt-1 text-sm">Romantic rose fragrance</p>
            <span class="text-orange-500 font-semibold mt-2 block">$15.99</span>
            <a href="#" class="inline-block mt-3 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">Buy Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-6">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html> 