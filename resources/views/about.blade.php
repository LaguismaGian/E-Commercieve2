@extends('layouts.navbar')

@section('title', 'Our Story | Daily Essentials')

@section('content')

{{-- ════════════════════════════════════════════
     ABOUT US CONTENT
════════════════════════════════════════════ --}}
<div class="bg-white py-12 md:py-20 px-6">
    <div class="max-w-7xl mx-auto">
        
        {{-- Main Intro Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            {{-- Photo --}}
            {{-- Photos Section --}}
            <div class="lg:col-span-5 flex flex-col gap-8 order-2 lg:order-1 mt-4 lg:mt-0">
                
                {{-- Main Top Photo --}}
                <div class="grid grid-cols-2 gap-6 mt-4 md:mt-6">
                    
                    {{-- Second Photo --}}
                    <div class="relative group">
                        <div class="absolute -inset-3 bg-orange-50 rounded-[2rem] transform -rotate-2 transition-transform group-hover:rotate-0 duration-500"></div>
                        <img src="{{ asset('images/candleworksss.jpg') }}" 
                             alt="Our Process" 
                             class="relative w-full h-auto aspect-square object-cover rounded-[2rem] shadow-xl border-4 border-white z-10 transition-transform duration-500 group-hover:scale-[1.05]">
                    </div>

                    {{-- Third Photo --}}
                    <div class="relative group">
                        <div class="absolute -inset-3 bg-orange-50 rounded-[2rem] transform rotate-2 transition-transform group-hover:rotate-0 duration-500"></div>
                        <img src="{{ asset('images/candleworkssss.jpg') }}" 
                             alt="The Ingredients" 
                             class="relative w-full h-auto aspect-square object-cover rounded-[2rem] shadow-xl border-4 border-white z-10 transition-transform duration-500 group-hover:scale-[1.05]">
                    </div>

                </div>

                {{-- Bottom 2 Photos (Side-by-Side Grid) --}}
                <div class="grid grid-cols-2 gap-6 mt-4 md:mt-6">
                    
                    {{-- Second Photo --}}
                    <div class="relative group">
                        <div class="absolute -inset-3 bg-orange-50 rounded-[2rem] transform -rotate-2 transition-transform group-hover:rotate-0 duration-500"></div>
                        <img src="{{ asset('images/candleworks.jpg') }}" 
                             alt="Our Process" 
                             class="relative w-full h-auto aspect-square object-cover rounded-[2rem] shadow-xl border-4 border-white z-10 transition-transform duration-500 group-hover:scale-[1.05]">
                    </div>

                    {{-- Third Photo --}}
                    <div class="relative group">
                        <div class="absolute -inset-3 bg-orange-50 rounded-[2rem] transform rotate-2 transition-transform group-hover:rotate-0 duration-500"></div>
                        <img src="{{ asset('images/candleworkss.jpg') }}" 
                             alt="The Ingredients" 
                             class="relative w-full h-auto aspect-square object-cover rounded-[2rem] shadow-xl border-4 border-white z-10 transition-transform duration-500 group-hover:scale-[1.05]">
                    </div>

                </div>
            </div>
            

            {{-- Story --}}
            <div class="lg:col-span-7 space-y-10 order-1 lg:order-2">
                
                {{-- Our Story --}}
                <div class="relative pl-6 border-l-2 border-brand-orange/30">
                    <span class="absolute top-0 -left-[5px] w-2 h-2 bg-brand-orange rounded-full"></span>
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-gray-400 mb-2">Since the First Wick</p>
                    <h1 class="font-inria text-4xl md:text-5xl font-bold text-gray-900 mb-5 tracking-tight">Our Story</h1>
                    <p class="font-sans text-gray-600 text-sm leading-relaxed max-w-2xl">
                        Daily Essentials didn't start in a boardroom; it started in a small, cozy kitchen filled with a passion for creating atmosphere. What began as a personal hobby to find the perfect, clean-burning scent for our own sanctuary quickly blossomed into a mission to share that feeling of comfort with the world. We believed that a simple candle could elevate the everyday, transforming mundane rituals into moments of reflection and peace.
                    </p>
                </div>

                {{-- Our Craft --}}
                <div class="relative pl-6 border-l-2 border-brand-orange/30">
                    <span class="absolute top-0 -left-[5px] w-2 h-2 bg-brand-orange rounded-full"></span>
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-gray-400 mb-2">Hand-Poured in Small Batches</p>
                    <h2 class="font-inria text-2xl font-bold text-gray-900 mb-4">Our Craft</h2>
                    <p class="font-sans text-gray-600 text-sm leading-relaxed max-w-2xl">
                        To us, a candle is more than wax and wick; it's a sensory experience. That's why every Daily Essentials candle is meticulously hand-poured in small batches, ensuring exceptional quality and attention to detail. We exclusively use 100% natural soy wax for a clean, non-toxic burn, paired with cotton wicks and premium, phthalate-free fragrance oils. This artisan approach guarantees that when you light one of our candles, you are experiencing the true purity of scent.
                    </p>
                </div>

                {{-- Our Mission --}}
                <div class="relative pl-6 border-l-2 border-brand-orange/30">
                    <span class="absolute top-0 -left-[5px] w-2 h-2 bg-brand-orange rounded-full"></span>
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-gray-400 mb-2">Illuminate Your Rituals</p>
                    <h3 class="font-inria text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                    <p class="font-sans text-gray-600 text-sm leading-relaxed max-w-2xl">
                        Our ultimate goal is simple: to help you find your daily essential. Whether you need the invigorating scent of orange to start your morning, the calming waves of lavender to unwind in the evening, or a welcoming fragrance to host loved ones, we exist to illuminate those moments. Thank you for inviting us into your home; we are honored to light your way.
                    </p>
                </div>

            </div>
        </div>
        
        {{-- Core values --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20 pt-16 border-t border-gray-100">
            <div class="bg-slate-50 p-8 rounded-3xl text-center border border-gray-100">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-inner mx-auto mb-6 text-brand-orange border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" /></svg>
                </div>
                <h4 class="font-inria text-lg font-bold text-gray-900 mb-2">Created with Love</h4>
                <p class="font-sans text-gray-500 text-xs leading-relaxed">Every candle is hand-poured with passion and care in Pandi, Bulacan.</p>
            </div>
            
            <div class="bg-slate-50 p-8 rounded-3xl text-center border border-gray-100">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-inner mx-auto mb-6 text-brand-orange border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" /></svg>
                </div>
                <h4 class="font-inria text-lg font-bold text-gray-900 mb-2">100% Natural Soy</h4>
                <p class="font-sans text-gray-500 text-xs leading-relaxed">Enjoy a clean, non-toxic burn that is better for you and the planet.</p>
            </div>
            
            <div class="bg-slate-50 p-8 rounded-3xl text-center border border-gray-100">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-inner mx-auto mb-6 text-brand-orange border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75L4.5 21.75V6.75l3.315-.99c1.303-.39 2.713-.635 4.185-.635m0 17.25c1.472 0 2.882.265 4.185.75l3.315-.99V6.75l-3.315-.99c-1.303-.39-2.713-.635-4.185-.635" /></svg>
                </div>
                <h4 class="font-inria text-lg font-bold text-gray-900 mb-2">Elevated Rituals</h4>
                <p class="font-sans text-gray-500 text-xs leading-relaxed">Turn mundane tasks into moments of focus, relaxation, or celebration.</p>
            </div>
        </div>

    </div>
</div>

@endsection

