<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Candle Glow Shop')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">@yield('header', 'Candle Glow Shop')</h1>
        <p class="mt-2 text-lg">@yield('subheader', 'Handmade candles for every mood')</p>
    </header>

    <!-- Navigation - THIS IS THE ONE FILE YOU UPDATE -->
    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 hover:text-orange-500 font-semibold">Home</a>
            <a href="/about" class="text-gray-800 hover:text-orange-500 font-semibold">About</a>
            <a href="/shop" class="text-gray-800 hover:text-orange-500 font-semibold">Shop</a>
            <a href="/contact" class="text-gray-800 hover:text-orange-500 font-semibold">Contact</a>
            <a href="/cart" class="text-gray-800 hover:text-orange-500 font-semibold relative">
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
                <!-- ADMIN BUTTON - UPDATE THIS ONCE, IT SHOWS ON ALL PAGES -->
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 text-sm font-semibold">
                        📋 Admin Panel
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

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        ✅ {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        ❌ {{ session('error') }}
    </div>
    @endif

    <!-- Welcome Message -->
    @auth
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 mx-6 mt-4 rounded-lg">
        <p class="text-lg">
            @yield('welcome_message')
        </p>
    </div>
    @endauth

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-12">
        &copy; {{ date('Y') }} Candle Glow Shop | All Rights Reserved
    </footer>

    <script>
        setTimeout(function() {
            let messages = document.querySelectorAll('.fixed.top-4');
            messages.forEach(function(message) {
                message.style.display = 'none';
            });
        }, 3000);
    </script>

</body>
</html>