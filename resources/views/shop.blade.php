<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Shop | Daily Essentials</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .nav-link { transition: color 0.2s; }
        .nav-link:hover { color: #F47953; }
        .nav-link.active { color: #F47953; }

        /* ── Hover effect to show cart ── */
        .product-card .cart-badge { opacity: 0; transition: opacity 0.25s; }
        .product-card:hover .cart-badge { opacity: 1; }
        
        /* Category button active state */
        .category-btn.active { 
            color: #F47953; 
            font-weight: 700;
            border-left: 3px solid #F47953;
            padding-left: 12px;
        }
    </style>
</head>

<body class="font-sans bg-white text-gray-900 antialiased" x-data="{ currentCategory: 'All' }">

    {{-- ════════════════════════════════════════════
         NAVBAR 
    ════════════════════════════════════════════ --}}
    <header class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Daily Essentials Logo" class="w-10 h-10">
                <span class="font-serif font-bold text-lg tracking-tight">Daily Essentials</span>
            </div>

            {{-- Nav links --}}
            <nav class="hidden md:flex items-center gap-8">
                <a href="/"    class="nav-link text-sm font-medium"                            >Home</a>
                <a href="/about"   class="nav-link text-sm font-medium text-gray-700"        >About</a>
                <a href="/shop"    class="nav-link active text-sm font-medium text-gray-700" >Shop</a>
                <a href="/contact" class="nav-link text-sm font-medium text-gray-700"        >Contact</a>
            </nav>  
            
            {{-- Icons--}}
            <div class="flex items-center gap-4">

                @auth
                    <span class="font-serif font-bold text-sm text-slate-800">
                        Welcome, <span class=" text-brand-orange">{{ Auth::user()->name }}!</span>
                    </span>
                @else
                    <span class="font-sans font-bold text-sm text-brand-orange">
                       Login?
                    </span>
                @endauth
                
                    <a id="Profile" href="{{ Auth::check() ? route('profile') : route('login') }}" class="text-black  hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                        </svg>
                    </a>
        
                   
                    <a id="Cart" href="{{ Auth::check() ? route('shop') : route('login') }}" class="relative text-brand hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#F47953" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                        </svg>
                    </a>
                  
                @auth
                    <a id="Logout" href="#" class="text-danger hover:scale-110 transition-transform" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#F83737" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0-3-3m3 3H9"/>
                        </svg>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
               @endauth

               
            </div>
        </div>
    </header>

    {{-- ════════════════════════════════════════════
        TOP PAGE
    ════════════════════════════════════════════ --}}
    <section class="relative min-h-[280px] flex items-center justify-center text-center px-6" 
             style="background-image: url('{{ asset('images/bgphoto.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
             
        <h1 class="font-serif text-white text-4xl md:text-5xl font-bold tracking-tight">
            Get All Your Favorite Candles!
        </h1>
    </section>

    {{-- ════════════════════════════════════════════
         SHOP MAIN CONTENT
    ════════════════════════════════════════════ --}}
    <main class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row gap-12">
        
        {{-- Sidebar: Category Menu --}}
        <aside class="w-full md:w-64 flex-shrink-0">
            <h3 class="font-serif text-xl font-bold mb-6 pb-2 border-b border-gray-100">Categories</h3>
            <ul class="space-y-4">
                <li>
                    <button @click="currentCategory = 'All'" 
                            :class="currentCategory === 'All' ? 'active' : 'text-gray-600'"
                            class="category-btn text-sm hover:text-orange-500 transition-all">
                        All Products
                    </button>
                </li>
                @php
                    $categories = [
                        'Dessert Candles' => 3,
                        'Unique Candles' => 13,
                        'Flower Candles' => 3,
                        
                        // Comment for now
                        // 'Adult Candles' => 2
                    ];
                @endphp

                @foreach($categories as $name => $count)
                <li>
                    <button @click="currentCategory = '{{ $name }}'" 
                            :class="currentCategory === '{{ $name }}' ? 'active' : 'text-gray-600'"
                            class="category-btn text-sm hover:text-orange-500 transition-all flex justify-between w-full">
                        <span>{{ $name }}</span>
                        <span class="text-gray-300 text-xs">({{ $count }})</span>
                    </button>
                </li>
                @endforeach
                
            </ul>
        </aside>

        {{-- Product Grid --}}
        <div class="flex-1">
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        

                @foreach($products as $product)
                    <a href="{{ route('shop.show', $product->id) }}"
                       x-show="currentCategory === 'All' || currentCategory === '{{ $product->category }}'"
                       x-transition.opacity
                       class="product-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-50">
                        
                        <div class="relative bg-gray-200 h-48 flex items-center justify-center">

                            {{-- Cart Icon --}}
                            <span class="cart-badge absolute top-3 right-3 bg-white rounded-full shadow-sm flex items-center justify-center cursor-pointer" style="width:32px;height:32px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#F47953" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                                </svg>
                            </span>

                            {{-- Sale Badge --}}
                            @if($product->on_sale)
                                <span class="absolute top-3 left-3 bg-red-500 opacity-90 text-white text-[10px] font-semibold px-2.5 py-1 rounded-full shadow-sm">
                                    Sale!
                                </span>
                            @endif
                
                            {{-- Product Image --}}
                            <img src="{{ asset('storage/images/' . $product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}"/>
                        </div>
                
                        <div class="p-4">
                            <p class="text-[10px] text-orange-500 font-bold uppercase tracking-wider mb-1">
                                {{ $product->category }}
                            </p>
                            
                            <h4 class="font-serif font-bold text-sm mb-1 text-gray-900">
                                {{ $product->name }}
                            </h4>
                            
                            <div class="flex items-center gap-2">
                                <p class="text-brand-red font-semibold text-sm">
                                    @if($product->price <= 0)
                                        ₱Varies from design
                                    @else
                                        ₱{{ number_format($product->price, 2) }}
                                    @endif</span>
                                </p>
                
                                @if($product->on_sale && $product->old_price)
                                    <p class="text-gray-400 line-through text-xs">
                                        ₱{{ number_format($product->old_price, 2) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
        
            </div>
        </div>
    </main>

    {{-- ════════════════════════════════════════════
         FOOTER
    ════════════════════════════════════════════ --}}
    <footer class="bg-white border-t border-gray-200 pt-16 pb-8 px-6 md:px-12 font-sans text-gray-600">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            
            <div>
                <h3 class="font-serif text-xl text-gray-900 mb-6">Daily Essentials Shop</h3>
                <p class="font-sans text-sm leading-relaxed max-w-xs">
                    Welcome to the world of Daily Essentials, where quality meets care with love and creativity. 
                    Discover our story, our passion for excellence, and our commitment to making every moment memorable.
                </p>
            </div>

            <div class="md:pl-12">
                <h3 class="font-serif text-xl text-gray-900 mb-6">Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="text-orange-400 hover:text-orange-500 transition">Home</a></li>
                    <li><a href="/about" class="hover:text-gray-900 transition">About</a></li>
                    <li><a href="/shop" class="hover:text-gray-900 transition">Shop</a></li>
                    <li><a href="/contact" class="hover:text-gray-900 transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-serif text-xl text-gray-900 mb-6">Contact Us</h3>
                <div class="text-sm space-y-2 italic">
                    <p><span class="font-bold not-italic">Address:</span> Santa Maria, Bulacan</p>
                    <p><span class="font-bold not-italic">Email:</span> ebardonenikko@gmail.com</p>
                    <p><span class="font-bold not-italic">Phone:</span> 09499383628</p>
                </div>
            </div>
        </div>

        <hr class="border-gray-200 mb-8">

        <div class="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0 text-sm">
            
            <p>Copyright &copy; {{ date('Y') }} Daily Essentials Shop</p>


            {{-- Icons at footer --}}
            <div class="flex items-center space-x-12">
                <div class="flex space-x-4">
                    
                    <a id="Facebook" href="{{ env('FACEBOOK_URL') }}" target="_blank" class="text-gray-900 hover:text-gray-600">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>

                    <a id="Instagram" href="#" class="text-gray-900 hover:text-gray-600">
                        <svg class="w-6 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.058-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.44-.645-1.44-1.44s.645-1.44 1.44-1.44z"/></svg>
                    </a>
                </div>

                <div id="Scroll up" class="flex flex-col items-center">
                    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="bg-black text-white p-2 rounded-sm hover:bg-gray-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                    </button>
                </div>
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