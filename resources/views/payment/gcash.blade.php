@extends('layouts.app')

@section('title', 'Payment | Daily Essentials')

@section('content')

    {{-- ════════════════════════════════════════════
         TOP PAGE HERO
    ════════════════════════════════════════════ --}}
    <section class="relative min-h-[200px] flex flex-col items-center justify-center text-center px-6" 
             style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/bgphoto.png') }}'); background-size: cover; background-position: center;">
        <h1 class="font-inria text-white text-4xl md:text-5xl font-bold tracking-tight mb-2">
            Payment
        </h1>
        <p class="text-white/90 text-sm tracking-widest uppercase font-medium">Finalizing Order #{{ $checkoutData['order_number'] }}</p>
    </section>


    {{-- ════════════════════════════════════════════
          PAYMENT CONTENT
    ════════════════════════════════════════════ --}}
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            {{-- Left Column: QR Code & Instructions --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 text-center overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-brand-orange"></div>
                <h2 class="font-inria text-2xl font-bold text-slate-800 mb-6">Scan to Pay</h2>
                
                <div class="bg-slate-50 p-6 rounded-2xl mb-6 inline-block shadow-inner border border-gray-100">
                    <img src="{{ asset('images/gcash-qr.png') }}" alt="GCash QR Code" class="w-64 h-64 mx-auto rounded-lg">
                </div>

                <div class="space-y-2 mb-8">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400">GCash Details</p>
                    <p class="text-lg font-bold text-slate-800">0912 345 6789</p>
                    <p class="text-sm text-gray-500 italic">Daily Essentials - Focus mode: ON</p>
                </div>

                <div class="bg-orange-50/50 p-4 rounded-2xl border border-orange-100">
                    <p class="text-xs text-orange-700 font-medium leading-relaxed">
                        Please ensure the exact amount of <span class="font-bold">₱{{ number_format($checkoutData['total_amount'], 2) }}</span> is sent to avoid delays in processing.
                    </p>
                </div>
            </div>

            {{-- Right Column: Order Details & Form --}}
            <div class="space-y-8">
                
                {{-- Order Summary Box --}}
                <div class="bg-slate-900 text-white rounded-3xl p-8 shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="font-inria text-xl font-bold">Total Amount Due</h3>
                            <p class="text-white/50 text-xs uppercase tracking-tighter">Order #{{ $checkoutData['order_number'] }}</p>
                        </div>
                        <span class="text-brand-orange text-3xl font-black font-mono">₱{{ number_format($checkoutData['total_amount'], 2) }}</span>
                    </div>

                    <div class="space-y-2">
                        {{-- Loop through the Cart Items --}}
                        @foreach($cartItems as $item)
                        <div class="flex justify-between text-xs text-white/70">
                            <span>{{ $item->quantity }}x {{ $item->product->name }}</span>
                            <span>₱{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Submission Form --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="font-inria text-xl font-bold text-slate-800 mb-6">Submit Proof of Payment</h3>
                    
                    <form action="{{ route('payment.verify') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Reference Number</label>
                            <input type="text" name="reference_number" required
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all font-mono"
                                   placeholder="13-digit Reference No.">
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Payment Screenshot</label>
                            <div class="relative group">
                                <input type="file" name="payment_screenshot" accept="image/*" required
                                       class="w-full px-5 py-3 bg-gray-50 border border-dashed border-gray-200 rounded-2xl file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-orange-100 file:text-brand-orange hover:file:bg-orange-200 cursor-pointer transition-all">
                            </div>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-slate-900 text-white px-8 py-5 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg hover:shadow-orange-200 active:scale-[0.98]">
                            Confirm My Payment
                        </button>
                    </form>
                </div>
                
                {{-- Back Link --}}
                <div class="text-center">
                    <a href="{{ route('checkout.index') }}" class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400 hover:text-brand-orange transition-colors">
                        ← Edit Shipping Info
                    </a>
                </div>
                
            </div>
        </div>
    </div>

@endsection