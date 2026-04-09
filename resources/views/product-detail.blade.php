@extends('layouts.navbar')

@section('title', $product->name . ' | Daily Essentials')

@section('content')

    {{-- Product Details --}}
    <main class="max-w-7xl mx-auto px-6 py-12" 
    x-data="{
        mainImage: '{{ asset('images/products/' . $product->image) }}',
        quantity: 1,
        selectedScent: 'Rose', {{-- Default scent --}}
        isFavorite: false,
        maxStock: {{ $product->stock }}
    }">
        <div class="flex flex-col lg:flex-row gap-12">
            
            {{-- Image Gallery --}}
            <div class="w-full lg:w-1/2 space-y-4">
                <div class="relative bg-gray-50 rounded-[2rem] overflow-hidden aspect-square flex items-center justify-center border border-gray-100 shadow-inner">
                    
                {{-- Sale Badge --}}
                    @if($product->on_sale)
                        <span class="absolute top-6 left-6 bg-red-500 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full shadow-lg z-10">
                            Sale!
                        </span>
                    @endif

                    <img :src="mainImage" class="w-full h-full object-cover transition-all duration-700 hover:scale-105">
                </div>
    
                <div class="flex gap-4">
    <button @click="mainImage = '{{ asset('images/products/' . $product->image) }}'" 
            class="w-20 h-20 rounded-2xl overflow-hidden border-2 transition-all shadow-sm"
            :class="mainImage === '{{ asset('images/products/' . $product->image) }}' ? 'border-orange-500 ring-4 ring-orange-50' : 'border-transparent opacity-60 hover:opacity-100'">
        <img src="{{ asset('images/products/' . $product->image) }}" class="w-full h-full object-cover">
    </button> 
</div>
            </div>
    
            {{-- Product Info --}}
            <div class="w-full lg:w-1/2 space-y-8">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-[11px] text-orange-500 font-bold uppercase tracking-[0.2em]">{{ $product->category }}</span>
                    </div>
                    <h1 class="font-inria text-5xl font-bold text-gray-900 leading-tight mb-4 italic">{{ $product->name }}</h1>
                    
                    <div class="flex items-center gap-4">
                        <span class="text-3xl text-brand-red font-bold ">
                            @if($product->price <= 0)
                                Price varies
                            @else
                                ₱{{ number_format($product->price, 2) }}
                            @endif
                        </span>
                        @if($product->old_price)
                            <span class="text-xl text-gray-400 line-through">₱{{ number_format($product->old_price, 2) }}</span>
                        @endif

                        {{-- Grams and Stock status --}}
                        <div class="flex items-center gap-2 ml-auto">
                            
                            <span class="flex items-center gap-1.5 text-[10px] font-bold text-gray-600 uppercase tracking-widest bg-green-50 px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-600 animate-pulse"></span> 
                                    {{ $product->grams }} 
                            </span>
                            
                            @if($product->stock > 1)
                                <span class="flex items-center gap-1.5 text-[10px] font-bold text-green-600 uppercase tracking-widest bg-green-50 px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> 
                                    {{ $product->stock }} In Stock
                                </span>
                            @elseif($product->stock > 0)
                                <span class="flex items-center gap-1.5 text-[10px] font-bold text-orange-600 uppercase tracking-widest bg-orange-50 px-3 py-1 rounded-full">
                                    Only {{ $product->stock }} left
                                </span>
                            @else
                                <span class="text-[10px] font-bold text-red-600 uppercase tracking-widest bg-red-50 px-3 py-1 rounded-full">
                                    Sold Out
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="prose prose-sm">
                    <p class="text-gray-600 leading-relaxed text-base">
                        {{ $product->description }}
                    </p>
                </div>
    
                <hr class="border-gray-100">
    
                {{-- Scent Selector --}}
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
                
                <div>
                    <h3 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-5">Select Fragrance</h3>
                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-x-3 gap-y-6">
                        
                        @foreach($scents as $scent)
                            <div class="flex flex-col items-center group cursor-pointer" @click="selectedScent = '{{ $scent['name'] }}'">
                                <button type="button"
                                        class="w-12 h-12 rounded-full border-2 transition-all hover:scale-110 overflow-hidden mb-2 shadow-sm"
                                        :class="selectedScent === '{{ $scent['name'] }}' ? 'border-orange-500 ring-4 ring-orange-50' : 'border-gray-100'">
                                    <img src="{{ asset('images/scents/' . $scent['image']) }}" alt="{{ $scent['name'] }}" class="w-full h-full object-cover">
                                </button>
                                <span class="text-[9px] uppercase tracking-wider font-bold text-center leading-tight transition-colors"
                                      :class="selectedScent === '{{ $scent['name'] }}' ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-600'">
                                    {{ $scent['name'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
    

                {{-- Quantity and Actions --}}
                <div class="flex flex-col sm:flex-row items-center gap-4 pt-6">
                    
                    {{-- Enhanced Quantity Selector --}}
                    <div class="flex items-center bg-gray-100 rounded-full p-1 border border-gray-200">
                        <button @click="if(quantity > 1) quantity--" 
                                type="button" {{-- Critical: ensure this isn't a submit button --}}
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-sm text-gray-600 hover:text-orange-600 transition-colors disabled:opacity-50"
                                :disabled="quantity <= 1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                        </button>
            
                        <span class="w-12 text-center font-bold text-gray-900" x-text="quantity"></span>
            
                        <button @click="if(quantity < maxStock) quantity++" 
                                type="button"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-sm text-gray-600 hover:text-orange-600 transition-colors disabled:opacity-50"
                                :disabled="quantity >= maxStock">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
            
                    {{-- Add to cart form --}}
                    @auth
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1 w-full">
                            @csrf
                            {{-- These inputs MUST have the :value binding to stay in sync with Alpine --}}
                            <input type="hidden" name="quantity" :value="quantity">
                            <input type="hidden" name="scent" :value="selectedScent">
                            
                            <button type="submit" 
                                class="w-full py-4 rounded-full font-bold transition-all shadow-xl active:scale-95 tracking-widest text-xs
                                {{ $product->stock > 0 
                                    ? 'bg-orange-600 text-white hover:bg-orange-700 shadow-orange-100' 
                                    : 'bg-gray-200 text-gray-400 cursor-not-allowed shadow-none' }}"
                                {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                {{ $product->stock > 0 ? 'ADD TO COLLECTION' : 'OUT OF STOCK' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                           class="flex-1 w-full bg-gray-900 text-white font-bold py-4 rounded-full text-center hover:bg-gray-800 transition-all shadow-lg text-xs tracking-widest uppercase">
                            Sign in to Order
                        </a>
                    @endauth

                    {{-- Add to favorite --}}
                    <button @click="isFavorite = !isFavorite" 
                            class="group w-14 h-14 flex items-center justify-center rounded-full border transition-all duration-300"
                            :class="isFavorite ? 'bg-red-50 border-red-100 shadow-inner' : 'bg-white border-gray-100 hover:border-red-200 hover:bg-red-50/30'">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             :fill="isFavorite ? '#ef4444' : 'none'" 
                             viewBox="0 0 24 24" 
                             stroke-width="1.5" 
                             :stroke="isFavorite ? '#ef4444' : 'currentColor'" 
                             class="w-6 h-6 transition-transform group-active:scale-125"
                             :class="!isFavorite ? 'text-gray-400 group-hover:text-red-400' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </main>

@endsection