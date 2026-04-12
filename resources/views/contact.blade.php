@extends('layouts.navbar')

@section('title', 'Contact Us | Daily Essentials')

@section('content')

    {{-- ════════════════════════════════════════════
         CONTACT 
    ════════════════════════════════════════════ --}}
    <div class="bg-section-bg py-12 px-6">
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

            {{-- Social Media Card --}}
            <div class="order-1 lg:order-2 flex flex-col justify-center h-full">
                <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-50 p-8 md:p-12 relative overflow-hidden text-center flex flex-col justify-center min-h-[350px]">
                    
                    {{-- Decorative top border --}}
                    <div class="absolute top-0 left-0 w-full h-2 bg-brand-orange"></div>
                    
                    <h3 class="font-inria text-3xl font-bold text-gray-900 mb-3">Send a message here</h3>
                    <p class="text-sm text-gray-500 mb-8 max-w-sm mx-auto">Connect with us directly through our social media channels. We reply fast!</p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        
                        {{-- Facebook Button --}}
                        <a href="https://www.facebook.com/profile.php?id=61571638290459" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto flex items-center justify-center gap-3 bg-gray-50 hover:bg-[#ebf4ff] text-gray-700 hover:text-[#1877F2] px-8 py-4 rounded-2xl transition-all duration-300 border border-gray-100 shadow-sm group">
                            <svg class="w-6 h-6 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-bold text-sm tracking-wide">Facebook</span>
                        </a>

                        {{-- Instagram Button --}}
                        <a href="https://www.instagram.com/neil_cutterr?igsh=MWYzZ2oyaWt5azdsNg%3D%3D" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto flex items-center justify-center gap-3 bg-gray-50 hover:bg-[#fdf2f8] text-gray-700 hover:text-[#E4405F] px-8 py-4 rounded-2xl transition-all duration-300 border border-gray-100 shadow-sm group">
                            <svg class="w-6 h-6 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-bold text-sm tracking-wide">Instagram</span>
                        </a>

                    </div>
                </div>
            </div>
            
        </div>
    </div>

@endsection