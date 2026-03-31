@extends('layouts.app')

@push('styles')
    <style>
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
@endpush

@section('content')

    {{-- ════════════════════════════════════════════
         TOP PAGE HERO
    ════════════════════════════════════════════ --}}
    <section id="hero" class="relative min-h-[480px] flex items-center justify-center text-center px-6 py-20"
        style="background-image: url('{{ asset('images/bgphoto.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="relative z-10 max-w-2xl">
            <h1 class="font-inria text-white text-5xl md:text-6xl font-bold leading-tight mb-5">
                Let's Make Scented Candles<br/>a Part of Your Life.
            </h1>
            <p class="text-sm md:text-base text-white leading-relaxed font-light italic mb-4">
                "Light up your world with scents that tell a story. Whether it’s a quiet 
                evening in or a celebration shared with loved ones, discover an
                <span class="text-orange-500 font-medium not-italic">enchanting glow</span> 
                for every moment and occasion."
            </p>
            <a href="/shop" class="inline-block text-white font-sans font-semibold text-sm tracking-widest uppercase bg-orange-600 hover:scale-110 px-10 py-4 rounded-full shadow-lg transition-transform">
                Shop Now
            </a>
        </div>
    </section>
    
    {{-- ════════════════════════════════════════════
         FEATURED PRODUCTS
    ════════════════════════════════════════════ --}}
    <section id="shop" class="bg-section-bg py-16 px-6">
        <div class="max-w-5xl mx-auto">
            <h2 class="font-inria text-3xl font-bold text-center mb-10">Featured Products</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                @foreach ($featured as $product)
                <a href="{{ route('shop.show', $product->id) }}" class="group"> {{-- 1. ADD 'group' CLASS HERE --}}
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                        <div class="relative bg-gray-200 h-52 flex items-center justify-center">
                            
                            {{-- Sale badge --}}
                            <span class="absolute top-3 left-3 bg-red-500 opacity-90 text-white text-[10px] font-semibold px-2.5 py-1 rounded-full shadow-sm">Sale!</span>
                
                            {{-- cart badge --}}
                            <span class="absolute top-3 right-3 bg-white rounded-full shadow-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="width:28px;height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#F47953" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                                </svg>
                            </span>
                            
                            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover"/>
                        </div>

                        <div class="p-4 text-center">
                            <p class="font-inria font-bold text-sm mb-1">{{ $product->name }}</p>
                            <div class="flex items-center justify-center gap-2 text-xs">
                                <span class="text-red-500 font-semibold">
                                    @if($product->price <= 0) Varies from design @else ₱{{ number_format($product->price, 2) }} @endif
                                </span>
                                <span class="line-through text-gray-400">₱{{ number_format($product->old_price, 2) }}</span>
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
            <div class="text-center mb-12">
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-1">Scents</p>
                <h2 class="font-inria text-4xl font-bold">12 scents to choose from</h2>
            </div>
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
                         class="w-14 h-14 rounded-full flex-shrink-0 object-cover cursor-pointer transition-transform duration-300 ease-out hover:scale-110 active:scale-125">
                    <span class="font-sans text-sm font-medium">{{ $scent['name'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    {{-- ════════════════════════════════════════════
         NEW DESIGNS SECTION
    ════════════════════════════════════════════ --}}
    <section id="contact" class="bg-section-bg py-16 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-10">
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-2">New Designs</p>
                <h2 class="font-inria text-3xl md:text-4xl font-bold leading-snug">
                    Discover the Latest Designs at Your Top<br class="hidden md:block"/> Choice Scented Candle Shop
                </h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                @foreach ($newDesigns->slice(0, 3) as $product)
                <a href="{{ route('shop.show', $product->id) }}" class="group"> {{-- 1. ADD 'group' CLASS HERE --}}
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                        <div class="relative bg-gray-200 h-52 flex items-center justify-center">
                            
                            {{-- Sale badge --}}
                            <span class="absolute top-3 left-3 bg-red-500 opacity-90 text-white text-[10px] font-semibold px-2.5 py-1 rounded-full shadow-sm">Sale!</span>
                
                            {{-- cart badge --}}
                            <span class="absolute top-3 right-3 bg-white rounded-full shadow-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="width:28px;height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#F47953" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                                </svg>
                            </span>
                            
                            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover"/>
                        </div>

                        <div class="p-4 text-center">
                            <p class="font-inria font-bold text-sm mb-1">{{ $product->name }}</p>
                            <div class="flex items-center justify-center gap-2 text-xs">
                                <span class="text-red-500 font-semibold">₱{{ number_format($product->price, 2) }}</span>
                                <span class="line-through text-gray-400">₱{{ number_format($product->old_price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-2xl mx-auto">
                @foreach ($newDesigns->slice(3, 2) as $product)
                <a href="{{ route('shop.show', $product->id) }}" class="group"> {{-- 1. ADD 'group' CLASS HERE --}}
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                        <div class="relative bg-gray-200 h-52 flex items-center justify-center">
                            
                            {{-- Sale badge --}}
                            <span class="absolute top-3 left-3 bg-red-500 opacity-90 text-white text-[10px] font-semibold px-2.5 py-1 rounded-full shadow-sm">Sale!</span>
                
                            {{-- cart badge --}}
                            <span class="absolute top-3 right-3 bg-white rounded-full shadow-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="width:28px;height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#F47953" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                                </svg>
                            </span>
                            
                            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover"/>
                        </div>

                        <div class="p-4 text-center">
                            <p class="font-inria font-bold text-sm mb-1">{{ $product['name'] }}</p>
                            <div class="flex items-center justify-center gap-2 text-xs">
                                <span class="text-red-500 font-semibold">₱{{ number_format($product->price, 2) }}</span>
                                <span class="line-through text-gray-400">₱{{ number_format($product->old_price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         BENEFITS SECTION
    ════════════════════════════════════════════ --}}
    <section id="benefits" class="bg-white py-16 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-10">
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-2">Benefits</p>
                <h2 class="font-inria text-4xl md:text-5xl font-bold leading-snug">Scented stories for your favorite spaces.</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
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
    <section id="owner" class="bg-hero-bg py-16 px-6">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-12">
            <div class="flex-shrink-0">
                <img src="{{ asset('images/owner.jpg') }}" alt="Owner" class="w-72 h-72 rounded-full object-cover shadow-md" />
            </div>
            <div>
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-3">About Owner</p>
                <h2 class="font-inria text-3xl md:text-4xl font-bold leading-snug mb-4">Learn More About The Journey Of<br/>The Candle Artist</h2>
                <p class="font-sans text-sm text-gray-600 leading-relaxed mb-6">
                    Welcome to Candles, where candle artistry meets passion for nature's beauty.
                    Our story is rooted in a deep love for scented candles and a commitment to
                    creating unforgettable moments for our customers.
                </p>
                <a href="/about" class="inline-block bg-brand-orange text-white font-sans font-semibold text-sm tracking-widest uppercase px-8 py-3 rounded-full hover:scale-105 shadow-md transition-transform">
                    Read More
                </a>
            </div>
        </div>
    </section>
    
    {{-- ════════════════════════════════════════════
         RECENT EVENTS & CUSTOMERS
    ════════════════════════════════════════════ --}}
    <section id="events" class="py-16 px-6 " style="background-color: #7B1F1F;">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-12">
            <div class="flex-shrink-0 w-full md:w-auto">
                <p class="text-white text-xs text-center font-semibold uppercase tracking-widest mb-4">Recent Events &amp; Customers</p>
                <img src="{{ asset('images/eventcustomer.png') }}" alt="Event Customer" class="rounded-2xl p-6 shadow-md w-full md:w-[340px]" />
            </div>
            <div>
                <p class="text-brand-orange text-xs font-semibold uppercase tracking-widest mb-3">Offer Only For You!</p>
                <h2 class="font-inria text-white text-3xl md:text-4xl font-bold leading-snug mb-6">
                    Start Your Candle Journey Here:<br/>Get 20% Off Your First Order!
                </h2>
                <a href="/shop" class="inline-block bg-brand-orange text-white font-sans font-semibold text-sm tracking-widest uppercase px-8 py-3 rounded-full hover:scale-105 shadow-md transition-transform">
                    Shop Now
                </a>
            </div>
        </div>
    </section>

@endsection