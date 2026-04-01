<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Daily Essentials | Scented Candles')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
     
</head>

<body x-data="{ mobileMenuOpen: false }" class="bg-white text-gray-900 antialiased flex flex-col min-h-screen">

    {{-- ════════════════════════════════════════════
         NAVBAR
    ════════════════════════════════════════════ --}}
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            
            {{-- Hamburger & Logo --}}
            <div class="flex items-center gap-3 flex-1">
                
                {{-- Mobile Hamburger --}}
                <button @click="mobileMenuOpen = true" class="md:hidden text-gray-500 hover:text-brand-orange transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <a href="/" class="flex items-center gap-2 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Daily Essentials Logo" class="w-8 h-8 object-contain group-hover:scale-105 transition-transform">
                    <span class="font-inria font-bold text-xl tracking-tight hidden sm:block text-gray-900">Daily Essentials</span>
                </a>
            </div>

            {{-- Desktop Nav Links --}}
            <nav class="hidden md:flex items-center justify-center gap-8">
                <a href="/" class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ request()->is('/') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">Home</a>
                <a href="/about" class="text-[11px]  font-bold uppercase tracking-widest transition-colors {{ request()->is('about') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">About</a>
                <a href="/shop" class="text-[11px]  font-bold uppercase tracking-widest transition-colors {{ request()->is('shop*') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">Shop</a>
                <a href="/contact" class="text-[11px]  font-bold uppercase tracking-widest transition-colors {{ request()->is('contact') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">Contact</a>
            </nav>

            {{-- Icons --}}
            <div class="flex items-center justify-end gap-4 flex-1">
                
                {{-- login & admin --}}
                @auth
                    <div class="hidden lg:flex flex-col items-end">
                        <span class="text-[9px] font-bold uppercase tracking-widest text-gray-400 leading-tight">Welcome</span>
                        <span class="font-sans text-xs font-semibold text-gray-900 leading-tight">{{ Auth::user()->name }}</span>
                    </div>

                    {{-- Admin Dashboard Button --}}
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hidden lg:flex items-center bg-slate-800 text-white border border-slate-700 px-4 py-1.5 rounded-full text-[9px] font-bold uppercase tracking-widest hover:bg-slate-700 transition-all shadow-sm">
                            Admin Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="font-sans font-bold text-[10px] uppercase tracking-widest text-gray-400 hover:text-brand-orange hidden lg:block transition-colors">
                        Login / Register
                    </a>
                @endauth

                {{-- Icons Group --}}
                <div class="flex items-center gap-4 border-l border-gray-100 pl-4 ml-1">
                    
                    {{-- Profile Icon --}}
                    <a href="{{ Auth::check() ? route('profile') : route('login') }}" class="text-gray-400 hover:text-gray-900 transition-colors hidden sm:block">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                        </svg>
                    </a>
           
                    {{-- Cart Icon --}}
                    <a href="{{ route('cart.index') }}" class="relative text-gray-400 hover:text-brand-orange transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                        </svg>
                        @auth
                            @php $totalQuantity = Auth::user()->cartItems->sum('quantity') ?? 0; @endphp
                            @if($totalQuantity > 0)
                                <span class="absolute -top-2 -right-2 bg-brand-orange text-white text-[9px] font-bold rounded-full w-4 h-4 flex items-center justify-center border-2 border-white shadow-sm">
                                    {{ $totalQuantity }}
                                </span>
                            @endif
                        @endauth
                    </a>
                      
                    {{-- Logout Icon (Desktop) --}}
                    @auth
                        <a href="#" class="text-gray-400 hover:text-red-500 transition-colors hidden sm:block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0-3-3m3 3H9"/>
                            </svg>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                   @endauth
                </div>
            </div>
        </div>
    </header>

    {{-- ════════════════════════════════════════════
         MOBILE MENU DRAWER
    ════════════════════════════════════════════ --}}
    <div x-show="mobileMenuOpen" x-cloak class="fixed inset-0 z-[100] md:hidden">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="mobileMenuOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
        
        <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-2xl flex flex-col p-6"
             x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
            
            <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100">
                <span class="font-inria text-xl font-bold">Menu</span>
                <button @click="mobileMenuOpen = false" class="text-gray-400 hover:text-brand-orange"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>

            <nav class="flex flex-col gap-4">
                <a href="/" class="font-bold text-lg {{ request()->is('/') ? 'text-brand-orange' : 'text-gray-800' }}">Home</a>
                <a href="/about" class="font-bold text-lg {{ request()->is('about') ? 'text-brand-orange' : 'text-gray-800' }}">About</a>
                <a href="/shop" class="font-bold text-lg {{ request()->is('shop*') ? 'text-brand-orange' : 'text-gray-800' }}">Shop</a>
                <a href="/contact" class="font-bold text-lg {{ request()->is('contact') ? 'text-brand-orange' : 'text-gray-800' }}">Contact</a>
            </nav>

            <div class="mt-auto pt-6 border-t border-gray-100 space-y-4">
                @auth
                    <p class="text-sm font-medium text-gray-500">Logged in as <span class="font-bold text-gray-900">{{ Auth::user()->name }}</span></p>
                    <a href="{{ route('profile') }}" class="block w-full text-center bg-gray-50 py-3 rounded-xl font-bold text-sm text-gray-900">My Profile</a>
                    <button onclick="document.getElementById('logout-form').submit();" class="block w-full text-center bg-red-50 text-red-600 py-3 rounded-xl font-bold text-sm">Logout</button>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center bg-brand-orange text-white py-3 rounded-xl font-bold text-sm">Login</a>
                    <a href="{{ route('register') }}" class="block w-full text-center bg-gray-50 text-gray-900 py-3 rounded-xl font-bold text-sm border border-gray-200">Create Account</a>
                @endauth
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════
         MAIN CONTENT INJECTED HERE
    ════════════════════════════════════════════ --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- ════════════════════════════════════════════
         FOOTER
    ════════════════════════════════════════════ --}}
    <footer class="bg-gray-50 border-t border-gray-100 pt-10 pb-6 px-6 font-sans text-gray-600">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                {{-- Brand --}}
                <div class="md:col-span-1">
                    <h3 class="font-inria text-xl text-gray-900 mb-2">Daily Essentials</h3>
                    <p class="text-[13px] leading-relaxed text-gray-500">
                        Welcome to the world of Daily Essentials, where quality meets care with love and creativity. Discover our story and passion for excellence.
                    </p>
                </div>

                {{-- Links --}}
                <div class="md:pl-4">
                    <h3 class="font-bold text-gray-900 text-[10px] uppercase tracking-widest mb-3">Quick Links</h3>
                    <ul class="space-y-1.5 text-[13px]">
                        <li><a href="/" class="hover:text-brand-orange transition-colors">Home</a></li>
                        <li><a href="/about" class="hover:text-brand-orange transition-colors">About Us</a></li>
                        <li><a href="/shop" class="hover:text-brand-orange transition-colors">Shop Collection</a></li>
                        <li><a href="/contact" class="hover:text-brand-orange transition-colors">Contact Support</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h3 class="font-bold text-gray-900 text-[10px] uppercase tracking-widest mb-3">Contact Info</h3>
                    <ul class="space-y-1.5 text-[13px] text-gray-500">
                        <li>Santa Maria, Bulacan</li>
                        <li>ebardonenikko@gmail.com</li>
                        <li>09499383628</li>
                    </ul>
                </div>

                {{-- Socials & Scroll --}}
                <div class="flex flex-col items-start md:items-end justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900 text-[10px] uppercase tracking-widest mb-3 md:text-right">Follow Us</h3>
                        <div class="flex gap-4">
                            <a href="{{ env('FACEBOOK_URL') }}" target="_blank" class="text-gray-400 hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-pink-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.058-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.44-.645-1.44-1.44s.645-1.44 1.44-1.44z"/></svg>
                            </a>
                        </div>
                    </div>
                    
                    {{-- Scroll to Top Button --}}
                    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="hidden md:flex bg-slate-900 text-white p-2.5 rounded-full hover:bg-brand-orange transition-colors shadow-sm mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" /></svg>
                    </button>
                </div>
            </div>
            
            {{-- Copyright (Centered) --}}
            <div class="border-t border-gray-200 pt-5 text-xs text-center text-gray-400">
                <p>Copyright &copy; {{ date('Y') }} Daily Essentials Shop</p>
            </div>
        </div>
    </footer>

</body>
</html>