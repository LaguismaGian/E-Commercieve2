@extends('layouts.app')

@section('title', 'Your Cart | Daily Essentials')

@section('content')

    {{-- ════════════════════════════════════════════
         TOP PAGE HERO
    ════════════════════════════════════════════ --}}
    <section class="relative min-h-[200px] flex flex-col items-center justify-center text-center px-6" 
             style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/bgphoto.png') }}'); background-size: cover; background-position: center;">
        <h1 class="font-inria text-white text-4xl md:text-5xl font-bold tracking-tight mb-2">
            Your Shopping Cart
        </h1>
        <p class="text-white/90 text-sm tracking-widest uppercase font-medium">Review your items before checkout</p>
    </section>
    
    {{-- ════════════════════════════════════════════
         CART CONTENT
    ════════════════════════════════════════════ --}}
    <main class="max-w-7xl mx-auto px-6 py-12">
        
        {{-- Success Message (Now using Tailwind animation instead of JS) --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-100 text-green-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 animate-fade-out shadow-sm">
                <div class="bg-green-500 text-white rounded-full p-1 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <span class="font-bold text-sm tracking-wide">{{ session('success') }}</span>
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

        @if($cartItems->count() > 0)
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                
                {{-- ⚡ ADDED: Responsive Wrapper for Mobile --}}
                <div class="overflow-x-auto">
                    {{-- ⚡ ADDED: min-w-[700px] ensures it doesn't crush on phones --}}
                    <table class="w-full text-left min-w-[700px]">
                        <thead class="bg-gray-50/50 border-b border-gray-100">
                            <tr>
                                <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Product</th>
                                <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Price</th>
                                <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Quantity</th>
                                <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Subtotal</th>
                                <th class="p-6"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50">
                            @foreach($cartItems as $item)
                            <tr class="group hover:bg-gray-50/50 transition-colors">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-20 h-20 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex-shrink-0">
                                            @if($item->product->image)
                                                <img src="{{ asset('storage/images/' . $item->product->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-2xl">🕯️</div>
                                            @endif
                                        </div>

                                        {{-- Product Info with Scent Display --}}
                                        <div>
                                            <a href="{{ route('shop.show', $item->product->id) }}" class="font-inria font-bold text-gray-900 text-lg group-hover:text-brand-orange transition-colors">
                                                {{ $item->product->name }}
                                            </a>
                                            <div class="flex flex-col gap-1 mt-1">
                                                <span class="text-[10px] text-orange-500 font-bold uppercase tracking-tighter">
                                                    {{ $item->product->category }}
                                                </span>
                                                
                                                {{-- Display the selected scent --}}
                                                <div class="flex items-center gap-1.5 mt-1">
                                                    <span class="text-[11px] text-gray-400 font-medium uppercase tracking-widest">Scent:</span>
                                                    <span class="text-[11px] text-gray-700 font-bold bg-gray-100 px-2 py-0.5 rounded-full border border-gray-200">
                                                        {{ $item->scent ?? 'Default' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6 text-center font-medium text-gray-600">₱{{ number_format($item->product->price, 2) }}</td>
                                <td class="p-6">
                                    <div class="flex items-center justify-center gap-3">
                                        <form action="{{ route('cart.update', $item) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                            <button type="submit" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-white hover:border-orange-500 hover:text-brand-orange hover:shadow-sm transition-all" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                        </form>
                                        <span class="w-8 text-center font-bold">{{ $item->quantity }}</span>
                                        <form action="{{ route('cart.update', $item) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                            <button type="submit" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-white hover:border-orange-500 hover:text-brand-orange hover:shadow-sm transition-all" {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>+</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="p-6 text-center font-bold text-gray-900">₱{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                <td class="p-6 text-right">
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-12 flex flex-col md:flex-row justify-between items-start gap-8">
                <div class="space-y-4">
                    <a href="/shop" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-orange-500 transition-colors uppercase tracking-widest">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>

                <div class="w-full md:w-96 bg-gray-50 rounded-[2rem] p-8 space-y-6 border border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500 font-medium">Subtotal</span>
                        <span class="font-bold text-gray-900">₱{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-200 pt-4">
                        <span class="text-lg font-inria font-bold text-gray-900">Total</span>
                        <span class="text-2xl font-bold text-orange-600">₱{{ number_format($total, 2) }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="block w-full bg-slate-900 text-white text-center py-4 rounded-full font-bold shadow-lg hover:bg-orange-500 transition-all active:scale-95 text-xs tracking-[0.2em]">
                        PROCEED TO CHECKOUT
                    </a>
                </div>
            </div>

        @else
            <div class="text-center py-24 bg-gray-50 rounded-[3rem] border border-dashed border-gray-200 mx-auto max-w-3xl">
                <div class="text-6xl mb-6 opacity-20">🛒</div>
                <h2 class="font-inria text-2xl font-bold text-gray-900 mb-2">Your cart is currently empty</h2>
                <p class="text-gray-500 mb-8">Looks like you haven't added any candles yet.</p>
                <a href="/shop" class="inline-block bg-slate-900 text-white px-10 py-4 rounded-full font-bold shadow-lg hover:bg-orange-500 transition-all active:scale-95 text-xs tracking-widest uppercase">
                    Start Shopping
                </a>
            </div>
        @endif
    </main>

@endsection