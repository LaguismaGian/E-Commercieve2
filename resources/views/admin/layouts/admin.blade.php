<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Daily Essentials</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Instrument Serif', serif; }
        .text-brand-orange { color: #F47953; }
        .bg-brand-orange { background-color: #F47953; }
        
        [x-cloak] { display: none !important; }

        .fade-out { animation: fadeOut 0.5s ease-out 3s forwards; }
        @keyframes fadeOut { to { opacity: 0; visibility: hidden; height: 0; margin: 0; padding: 0; } }
    </style>
</head>

<body 
    x-data="{ mobileMenuOpen: false }" 
    class="bg-[#FAFAFA] text-gray-900 selection:bg-orange-100 selection:text-orange-900 min-h-screen flex flex-col"
>

    {{-- ════════════════════════════════════════════
          ADMIN NAVBAR
    ════════════════════════════════════════════ --}}
    <nav class="bg-white border-b border-gray-100 py-4 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            
            {{-- Logo & Brand --}}
            <div class="flex items-center gap-2 sm:gap-4">

                {{-- Mobile Menu Toggle --}}
                <button @click="mobileMenuOpen = true" class="md:hidden p-2 -ml-2 text-gray-400 hover:text-brand-orange transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <img src="{{ asset('images/logo.png') }}" alt="Daily Essentials Logo" class="w-8 h-8 sm:w-10 sm:h-10 flex-shrink-0">
                <h1 class="font-serif text-xl sm:text-2xl font-bold tracking-tight text-slate-900 whitespace-nowrap">Admin Dashboard</h1>
            </div>

            {{-- Navigation Links (Desktop Only) --}}
            <div class="hidden md:flex items-center gap-8 bg-gray-50 px-6 py-2 rounded-full border border-gray-100">
                <a href="{{ route('admin.dashboard') }}" 
                   class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">
                    Overview
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('admin.products.*') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">
                    Catalog
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('admin.orders.*') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">
                    Orders
                </a>
                <a href="{{ route('admin.users.index') }}" 
                   class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('admin.users.*') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">
                    Customers
                </a>
            </div>

            {{-- User Actions --}}
            <div class="flex items-center gap-4">
                <div class="text-right hidden lg:block">
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Admin</p>
                    <p class="text-sm font-medium text-slate-800">{{ Auth::user()->name }}</p>
                </div>
                
                <div class="flex items-center gap-3">
                    
                    {{-- View Store / Cart Icon --}}
                    <a href="/shop" class="w-10 h-10 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400 hover:text-brand-orange hover:border-orange-100 transition-all shadow-sm" title="View Storefront">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </a>
                    
                    {{-- Logout Button --}}
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="bg-slate-900 text-white px-5 py-2.5 rounded-full text-[11px] font-bold hover:bg-brand-orange transition-all shadow-md uppercase tracking-widest active:scale-95">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </nav>

    {{-- ════════════════════════════════════════════
          MOBILE NAVIGATION DRAWER (Alpine.js)
    ════════════════════════════════════════════ --}}
    <div x-show="mobileMenuOpen" 
         x-cloak
         class="fixed inset-0 z-[100] md:hidden" 
         role="dialog" aria-modal="true">
        
        {{-- Background Backdrop --}}
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenuOpen = false"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        {{-- Drawer Content --}}
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 w-full max-w-xs bg-white shadow-2xl flex flex-col p-8">
            
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="w-8 h-8">
                    <span class="font-serif text-xl font-bold">Daily Essentials</span>
                </div>
                <button @click="mobileMenuOpen = false" class="text-gray-400 hover:text-brand-orange transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="space-y-2">
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-300 mb-4 ml-1">Main Menu</p>
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-4 p-4 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-brand-orange' : 'text-gray-500 hover:bg-gray-50' }}">
                    <span>Overview</span>
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center gap-4 p-4 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('admin.products.*') ? 'bg-orange-50 text-brand-orange' : 'text-gray-500 hover:bg-gray-50' }}">
                    <span>Catalog</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center gap-4 p-4 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-orange-50 text-brand-orange' : 'text-gray-500 hover:bg-gray-50' }}">
                    <span>Orders</span>
                </a>
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center gap-4 p-4 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('admin.users.*') ? 'bg-orange-50 text-brand-orange' : 'text-gray-500 hover:bg-gray-50' }}">
                    <span>Customers</span>
                </a>
            </nav>

            <div class="mt-auto pt-8 border-t border-gray-100">
                <a href="/shop" class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-brand-orange transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 1.39 1.39-1.39v-3.01c0-1.1.845-2 1.9-2 1.055 0 1.9.9 1.9 2v3.01m-3.8-3.8 3.8 3.8" /></svg>
                    View Storefront
                </a>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════
          MAIN CONTENT AREA
    ════════════════════════════════════════════ --}}
    <main class="flex-grow max-w-7xl mx-auto w-full px-6 py-10">
        
        @if(session('success'))
            <div class="bg-green-50 border border-green-100 text-green-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 fade-out shadow-sm">
                <div class="bg-green-500 text-white rounded-full p-1 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <span class="font-bold text-sm tracking-wide">{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
        
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-gray-100 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="font-serif font-bold text-slate-800 text-lg">Daily Essentials</p>
            <p class="text-gray-400 text-[10px] mt-2 uppercase tracking-widest font-bold">
                &copy; {{ date('Y') }} Daily Essentials | Admin Panel
            </p>
        </div>
    </footer>

</body>
</html>