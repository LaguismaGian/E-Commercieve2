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
        <!-- DEBUG PANEL - Shows user role and admin status -->
        <div class="bg-yellow-100 text-black px-3 py-1 rounded text-xs mr-2 border border-yellow-400">
            🔍 Role: {{ Auth::user()->role }} | 
            Admin: {{ Auth::user()->isAdmin() ? '✅ YES' : '❌ NO' }}
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- ADMIN BUTTON - Only shows if user is admin -->
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 text-sm font-semibold">
                    📋 Admin Panel
                </a>
                
                <!-- Quick Actions Dropdown -->
                <div class="relative group">
                    <button class="bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 text-sm font-semibold">
                        ⚡ Quick Actions ▼
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden group-hover:block z-50 border border-gray-200">
                        <a href="{{ route('admin.products.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            ➕ Add Product
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            📦 Manage Products
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            📋 View Orders
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            👥 Manage Users
                        </a>
                    </div>
                </div>
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