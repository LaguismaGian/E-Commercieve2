<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Checkout | Daily Essentials</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .nav-link { transition: color 0.2s; }
        .nav-link:hover { color: #F47953; }
        .nav-link.active { color: #F47953; font-weight: 600; }
    </style>
</head>

<body class="font-sans bg-white text-gray-900 antialiased">

    {{-- ════════════════════════════════════════════
         NAVBAR 
    ════════════════════════════════════════════ --}}
    <header class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Daily Essentials Logo" class="w-10 h-10">
                <span class="font-serif font-bold text-lg tracking-tight">Daily Essentials</span>
            </div>

            <nav class="hidden md:flex items-center gap-8">
                <a href="/" class="nav-link text-sm font-medium text-gray-700">Home</a>
                <a href="/about" class="nav-link text-sm font-medium text-gray-700">About</a>
                <a href="/shop" class="nav-link text-sm font-medium text-gray-700">Shop</a>
                <a href="/contact" class="nav-link text-sm font-medium text-gray-700">Contact</a>
            </nav>

            <div class="flex items-center gap-4">
                @auth
                    <span class="font-serif font-bold text-sm text-slate-800">
                        Welcome, <span class="text-brand-orange">{{ Auth::user()->name }}!</span>
                    </span>
                @else
                    <span class="font-sans font-bold text-sm text-brand-orange">Login?</span>
                @endauth
                
                <a id="Profile" href="{{ Auth::check() ? route('profile') : route('login') }}" class="text-black hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                    </svg>
                </a>
    
                {{-- Icon cart with counter --}}
                <a id="Cart" href="{{ route('cart.index') }}" class="relative text-brand hover:scale-110 transition-transform active">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#F47953" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                    </svg>
                    @auth
                        @php $totalQuantity = Auth::user()->cartItems->sum('quantity'); @endphp
                        @if($totalQuantity > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center border-2 border-white">
                                {{ $totalQuantity }}
                            </span>
                        @endif
                    @endauth
                </a>
                  
                @auth
                    <a id="Logout" href="#" class="text-danger hover:scale-110 transition-transform" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#F83737" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0-3-3m3 3H9"/>
                        </svg>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                @endauth
            </div>
        </div>
    </header>

    {{-- ════════════════════════════════════════════
         TOP PAGE HERO
    ════════════════════════════════════════════ --}}
    <section class="relative min-h-[200px] flex flex-col items-center justify-center text-center px-6" 
             style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/bgphoto.png') }}'); background-size: cover; background-position: center;">
        <h1 class="font-serif text-white text-4xl md:text-5xl font-bold tracking-tight mb-2">
            Checkout
        </h1>
        <p class="text-white/90 text-sm tracking-widest uppercase font-medium">Finalize your scented collection</p>
    </section>

    {{-- ════════════════════════════════════════════
          CHECKOUT CONTENT 
    ════════════════════════════════════════════ --}}
    <div class="max-w-7xl mx-auto px-6 py-12">
        
        {{-- Error Message  --}}
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-r-2xl mb-8 flex items-center gap-3">
                <span class="text-xl">⚠️</span>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        {{-- ADMIN MANAGEMENT --}}
            @auth
                @if(Auth::user()->isAdmin())
                    <div class="mb-8 p-4 bg-orange-50 border border-orange-100 rounded-2xl flex items-center justify-between">
                        <div>
                            <h3 class="text-orange-800 font-bold text-sm">Store Management</h3>
                            <p class="text-orange-600 text-[11px]">You are logged in as an administrator.</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('admin.products.index') }}" 
                               class="text-xs font-semibold text-gray-600 hover:text-gray-900 bg-white border border-gray-200 px-4 py-2 rounded-xl transition-all shadow-sm">
                                View Inventory
                            </a>
                            <a href="{{ route('admin.products.create') }}" 
                               class="text-xs font-semibold text-white bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-xl transition-all shadow-sm flex items-center gap-2">
                                <span>+</span> Add Product
                            </a>
                        </div>
                    </div>
                @endif
            @endauth

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sticky top-24">
                    <h2 class="font-serif text-2xl font-bold mb-6 text-slate-800">Order Summary</h2>
                    
                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cartItems as $item)
                        <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                            <div class="flex-1">
                                <p class="font-bold text-slate-800">{{ $item->product->name }}</p>
                                <p class="text-xs text-brand-orange font-bold uppercase tracking-widest">Scent: {{ $item->scent ?? 'Original' }}</p>
                                <p class="text-sm text-gray-500 mt-1">Qty: {{ $item->quantity }}</p>
                            </div>
                            <p class="font-bold text-slate-900 font-mono">₱{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 pt-6 border-t-2 border-dashed border-gray-100">
                        <div class="flex justify-between items-center text-lg">
                            <span class="font-serif font-bold text-gray-600">Total:</span>
                            <span class="text-brand-orange text-2xl font-black">₱{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-orange-50 rounded-2xl flex items-center justify-center text-brand-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <h2 class="font-serif text-3xl font-bold text-slate-800">Shipping Details</h2>
                    </div>

                    
                    
                    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Street Address</label>
                                <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" required
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all"
                                       placeholder="Block, Lot, Street, Barangay">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">City / Province</label>
                                <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all"
                                       placeholder="e.g. Pandi, Bulacan">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Postal Code</label>
                                <input type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code') }}"
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all"
                                       placeholder="3014">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Phone Number</label>
                                <input type="tel" name="shipping_phone" value="{{ old('shipping_phone') }}" required
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all"
                                       placeholder="0912 345 6789">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Payment Method</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <label class="relative flex items-center p-4 border rounded-2xl cursor-pointer hover:bg-orange-50 transition-colors group">
                                        <input type="radio" name="payment_method" value="gcash" checked class="w-4 h-4 text-brand-orange border-gray-300 focus:ring-brand-orange">
                                        <span class="ml-3 font-bold text-slate-700 group-hover:text-brand-orange">GCash</span>
                                    </label>
                                    <label class="relative flex items-center p-4 border rounded-2xl cursor-pointer hover:bg-orange-50 transition-colors group">
                                        <input type="radio" name="payment_method" value="cod" class="w-4 h-4 text-brand-orange border-gray-300 focus:ring-brand-orange">
                                        <span class="ml-3 font-bold text-slate-700 group-hover:text-brand-orange">Cash on Delivery</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4 mt-12">
                            <a href="{{ route('cart.index') }}" 
                               class="order-2 sm:order-1 px-8 py-4 rounded-2xl font-bold text-gray-400 hover:text-gray-600 transition-colors text-center">
                                ← Return to Cart
                            </a>
                            <button type="submit" 
                                    class="order-1 sm:order-2 flex-1 bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg shadow-slate-200 hover:shadow-orange-200">
                                Complete Purchase
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

</body>
</html>