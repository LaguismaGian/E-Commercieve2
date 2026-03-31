@extends('layouts.app')

@section('title', 'Contact Us | Daily Essentials')

@section('content')

    {{-- ════════════════════════════════════════════
         CONTACT 
    ════════════════════════════════════════════ --}}
    <div class="bg-section-bg py-12  px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            {{-- Circle Image & Info --}}
            <div class="flex flex-col items-center lg:items-start text-center lg:text-left order-2 lg:order-1">
                
                
                <div class="relative w-64 h-64 md:w-80 md:h-80 mb-10 group">
                    <div class="absolute inset-0 bg-orange-100 rounded-full transform -translate-x-4 translate-y-4 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 duration-500"></div>
                    <img src="{{ asset('images/contact.jpg') }}" alt="Contact Us" class="relative w-full h-full object-cover rounded-full shadow-lg border-8 border-white z-10 transition-transform duration-500 group-hover:scale-105">
                </div>
                
                <h1 class="font-inria text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">We'd love to hear from you.</h1>
                <p class="text-gray-600 mb-10 max-w-md text-sm leading-relaxed">
                    Whether you have a question about our scented candles, need help with an order, or want to discuss custom candles for an event, our team is ready to answer all your questions.
                </p>
                
                {{-- Contact Info --}}
                <div class="space-y-5">
                    <div class="flex items-center gap-4 text-gray-600 justify-center lg:justify-start">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm text-brand-orange border border-gray-50 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Location</p>
                            <p class="font-medium text-sm text-gray-900">Santa Maria, Bulacan</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 text-gray-600 justify-center lg:justify-start">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm text-brand-orange border border-gray-50 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Email</p>
                            <p class="font-medium text-sm text-gray-900">ebardonenikko@gmail.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 text-gray-600 justify-center lg:justify-start">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm text-brand-orange border border-gray-50 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.265-4.09-6.873-6.916l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Phone</p>
                            <p class="font-medium text-sm text-gray-900">09499383628</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card Form --}}
            <div class="order-1 lg:order-2">
                <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-50 p-8 md:p-12 relative overflow-hidden">
                    
                    {{-- Decorative top border --}}
                    <div class="absolute top-0 left-0 w-full h-2 bg-brand-orange"></div>
                    
                    <h3 class="font-inria text-2xl font-bold text-gray-900 mb-8">Send us a message</h3>
                    
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-100 text-green-700 px-5 py-4 rounded-2xl mb-6 flex items-center gap-3 animate-fade-out">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-green-500">
                              <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-bold text-sm tracking-wide">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">   
                        @csrf
                        
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1" for="name">Name</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Your Full Name" 
                                   value="{{ old('name') }}"
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm"
                                   required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1" for="email">Email Address</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   placeholder="hello@example.com" 
                                   value="{{ Auth::user()->email ?? old('email') }}"
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm"
                                   required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1" for="message">Message</label>
                            <textarea id="message" 
                                      name="message" 
                                      placeholder="How can we help you today?" 
                                      rows="4" 
                                      class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm resize-none"
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="pt-2">
                            <button type="submit" class="w-full bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg hover:shadow-orange-200 active:scale-[0.98] tracking-widest uppercase text-xs">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

@endsection