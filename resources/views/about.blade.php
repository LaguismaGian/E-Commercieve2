<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">About Candle Glow Shop</h1>
        <p class="mt-2 text-lg">Handmade candles for every mood</p>
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
            🎉 Welcome to Candle Glow Shop, <strong>{{ Auth::user()->name }}</strong>! 
            We're so glad to have you here. ✨
        </p>
    </div>
    @endauth

    <!-- About Content -->
    <section class="max-w-4xl mx-auto my-12 p-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">Who We Are</h2>
        <p class="text-gray-700 mb-4">
            Candle Glow Shop is dedicated to creating handmade candles that brighten your home and lift your mood.
            Our candles are crafted with care, using high-quality wax and natural fragrances.
        </p>
        <p class="text-gray-700 mb-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
        <img src="https://via.placeholder.com/600x300.png?text=Our+Team+or+Workshop" alt="About placeholder" class="rounded w-full mt-4">
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-6">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html>