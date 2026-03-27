<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Daily Essentials | Scented Candles</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
     
    <style>
        
        .nav-link { transition: color 0.2s; }
        .nav-link:hover { color: #F47953; }
        .nav-link.active { color: #F47953; }

        /* ── Hover effect to show cart ── */
        .product-card .cart-badge { opacity: 0; transition: opacity 0.25s; }
        .product-card:hover .cart-badge { opacity: 1; }

        /* ── Expand effect on scent images ── */
        .scent-circle {
            transition: transform 0.25s cubic-bezier(.34,1.56,.64,1);
            cursor: pointer;
        }
        .scent-circle:hover,
        .scent-circle:active { transform: scale(1.18); }
    </style>
</head>

<body class="font-sans bg-white text-gray-900 antialiased">


    {{-- ════════════════════════════════════════════
         NAVBAR
    ════════════════════════════════════════════ --}}
    <header class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
    
            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Hero Image" class="w-10 h-10 flex items-center justify-center">
                <span class="font-serif font-bold text-lg tracking-tight">Daily Essentials</span>
            </div>
    
            {{-- Nav links --}}
            <nav class="hidden md:flex items-center gap-8">
                <a href="/"    class="nav-link active text-sm font-medium"            onclick="setActive(this)">Home</a>
                <a href="/about"   class="nav-link text-sm font-medium text-gray-700"     onclick="setActive(this)">About</a>
                <a href="/shop"    class="nav-link text-sm font-medium text-gray-700"     onclick="setActive(this)">Shop</a>
                <a href="/contact" class="nav-link text-sm font-medium text-gray-700"     onclick="setActive(this)">Contact</a>
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
         FRONT PAGE
    ════════════════════════════════════════════ --}}
    <section
        id="hero"
        class="relative min-h-[480px] flex items-center justify-center text-center px-6 py-20"
        style="background-image: url('{{ asset('images/bgphoto.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
      
        <div class="relative z-10 max-w-2xl">
            <h1 class="font-serif text-white text-5xl md:text-6xl font-bold leading-tight mb-5">
                Let's Make Scented Candles<br/>a Part of Your Life.
            </h1>
            <p class="text-white text-base leading-relaxed mb-8">
                Explore a vibrant tapestry of blooms and arrangements that add color, fragrance,
                and elegance to your life.<br/>Discover the perfect candle expression for every moment and occasion.
            </p>
            <a href="/shop"
               class="inline-block brand-orange text-white font-sans font-semibold text-sm tracking-widest uppercase bg-orange-600 hover:scale-110 px-10 py-4 rounded-full  shadow-lg">
                Shop Now
            </a>
        </div>
    </section>
    
    
    {{-- ════════════════════════════════════════════
         FEATURED PRODUCTS
    ════════════════════════════════════════════ --}}
    <section id="shop" class="bg-section py-16 px-6">
        <div class="max-w-7xl mx-auto">
    
            <h2 class="font-serif text-3xl font-bold text-center mb-10">Featured Products</h2>
    
            {{-- 4-column grid --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    
                @php
                    $featured = [
                        [
                            'name'      => 'Customizable Bouquet Candle',
                            'old_price' => 'varies',
                            'price'     => 'varies from design',
                            'image'     => 'images/bouquetcandle.jpg',
                        ],
                        [
                            'name'      => 'Strawberry Dessert Candle',
                            'old_price' => '₱270',
                            'price'     => '₱250',
                            'image'     => 'images/strawberryproduct.png',
                        ],
                        [
                            'name'      => 'PumpkinSpice Dessert Candle',
                            'old_price' => '₱270',
                            'price'     => '₱250',
                            'image'     => 'images/pumpkinproduct.png',
                        ],
                        [
                            'name'      => 'Orange Dessert Candle',
                            'old_price' => '₱270',
                            'price'     => '₱250',
                            'image'     => 'images/orangeproduct.png',
                        ],
                    ];
                @endphp
    
                @foreach ($featured as $product)
                <a href="shop">
                    <div class="product-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="relative bg-gray-200 h-52 flex items-center justify-center">
                            {{-- Sale badge --}}
                            <span class="absolute top-3 left-3 bg-white text-gray-700 text-[10px] font-semibold px-2.5 py-1 rounded-full shadow-sm">Sale!</span>
                            {{-- Cart badge – hidden until hover --}}
                            <span class="cart-badge absolute top-3 right-3 bg-white rounded-full shadow-sm flex items-center justify-center" style="width:28px;height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#F47953" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                                </svg>
                            </span>
        
                            @if ($product['image'])
                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover"/>
                            @else
                                <span class="text-gray-400 text-sm">picture</span>
                            @endif
                        </div>
                        
                        <div class="p-4 text-center">
                            <p class="font-serif font-bold text-sm mb-1">{{ $product['name'] }}</p>
                            <div class="flex items-center justify-center gap-2 text-xs">
                                <span class="line-through text-gray-400">{{ $product['old_price'] }}</span>
                                <span class="text-brand-red font-semibold">{{ $product['price'] }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
    
            </div>
        </div>
    </section>
    
    
    {{-- ════════════════════════════════════════════
         SCENTS SECTION
    ════════════════════════════════════════════ --}}
    <section id="about" class="bg-white py-16 px-6">
        <div class="max-w-5xl mx-auto">
    
            {{-- Header --}}
            <div class="text-center mb-12">
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-1">Scents</p>
                <h2 class="font-serif text-4xl font-bold">12 scents to choose from</h2>
            </div>
    
            {{-- Scents grid – 4 columns --}}
            @php
                $scents = [
                    ['name' => 'Rose',          'image' => 'rose.jpg'],
                    ['name' => 'Baby powder',   'image' => 'baby powder.jpg'],
                    ['name' => 'Strawberry',    'image' => 'strawberry2.jpg'],
                    ['name' => 'Pumpkin Spice', 'image' => 'pumpkin spice.jpg'],
                    ['name' => 'Fresh Bamboo',  'image' => 'fresh bamboo.jpg'],
                    ['name' => 'Watermelon',    'image' => 'watermelon.jpg'],
                    ['name' => 'Orange',        'image' => 'orange.jpg'],
                    ['name' => 'Vanilla',       'image' => 'vanilla.jpg'],
                    ['name' => 'Marriot',       'image' => 'marriot.jpg'],
                    ['name' => 'Chocolate',     'image' => 'chocolate.jpg'],
                    ['name' => 'Lavender',      'image' => 'lavender.jpg'],
                    ['name' => 'Coffee',        'image' => 'coffee.jpg'],
                ];
            @endphp
    
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-y-8 gap-x-4">
                @foreach ($scents as $scent)
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/' . $scent['image']) }}"
                        alt="{{ $scent['name'] }}"
                        class="scent-circle w-14 h-14 rounded-full flex-shrink-0 object-cover">
                    <span class="font-sans text-sm font-medium">{{ $scent['name'] }}</span>
                </div>
                @endforeach
            </div>
    
        </div>
    </section>
    
    
    {{-- ════════════════════════════════════════════
         NEW DESIGNS SECTION
    ════════════════════════════════════════════ --}}
    <section id="contact" class="bg-section py-16 px-6">
        <div class="max-w-5xl mx-auto">
    
            {{-- Header --}}
            <div class="text-center mb-10">
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-2">New Designs</p>
                <h2 class="font-serif text-3xl md:text-4xl font-bold leading-snug">
                    Discover the Latest Designs at Your Top<br class="hidden md:block"/> Choice Scented Candle Shop
                </h2>
            </div>
    
            @php
                $newDesigns = [
                        [
                            'name'      => 'Rose Candle',
                            'old_price' => '₱90',
                            'price'     => '₱80',
                            'image'     => 'images/rose candle.png',
                        ],
                        [
                            'name'      => 'Choco Frappe Candle',
                            'old_price' => '₱160',
                            'price'     => '₱150',
                            'image'     => 'images/chocofrappe.png',
                        ],
                        [
                            'name'      => 'Coffee Candle',
                            'old_price' => '₱160',
                            'price'     => '₱150',
                            'image'     => 'images/coffee candle.png',
                        ],
                        [
                            'name'      => 'Bear Candle',
                            'old_price' => '₱55',
                            'price'     => '₱45',
                            'image'     => 'images/bear candle.png',
                        ],
                        [
                            'name'      => 'Tincan Candle',
                            'old_price' => '₱170',
                            'price'     => '₱155',
                            'image'     => 'images/tincan candle.png',
                        ],
                    ];
            @endphp
    
            {{-- Row 1: 3 columns --}}
            <a href="/shop">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                    @foreach (array_slice($newDesigns, 0, 3) as $product)
                    <div class="product-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="relative bg-gray-200 h-56 flex items-center justify-center">
                            <span class="absolute top-3 left-3 bg-white text-gray-700 text-[10px] font-semibold px-2.5 py-1 rounded-full shadow-sm">Sale!</span>
                            <span class="cart-badge absolute top-3 right-3 bg-white rounded-full shadow-sm flex items-center justify-center" style="width:28px;height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#F47953" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                                </svg>
                            </span>
                            @if ($product['image'])
                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover"/>
                            @else
                                <span class="text-gray-400 text-sm">picture here</span>
                            @endif
                        </div>
                        <div class="p-4 text-center">
                            <p class="font-serif font-bold text-sm mb-1">{{ $product['name'] }}</p>
                            <div class="flex items-center justify-center gap-2 text-xs">
                                <span class="line-through text-gray-400">{{ $product['old_price'] }}</span>
                                <span class="text-brand-red font-semibold">{{ $product['price'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </a>
    
            {{-- Row 2: 2 columns centered --}}
            <a href="/shop">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-2xl mx-auto">
                    @foreach (array_slice($newDesigns, 3, 2) as $product)
                    <div class="product-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="relative bg-gray-200 h-56 flex items-center justify-center">
                            <span class="absolute top-3 left-3 bg-white text-gray-700 text-[10px] font-semibold px-2.5 py-1 rounded-full shadow-sm">Sale!</span>
                            <span class="cart-badge absolute top-3 right-3 bg-white rounded-full shadow-sm flex items-center justify-center" style="width:28px;height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#F47953" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                                </svg>
                            </span>
                            @if ($product['image'])
                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover"/>
                            @else
                                <span class="text-gray-400 text-sm">picture here</span>
                            @endif
                        </div>
                        <div class="p-4 text-center">
                            <p class="font-serif font-bold text-sm mb-1">{{ $product['name'] }}</p>
                            <div class="flex items-center justify-center gap-2 text-xs">
                                <span class="line-through text-gray-400">{{ $product['old_price'] }}</span>
                                <span class="text-brand-red font-semibold">{{ $product['price'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </a>
        </div>
    </section>


        {{-- ════════════════════════════════════════════
         BENEFITS SECTION
    ════════════════════════════════════════════ --}}
    <section id="benefits" class="bg-white py-16 px-6">
        <div class="max-w-5xl mx-auto">
    
            {{-- Header --}}
            <div class="text-center mb-10">
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-2">Benefits</p>
                <h2 class="font-serif text-4xl md:text-5xl font-bold leading-snug">
                    Scented stories for your favorite spaces.
                </h2>
            </div>
    
            {{-- 3 Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    
                {{-- Card 1 --}}
                <div class="bg-white rounded-2xl border border-brand-orange overflow-hidden shadow-sm">
                    <div class="relative bg-gray-200 h-72 flex items-center justify-center">
                        <img src="{{ asset('images/benefit1.jpg') }}" alt="Calm & Relaxation" class="w-full h-full object-cover"/>
                    </div>
                    <div class="p-5 text-center">
                        <p class="font-sans text-sm text-gray-600 leading-relaxed">
                            " Candles are a shortcut to calm. Fragrances like lavender and Rose interact with your brain to lower stress levels, helping you swap a hectic day for a peaceful evening with a single match "
                        </p>
                    </div>
                </div>
    
                {{-- Card 2 --}}
                <div class="bg-white rounded-2xl border border-brand-orange overflow-hidden shadow-sm">
                    <div class="relative bg-gray-200 h-72 flex items-center justify-center">
                        <img src="{{ asset('images/benefit2.jpg') }}" alt="Warmth & Intimacy" class="w-full h-full object-cover"/>
                    </div>
                    <div class="p-5 text-center">
                        <p class="font-sans text-sm text-gray-600 leading-relaxed">
                            " Nothing beats the golden glow of a real flame. It adds an immediate layer of warmth and intimacy to your home, turning even the simplest corner into a high-end, cozy sanctuary. "
                        </p>
                    </div>
                </div>
    
                {{-- Card 3 --}}
                <div class="bg-white rounded-2xl border border-brand-orange overflow-hidden shadow-sm">
                    <div class="relative bg-gray-200 h-72 flex items-center justify-center">
                        <img src="{{ asset('images/benefit3.jpg') }}" alt="Focus & Productivity" class="w-full h-full object-cover"/>
                    </div>
                    <div class="p-5 text-center">
                        <p class="font-sans text-sm text-gray-600 leading-relaxed">
                            " The right scent is a productivity hack. Invigorating scents like Orange or Coffee sharpen your mind and boost energy, creating sensory cues that help you stay alert and intentional throughout the day. "
                        </p>
                    </div>
                </div>
    
            </div>
        </div>
    </section>

        {{-- ════════════════════════════════════════════
         ABOUT OWNER SECTION
    ════════════════════════════════════════════ --}}
    <section id="owner" class="bg-hero py-16 px-6">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-12">
    
            {{-- Owner circle photo --}}
            <div class="flex-shrink-0">
                <img
                    src="{{ asset('images/owner.jpg') }}"
                    alt="Owner"
                    class="w-72 h-72 rounded-full object-cover shadow-md"
                />
            </div>
    
            {{-- Text – right --}}
            <div>
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-3">About Owner</p>
                <h2 class="font-serif text-3xl md:text-4xl font-bold leading-snug mb-4">
                    Learn More About The Journey Of<br/>The Candle Artist
                </h2>
                <p class="font-sans text-sm text-gray-600 leading-relaxed mb-6">
                    Welcome to Candles, where candle artistry meets passion for nature's beauty.
                    Our story is rooted in a deep love for scented candles and a commitment to
                    creating unforgettable moments for our customers.
                </p>
                <a href="/about"
                   class="inline-block bg-brand-orange text-white font-sans font-semibold text-sm tracking-widest uppercase px-8 py-3 rounded-full hover:scale-105 shadow-md">
                    Read More
                </a>
            </div>
    
        </div>
    </section>
    
    
    {{-- ════════════════════════════════════════════
         RECENT EVENTS & CUSTOMERS + OFFER SECTION
    ════════════════════════════════════════════ --}}
    <section id="events" class="py-16 px-6 " style="background-color: #7B1F1F;">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-12">
    
           
            <div class="flex-shrink-0 w-full md:w-auto">
                <p class="text-white text-xs text-center font-semibold uppercase tracking-widest mb-4">Recent Events &amp; Customers</p>
    
                <img 
                    src="{{ asset('images/eventcustomer.png') }}" 
                    alt="Event Customer" 
                    class="rounded-2xl p-6 shadow-md w-full md:w-[340px]"
                />
            </div>
    
            {{-- Right: offer text --}}
            <div>
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-3">Offer Only For You!</p>
                <h2 class="font-serif text-white text-3xl md:text-4xl font-bold leading-snug mb-6">
                    Start Your Candle Journey Here:<br/>Get 20% Off Your First Order!
                </h2>
                <a href="/shop"
                   class="inline-block bg-brand-orange text-white font-sans font-semibold text-sm tracking-widest uppercase px-8 py-3 rounded-full hover:scale-105 shadow-md">
                    Shop Now
                </a>
            </div>
    
        </div>
    </section>
    
    
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