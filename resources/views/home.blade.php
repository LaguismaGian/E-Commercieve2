@extends('layouts.app')

@section('title', 'Candle Glow Shop')
@section('header', 'Candle Glow Shop')
@section('subheader', 'Handmade candles for every mood')

@section('welcome_message')
    @auth
        🎉 Welcome to Candle Glow Shop, <strong>{{ Auth::user()->name }}</strong>! 
        We're so glad to have you here. ✨
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

    <!-- Products Section - Static placeholder products -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <div class="bg-white rounded-lg shadow-md text-center p-4">
            <img src="https://via.placeholder.com/220x220.png?text=Candle+1" alt="Vanilla Delight" class="w-full rounded-md">
            <h3 class="mt-3 font-bold text-lg">Vanilla Delight</h3>
            <p class="text-gray-600 mt-1 text-sm">Sweet vanilla scented candle</p>
            <span class="text-orange-500 font-semibold mt-2 block">$12.99</span>
            <a href="#" class="inline-block mt-3 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">Buy Now</a>
        </div>

        <div class="bg-white rounded-lg shadow-md text-center p-4">
            <img src="https://via.placeholder.com/220x220.png?text=Candle+2" alt="Lavender Bliss" class="w-full rounded-md">
            <h3 class="mt-3 font-bold text-lg">Lavender Bliss</h3>
            <p class="text-gray-600 mt-1 text-sm">Relaxing lavender aroma</p>
            <span class="text-orange-500 font-semibold mt-2 block">$14.99</span>
            <a href="#" class="inline-block mt-3 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">Buy Now</a>
        </div>

        <div class="bg-white rounded-lg shadow-md text-center p-4">
            <img src="https://via.placeholder.com/220x220.png?text=Candle+3" alt="Citrus Sunrise" class="w-full rounded-md">
            <h3 class="mt-3 font-bold text-lg">Citrus Sunrise</h3>
            <p class="text-gray-600 mt-1 text-sm">Fresh and zesty citrus scent</p>
            <span class="text-orange-500 font-semibold mt-2 block">$11.99</span>
            <a href="#" class="inline-block mt-3 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">Buy Now</a>
        </div>

        <div class="bg-white rounded-lg shadow-md text-center p-4">
            <img src="https://via.placeholder.com/220x220.png?text=Candle+4" alt="Rose Garden" class="w-full rounded-md">
            <h3 class="mt-3 font-bold text-lg">Rose Garden</h3>
            <p class="text-gray-600 mt-1 text-sm">Romantic rose fragrance</p>
            <span class="text-orange-500 font-semibold mt-2 block">$15.99</span>
            <a href="#" class="inline-block mt-3 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">Buy Now</a>
        </div>
    </section>
@endsection