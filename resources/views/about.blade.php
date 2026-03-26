@extends('layouts.app')

@section('title', 'About - Candle Glow Shop')
@section('header', 'About Candle Glow Shop')
@section('subheader', 'Handmade candles for every mood')

@section('welcome_message')
    @auth
        🎉 Welcome to Candle Glow Shop, <strong>{{ Auth::user()->name }}</strong>! 
        We're so glad to have you here. ✨
    @endauth
@endsection

@section('content')
    <!-- About Content -->
    <section class="max-w-4xl mx-auto my-12 p-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">Who We Are</h2>
        <p class="text-gray-700 mb-4">
            Candle Glow Shop is dedicated to creating handmade candles that brighten your home and lift your mood.
            Our candles are crafted with care, using high-quality wax and natural fragrances.
        </p>
        <p class="text-gray-700 mb-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
        <img src="https://via.placeholder.com/600x300.png?text=Our+Team+or+Workshop" alt="About placeholder" class="rounded w-full mt-4">
    </section>
@endsection