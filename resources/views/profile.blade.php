<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Candle Glow Shop</h1>
        <p class="mt-2 text-lg">My Account</p>
    </header>

    <!-- Navigation with Cart Counter -->
    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 font-semibold hover:text-orange-500">Home</a>
            <a href="/about" class="text-gray-800 font-semibold hover:text-orange-500">About</a>
            <a href="/shop" class="text-gray-800 font-semibold hover:text-orange-500">Shop</a>
            <a href="/contact" class="text-gray-800 font-semibold hover:text-orange-500">Contact</a>
            <!-- Cart Link with Total Quantity Counter -->
            <a href="/cart" class="text-gray-800 font-semibold hover:text-orange-500 relative">
                🛒 Cart
                @auth
                    @php 
                        $totalQuantity = Auth::user()->cartItems->sum('quantity'); 
                    @endphp
                    @if($totalQuantity > 0)
                        <span class="absolute -top-2 -right-4 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $totalQuantity }}
                        </span>
                    @endif
                @endauth
            </a>
            <a href="/profile" class="text-orange-500 font-semibold">My Profile</a>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Admin Panel Button in Navigation (only for admin) -->
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.products.index') }}" class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 text-sm">
                    📋 Manage Products
                </a>
            @endif
            <span class="text-gray-700">Welcome, {{ Auth::user()->name }}! 👋</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Profile Content -->
    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Profile Information</h2>
            
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Name</label>
                    <p class="text-lg text-gray-800">{{ Auth::user()->name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600">Email</label>
                    <p class="text-lg text-gray-800">{{ Auth::user()->email }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600">Member Since</label>
                    <p class="text-lg text-gray-800">{{ Auth::user()->created_at->format('F j, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Two Factor Authentication Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Security Settings</h2>
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Two-Factor Authentication</h3>
            
            @if(auth()->user()->two_factor_confirmed_at)
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    ✅ Two-factor authentication is <strong>ENABLED</strong>
                </div>
                
                <form method="POST" action="{{ route('two-factor.disable') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 font-semibold">
                        Disable 2FA
                    </button>
                </form>
            @else
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                    ⚠️ Two-factor authentication is <strong>DISABLED</strong>
                </div>
                
                <form method="POST" action="{{ route('two-factor.enable') }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 font-semibold">
                        Enable 2FA
                    </button>
                </form>
            @endif

            <!-- Show QR Code when enabling 2FA -->
            @if(session('status') == 'two-factor-authentication-enabled')
                <div class="mt-6 p-4 bg-gray-100 rounded-lg border border-gray-300">
                    <p class="text-sm text-gray-700 mb-3 font-semibold">📱 Scan this QR code with your authenticator app:</p>
                    <div class="inline-block p-4 bg-white rounded-lg shadow-sm">
                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                    </div>
                    
                    <p class="mt-4 text-sm text-gray-700 font-semibold">🔑 Recovery Codes (save these somewhere safe):</p>
                    <ul class="mt-2 list-disc list-inside text-sm font-mono bg-white p-3 rounded">
                        @foreach(auth()->user()->recoveryCodes() as $code)
                            <li class="text-gray-600">{{ $code }}</li>
                        @endforeach
                    </ul>
                    <p class="mt-2 text-xs text-red-600">⚠️ Keep these recovery codes safe! You'll need them if you lose your phone.</p>
                </div>
            @endif
        </div>
        
        <!-- Orders Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">My Orders</h2>
            <p class="text-gray-500">You haven't placed any orders yet.</p>
            <a href="/shop" class="inline-block mt-3 bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                Start Shopping
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-6">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html>