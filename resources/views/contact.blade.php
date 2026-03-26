@extends('layouts.app')

@section('title', 'Contact - Candle Glow Shop')
@section('header', 'Contact Candle Glow Shop')
@section('subheader', 'We\'d love to hear from you!')

@section('welcome_message')
    @auth
        🎉 Hi <strong>{{ Auth::user()->name }}</strong>! 
        We're here to help. Fill out the form below and we'll get back to you soon! ✨
    @endauth
@endsection

@section('content')
    <!-- Contact Form -->
    <section class="max-w-4xl mx-auto my-12 p-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold mb-6">Get in Touch</h2>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="" method="POST" class="space-y-4">   
            @csrf
            
            <div>
                <label class="block text-gray-700 mb-1" for="name">Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       placeholder="Your Name" 
                       value="{{ old('name') }}"
                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-gray-700 mb-1" for="email">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       placeholder="Your Email" 
                       value="{{ Auth::user()->email ?? old('email') }}"
                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                       required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-gray-700 mb-1" for="message">Message</label>
                <textarea id="message" 
                          name="message" 
                          placeholder="Your Message" 
                          rows="5" 
                          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                          required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold transition duration-300">
                Send Message
            </button>
        </form>

        <div class="mt-8 text-gray-700">
            <p class="font-semibold">Or contact us at:</p>
            <p>📧 Email: info@candleglowshop.com</p>
            <p>📞 Phone: +63 912 345 6789</p>
            <p>📍 Address: 123 Candle Street, Manila, Philippines</p>
        </div>
    </section>
@endsection