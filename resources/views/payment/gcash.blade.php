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
            Payment
        </h1>
        <p class="text-white/90 text-sm tracking-widest uppercase font-medium">Finalizing Order #{{ $checkoutData['order_number'] }}</p>
    </section>


    {{-- ════════════════════════════════════════════
          PAYMENT CONTENT
    ════════════════════════════════════════════ --}}
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 text-center overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-brand-orange"></div>
                <h2 class="font-serif text-2xl font-bold text-slate-800 mb-6">Scan to Pay</h2>
                
                <div class="bg-slate-50 p-6 rounded-2xl mb-6 inline-block shadow-inner border border-gray-100">
                    <img src="{{ asset('images/gcash-qr.png') }}" alt="GCash QR Code" class="w-64 h-64 mx-auto rounded-lg">
                </div>

                <div class="space-y-2 mb-8">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400">GCash Details</p>
                    <p class="text-lg font-bold text-slate-800">0912 345 6789</p>
                    <p class="text-sm text-gray-500 italic">Daily Essentials - Focus mode: ON</p>
                </div>

                <div class="bg-orange-50/50 p-4 rounded-2xl border border-orange-100">
                    <p class="text-xs text-orange-700 font-medium leading-relaxed">
                        Please ensure the exact amount of <span class="font-bold">₱{{ number_format($checkoutData['total_amount'], 2) }}</span> is sent to avoid delays in processing.
                    </p>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-slate-900 text-white rounded-3xl p-8 shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="font-serif text-xl font-bold">Total Amount Due</h3>
                            <p class="text-white/50 text-xs uppercase tracking-tighter">Order #{{ $checkoutData['order_number'] }}</p>
                        </div>
                        <span class="text-brand-orange text-3xl font-black font-mono">₱{{ number_format($checkoutData['total_amount'], 2) }}</span>
                    </div>

                    <div class="space-y-2">

                        {{-- Loop through the Cart Items since the Order Items aren't created yet --}}
                        @foreach($cartItems as $item)
                        <div class="flex justify-between text-xs text-white/70">
                            <span>{{ $item->quantity }}x {{ $item->product->name }}</span>
                            <span>₱{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="font-serif text-xl font-bold text-slate-800 mb-6">Submit Proof of Payment</h3>
                    
                    <form action="{{ route('payment.verify') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Reference Number</label>
                            <input type="text" name="reference_number" required
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all font-mono"
                                   placeholder="13-digit Reference No.">
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Payment Screenshot</label>
                            <div class="relative group">
                                <input type="file" name="payment_screenshot" accept="image/*" required
                                       class="w-full px-5 py-3 bg-gray-50 border border-dashed border-gray-200 rounded-2xl file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-orange-100 file:text-brand-orange hover:file:bg-orange-200 cursor-pointer transition-all">
                            </div>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-slate-900 text-white px-8 py-5 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg hover:shadow-orange-200 active:scale-[0.98]">
                            Confirm My Payment
                        </button>
                    </form>
                </div>
                
                <div class="text-center">
                    <a href="{{ route('checkout.index') }}" class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400 hover:text-brand-orange transition-colors">
                        ← Edit Shipping Info
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-[0.2em]">&copy; 2026 Focus mode: ON | Secure Checkout System</p>
        </div>
    </footer>

</body>
</html>