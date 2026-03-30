<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Your Cart | Daily Essentials</title>

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
            Your Shopping Cart
        </h1>
        <p class="text-white/90 text-sm tracking-widest uppercase font-medium">Review your items before checkout</p>
    </section>
    

    {{-- ════════════════════════════════════════════
         CART CONTENT
    ════════════════════════════════════════════ --}}
    <main class="max-w-7xl mx-auto px-6 py-12">
        @if(session('success'))
            <div class="bg-green-50 border border-green-100 text-green-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 animate-pulse">
                {{ session('success') }}
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

        @if($cartItems->count() > 0)
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Product</th>
                            <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Price</th>
                            <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Quantity</th>
                            <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Subtotal</th>
                            <th class="p-6"></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50">
                        @foreach($cartItems as $item)
                        <tr class="group hover:bg-gray-50/50 transition-colors">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-20 h-20 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/images/' . $item->product->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-2xl">🕯️</div>
                                        @endif
                                    </div>

                                    {{-- Product Info with Scent Display --}}
                                    <div>
                                        <p class="font-serif font-bold text-gray-900 text-lg">{{ $item->product->name }}</p>
                                        <div class="flex flex-col gap-1 mt-1">
                                            <span class="text-[10px] text-orange-500 font-bold uppercase tracking-tighter">
                                                {{ $item->product->category }}
                                            </span>
                                            
                                            {{-- Display the selected scent --}}
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-[11px] text-gray-400 font-medium uppercase tracking-widest">Scent:</span>
                                                <span class="text-[11px] text-gray-700 font-bold bg-gray-100 px-2 py-0.5 rounded-full border border-gray-200">
                                                    {{ $item->scent ?? 'Default' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6 text-center font-medium text-gray-600">₱{{ number_format($item->product->price, 2) }}</td>
                            <td class="p-6">
                                <div class="flex items-center justify-center gap-3">
                                    <form action="{{ route('cart.update', $item) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                        <button type="submit" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-white hover:shadow-sm transition-all" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                    </form>
                                    <span class="w-8 text-center font-bold">{{ $item->quantity }}</span>
                                    <form action="{{ route('cart.update', $item) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                        <button type="submit" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-white hover:shadow-sm transition-all" {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="p-6 text-center font-bold text-gray-900">₱{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <td class="p-6 text-right">
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-12 flex flex-col md:flex-row justify-between items-start gap-8">
                <div class="space-y-4">
                    <a href="/shop" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-orange-500 transition-colors uppercase tracking-widest">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>

                <div class="w-full md:w-96 bg-gray-50 rounded-[2rem] p-8 space-y-6 border border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500 font-medium">Subtotal</span>
                        <span class="font-bold text-gray-900">₱{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-200 pt-4">
                        <span class="text-lg font-serif font-bold text-gray-900">Total</span>
                        <span class="text-2xl font-bold text-orange-600">₱{{ number_format($total, 2) }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="block w-full bg-gray-900 text-white text-center py-4 rounded-full font-bold shadow-lg hover:bg-gray-800 transition-all active:scale-95 text-xs tracking-[0.2em]">
                        PROCEED TO CHECKOUT
                    </a>
                </div>
            </div>

        @else
            <div class="text-center py-24 bg-gray-50 rounded-[3rem] border border-dashed border-gray-200">
                <div class="text-6xl mb-6 opacity-20">🛒</div>
                <h2 class="font-serif text-2xl font-bold text-gray-900 mb-2">Your cart is currently empty</h2>
                <p class="text-gray-500 mb-8">Looks like you haven't added any candles yet.</p>
                <a href="/shop" class="inline-block bg-orange-600 text-white px-10 py-4 rounded-full font-bold shadow-lg hover:bg-orange-700 transition-all text-xs tracking-widest uppercase">
                    Start Shopping
                </a>
            </div>
        @endif
    </main>

    {{-- Script for auto-hiding messages --}}
    <script>
        setTimeout(() => {
            let msg = document.querySelector('.bg-green-50');
            if(msg) msg.style.display = 'none';
        }, 3000);
    </script>

    {{-- ════════════════════════════════════════════
         FOOTER (COMPACT VERSION)
    ════════════════════════════════════════════ --}}
<footer class="bg-white border-t border-gray-200 py-10 px-6 md:px-12 font-sans text-gray-600">
    <div class="max-w-7xl mx-auto">
        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            
            {{-- Brand Section --}}
            <div>
                <h3 class="font-serif text-lg text-gray-900 mb-3">Daily Essentials Shop</h3>
                <p class="text-xs leading-relaxed max-w-xs opacity-80">
                    Quality meets care with love and creativity. We are committed to making every moment memorable.
                </p>
            </div>

            {{-- Links Section --}}
            <div class="md:text-center">
                <h3 class="font-serif text-lg text-gray-900 mb-3">Links</h3>
                <ul class="flex md:justify-center space-x-4 text-xs">
                    <li><a href="/" class="text-orange-400 hover:text-orange-500 transition">Home</a></li>
                    <li><a href="/about" class="hover:text-gray-900 transition">About</a></li>
                    <li><a href="/shop" class="hover:text-gray-900 transition">Shop</a></li>
                    <li><a href="/contact" class="hover:text-gray-900 transition">Contact</a></li>
                </ul>
            </div>

            {{-- Contact Section --}}
            <div class="md:text-right">
                <h3 class="font-serif text-lg text-gray-900 mb-3">Contact Us</h3>
                <div class="text-xs space-y-1 italic opacity-80">
                    <p><span class="font-bold not-italic">Address:</span> Santa Maria, Bulacan</p>
                    <p><span class="font-bold not-italic">Email:</span> ebardonenikko@gmail.com</p>
                </div>
            </div>
        </div>

        <hr class="border-gray-100 mb-6">

        {{-- Bottom Bar --}}
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 text-[10px] uppercase tracking-widest text-gray-400">
            <p>Copyright &copy; {{ date('Y') }} Daily Essentials Shop</p>

            <div class="flex items-center space-x-8">
                {{-- Social Icons --}}
                <div class="flex space-x-4">
                    <a href="{{ env('FACEBOOK_URL') }}" target="_blank" class="text-gray-400 hover:text-gray-900 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.058-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.44-.645-1.44-1.44s.645-1.44 1.44-1.44z"/></svg>
                    </a>
                </div>

                {{-- Scroll Up Button --}}
                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="bg-gray-100 text-gray-900 p-2 rounded hover:bg-black hover:text-white transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</footer>

    {{-- Active nav link JS --}}
    <script>
        function setActive(el) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                link.classList.add('text-gray-700');
            });
            el.classList.add('active');
            el.classList.remove('text-gray-700');
        }
    </script>
</body>
</html>