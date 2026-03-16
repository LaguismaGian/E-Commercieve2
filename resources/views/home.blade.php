<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Candle Glow Shop</h1>
        <p class="mt-2 text-lg">Handmade candles for every mood</p>
    </header>

    <!-- Navigation -->
    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 font-semibold hover:text-orange-500">Home</a>.
            <a href="/about" class="text-gray-800 font-semibold hover:text-orange-500">About</a>
            <a href="/shop" class="text-gray-800 font-semibold hover:text-orange-500">Shop</a>
            
            <a href="/contact" class="text-gray-800 font-semibold hover:text-orange-500">Contact</a>
        </div>
        <a href="/login" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold">Sign In</a>
    </nav>

    <!-- Products Section -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <div class="bg-white rounded-lg shadow-md text-center p-4">
            <img src="https://via.placeholder.com/220x220.png?text=Candle+1" alt="Vanilla Delight" class="w-full rounded-md">
            <h3 class="mt-3 font-bold text-lg">Vanilla Delight</h3>
            <p class="text-gray-600 mt-1 text-sm">Sweet vanilla scented candle</p>
            <span class="text-orange-500 font-semibold mt-2 block">$12.99</span>
            <a href="#" class="inline-block mt-3 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">Buy Now</a>
        </div>

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