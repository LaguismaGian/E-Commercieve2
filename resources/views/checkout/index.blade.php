@extends('layouts.navbar')

@section('title', 'Checkout | Daily Essentials')

@section('content')

    {{-- ════════════════════════════════════════════
         TOP PAGE HERO
    ════════════════════════════════════════════ --}}
    <section class="relative min-h-[200px] flex flex-col items-center justify-center text-center px-6" 
             style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/bgphoto2.png') }}'); background-size: cover; background-position: center;">
        <h1 class="font-inria text-white text-4xl md:text-5xl font-bold tracking-tight mb-2">
            Checkout
        </h1>
        <p class="text-white/90 text-sm tracking-widest uppercase font-medium">Finalize your scented collection</p>
    </section>

    {{-- ════════════════════════════════════════════
          CHECKOUT CONTENT 
    ════════════════════════════════════════════ --}}
    <div class="max-w-7xl mx-auto px-6 py-12">
        
        {{-- Error Message  --}}
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-r-2xl mb-8 flex items-center gap-3">
                <span class="text-xl">⚠️</span>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            {{-- Order Summary Column --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sticky top-24">
                    <h2 class="font-inria text-2xl font-bold mb-6 text-slate-800">Order Summary</h2>
                    
                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cartItems as $item)
                        <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                            <div class="flex-1">
                                <p class="font-bold text-slate-800">{{ $item->product->name }}</p>
                                <p class="text-xs text-brand-orange font-bold uppercase tracking-widest">Scent: {{ $item->scent ?? 'Original' }}</p>
                                <p class="text-sm text-gray-500 mt-1">Qty: {{ $item->quantity }}</p>
                            </div>
                            <p class="font-bold text-slate-900 font-mono">₱{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 pt-6 border-t-2 border-dashed border-gray-100">
                        <div class="flex justify-between items-center text-lg">
                            <span class="font-inria font-bold text-gray-600">Total:</span>
                            <span class="text-brand-orange text-2xl font-black">₱{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Shipping Details Column --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-orange-50 rounded-2xl flex items-center justify-center text-brand-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <h2 class="font-inria text-3xl font-bold text-slate-800">Shipping Details</h2>
                    </div>
                    
                    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                        @csrf

                        @foreach($selectedItems as $itemId)
                            <input type="hidden" name="selected_items[]" value="{{ $itemId }}">
                        @endforeach
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Street Address</label>
                                <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" required
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all"
                                       placeholder="Block, Lot, Street, Barangay">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">City / Province</label>
                                <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all"
                                       placeholder="e.g. Pandi, Bulacan">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Postal Code</label>
                                <input type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code') }}"
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all"
                                       placeholder="3014">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Phone Number</label>
                                <input type="tel" name="shipping_phone" value="{{ old('shipping_phone') }}" required
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all"
                                       placeholder="0912 345 6789">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Payment Method</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <label class="relative flex items-center p-4 border rounded-2xl cursor-pointer hover:bg-orange-50 transition-colors group">
                                        <input type="radio" name="payment_method" value="gcash" checked class="w-4 h-4 text-brand-orange border-gray-300 focus:ring-brand-orange">
                                        <span class="ml-3 font-bold text-slate-700 group-hover:text-brand-orange">GCash</span>
                                    </label>
                                    <label class="relative flex items-center p-4 border rounded-2xl cursor-pointer hover:bg-orange-50 transition-colors group">
                                        <input type="radio" name="payment_method" value="cod" class="w-4 h-4 text-brand-orange border-gray-300 focus:ring-brand-orange">
                                        <span class="ml-3 font-bold text-slate-700 group-hover:text-brand-orange">Cash on Delivery</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4 mt-12">
                            <a href="{{ route('cart.index') }}" 
                               class="order-2 sm:order-1 px-8 py-4 rounded-2xl font-bold text-gray-400 hover:text-gray-600 transition-colors text-center">
                                ← Return to Cart
                            </a>
                            <button type="submit" 
                                    class="order-1 sm:order-2 flex-1 bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg shadow-slate-200 hover:shadow-orange-200">
                                Complete Purchase
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection