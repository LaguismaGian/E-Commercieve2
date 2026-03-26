@extends('layouts.app')

@section('title', 'Shop - Candle Glow Shop')
@section('header', 'Shop Candles')
@section('subheader', 'Find the perfect scent for your space')

@section('welcome_message')
    @auth
        🎉 Welcome back, <strong>{{ Auth::user()->name }}</strong>! 
        Ready to find your next favorite candle? ✨
    @endauth
@endsection

@section('content')
    <!-- Admin Quick Actions (only visible to admin) -->
    @auth
        @if(Auth::user()->isAdmin())
            <div class="flex justify-center gap-4 mt-4">
                <a href="{{ route('admin.products.create') }}" 
                   class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-semibold shadow-md">
                    ➕ Add New Product
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 font-semibold shadow-md">
                    📋 View All Products
                </a>
            </div>
        @endif
    @endauth

    <!-- Shop Products -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-md text-center p-4 hover:shadow-lg transition duration-300">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover rounded-md">
                @else
                    <div class="w-full h-48 bg-gray-200 rounded-md flex items-center justify-center text-4xl">
                        🕯️
                    </div>
                @endif
                
                <h3 class="mt-3 font-bold text-lg">{{ $product->name }}</h3>
                <p class="text-gray-600 mt-1 text-sm">{{ Str::limit($product->description, 60) }}</p>
                
                @if($product->category)
                    <p class="text-gray-400 text-xs mt-1">{{ $product->category }}</p>
                @endif
                
                <span class="text-orange-500 font-semibold mt-2 block text-xl">₱{{ number_format($product->price, 2) }}</span>
                
                @if($product->stock > 0)
                    <p class="text-green-500 text-xs mt-1">✓ In Stock ({{ $product->stock }} available)</p>
                @else
                    <p class="text-red-500 text-xs mt-1">✗ Out of Stock</p>
                @endif
                
                @auth
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="inline-block mt-3 px-4 py-2 {{ $product->stock > 0 ? 'bg-orange-500 hover:bg-orange-600' : 'bg-gray-400 cursor-not-allowed' }} text-white rounded font-semibold w-full transition duration-300"
                                {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            {{ $product->stock > 0 ? '🛒 Add to Cart' : 'Out of Stock' }}
                        </button>
                    </form>
                @else
                    <a href="/login" class="inline-block mt-3 px-4 py-2 bg-gray-500 text-white rounded font-semibold w-full text-center">
                        Login to Buy
                    </a>
                @endauth
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No products available yet. Check back soon!</p>
            </div>
        @endforelse
    </section>
@endsection