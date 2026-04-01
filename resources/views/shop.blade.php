@extends('layouts.navbar')

@section('title', 'Shop | Daily Essentials')

@section('content')

<div x-data="{ currentCategory: 'All' }">

    {{-- ════════════════════════════════════════════
         TOP PAGE HERO
    ════════════════════════════════════════════ --}}
    <section class="relative min-h-[250px] flex items-center justify-center text-center px-6" 
             style="background-image: url('{{ asset('images/bgphoto2.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
             
        <h1 class="font-inria text-white text-4xl md:text-5xl font-bold tracking-tight">
            Get All Your Favorite Candles!
        </h1>
    </section>

    {{-- ════════════════════════════════════════════
         SHOP MAIN CONTENT
    ════════════════════════════════════════════ --}}
    <main class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row gap-12">
        
        {{-- Category Menu --}}
        <aside class="w-full md:w-64 flex-shrink-0">
            <h3 class="font-inria text-xl font-bold mb-6 pb-2 border-b border-gray-100">Categories</h3>
            <ul class="space-y-4">
                <li>
                    <button @click="currentCategory = 'All'" 
                            :class="currentCategory === 'All' ? 'text-brand-orange font-bold border-l-[3px] border-brand-orange pl-3' : 'text-gray-600 border-l-[3px] border-transparent pl-3'"
                            class="text-sm hover:text-orange-500 transition-all text-left w-full">
                        All Products
                    </button>
                </li>
                @php
                    $categories = [
                        'Dessert Candles' => 3,
                        'Unique Candles' => 13,
                        'Flower Candles' => 3,
                        // 'Adult Candles' => 2
                    ];
                @endphp

                @foreach($categories as $name => $count)
                <li>
                    <button @click="currentCategory = '{{ $name }}'" 
                            :class="currentCategory === '{{ $name }}' ? 'text-brand-orange font-bold border-l-[3px] border-brand-orange pl-3' : 'text-gray-600 border-l-[3px] border-transparent pl-3'"
                            class="text-sm hover:text-orange-500 transition-all flex justify-between w-full">
                        <span>{{ $name }}</span>
                        <span class="text-gray-300 text-xs">({{ $count }})</span>
                    </button>
                </li>
                @endforeach
                
            </ul>
        </aside>

        {{-- Product Grid --}}
        <div class="flex-1">
            
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

            {{-- Display of products --}}
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
                @foreach($products as $product)
                    <a href="{{ route('shop.show', $product->id) }}"
                       x-show="currentCategory === 'All' || currentCategory === '{{ $product->category }}'"
                       x-transition.opacity
                       class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-50">
                        
                        <div class="relative bg-gray-200 h-48 flex items-center justify-center">

                            {{-- Cart Icon  --}}
                            <span class="absolute top-3 right-3 bg-white rounded-full shadow-sm flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="width:32px;height:32px;">
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
                            <img src="{{ asset('images/products/' . $product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}"/>
                        </div>
                
                        <div class="p-4">
                            <p class="text-[10px] text-orange-500 font-bold uppercase tracking-wider mb-1">
                                {{ $product->category }}
                            </p>
                            
                            <h4 class="font-inria font-bold text-sm mb-1 text-gray-900">
                                {{ $product->name }}
                            </h4>
                            
                            <div class="flex items-center gap-2">
                                <p class="text-brand-red font-semibold text-sm">
                                    @if($product->price <= 0)
                                        ₱Varies from design
                                    @else
                                        ₱{{ number_format($product->price, 2) }}
                                    @endif
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
</div>

@endsection