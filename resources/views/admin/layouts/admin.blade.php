<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Top Navigation -->
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold">🕯️ Admin Panel</h1>
                    <div class="hidden md:flex space-x-4 ml-8">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-400 px-3 py-2 rounded transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-orange-400' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="hover:text-orange-400 px-3 py-2 rounded transition {{ request()->routeIs('admin.products.*') ? 'bg-gray-800 text-orange-400' : '' }}">
                            Products
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="hover:text-orange-400 px-3 py-2 rounded transition {{ request()->routeIs('admin.orders.*') ? 'bg-gray-800 text-orange-400' : '' }}">
                            Orders
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="hover:text-orange-400 px-3 py-2 rounded transition {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-orange-400' : '' }}">
                            Users
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">{{ Auth::user()->name }}</span>
                    <a href="/" class="bg-blue-600 px-3 py-1 rounded text-sm hover:bg-blue-700">View Store</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 px-3 py-1 rounded text-sm hover:bg-red-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
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

        @yield('content')
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-12">
        &copy; {{ date('Y') }} Candle Glow Shop | Admin Panel
    </footer>

</body>
</html>