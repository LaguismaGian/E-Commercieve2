<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Daily Essentials</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
</head>

<body 
    x-data="{ mobileMenuOpen: false }" 
    class="bg-[#FAFAFA] text-gray-900 selection:bg-orange-100 selection:text-orange-900 min-h-screen flex flex-col"
>

    {{-- ════════════════════════════════════════════
        ADMIN NAVBAR (Responsive Optimized)
     ════════════════════════════════════════════ --}}
    <nav class="bg-white border-b border-gray-100 py-3 sm:py-4 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 flex justify-between items-center">
            
            {{-- Logo & Brand --}}
            <div class="flex items-center gap-2 sm:gap-4 overflow-hidden">
                {{-- Mobile Menu Toggle --}}
                <button @click="mobileMenuOpen = true" class="md:hidden p-1.5 text-gray-400 hover:text-brand-orange transition-colors flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
    
                <img src="{{ asset('images/logo.png') }}" alt="Daily Essentials Logo" class="w-7 h-7 sm:w-10 sm:h-10 flex-shrink-0">
                
                {{-- Title: Shrinks font on tiny screens to prevent overflow --}}
                <h1 class="font-serif text-lg sm:text-2xl font-bold tracking-tight text-slate-900 truncate whitespace-nowrap">
                    Admin <span class="hidden xs:inline">Dashboard</span>
                </h1>
            </div>
    
            {{-- Navigation Links (Desktop Only) --}}
            <div class="hidden md:flex items-center gap-4 lg:gap-8 bg-gray-50 px-4 lg:px-6 py-2 rounded-full border border-gray-100">
                <a href="{{ route('admin.dashboard') }}" 
                   class="text-[10px] lg:text-[11px] font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">
                    Overview
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="text-[10px] lg:text-[11px] font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('admin.products.*') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">
                    Inventory
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="text-[10px] lg:text-[11px] font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('admin.orders.*') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">
                    Orders
                </a>
                <a href="{{ route('admin.users.index') }}" 
                   class="text-[10px] lg:text-[11px] font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('admin.users.*') ? 'text-brand-orange' : 'text-gray-400 hover:text-gray-900' }}">
                    Customers
                </a>
            </div>
    
            {{-- User Actions --}}
            <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                {{-- Admin Name (Hidden on small screens) --}}
                <div class="text-right hidden xl:block">
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Admin</p>
                    <p class="text-sm font-medium text-slate-800">{{ Auth::user()->name }}</p>
                </div>
                
                <div class="flex items-center gap-2 sm:gap-3">
                    {{-- View Store Icon --}}
                    <a href="/shop" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400 hover:text-brand-orange hover:border-orange-100 transition-all shadow-sm flex-shrink-0" title="View Storefront">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </a>
                    
                    {{-- Logout Button: Icon only on mobile, text added on desktop --}}
                    <button @click="$dispatch('open-logout-modal')" 
                            class="bg-slate-900 text-white p-2.5 sm:px-5 sm:py-2.5 rounded-full text-[11px] font-bold hover:bg-brand-orange transition-all shadow-md uppercase tracking-widest active:scale-95 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0-3-3m3 3H9"/>
                        </svg>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
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
            <div class="bg-green-50 border border-green-100 text-green-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 animate-fade-out shadow-sm">
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

    {{-- Logout popup --}}
    @auth
        <div x-data="{ open: false }" @open-logout-modal.window="open = true">
            <template x-teleport="body">
                <div x-show="open" 
                     style="display: none;"
                     class="fixed inset-0 z-[1000] bg-black/40 flex items-center justify-center p-4 w-screen h-screen"
                     x-transition.opacity>
                     
                    <div @click.away="open = false" 
                         class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-xs text-center"
                         x-transition>
                         
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Log Out?</h3>
                        <p class="text-sm text-gray-500 mb-6">Are you sure you want to leave?</p>
    
                        <div class="flex items-center gap-3 justify-center">
                            <button @click="open = false" class="flex-1 bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl font-medium hover:bg-gray-200 transition-colors text-sm">
                                Cancel
                            </button>
                            
                            <form method="POST" action="{{ route('logout') }}" class="flex-1 m-0">
                                @csrf
                                <button type="submit" class="w-full bg-red-500 text-white px-4 py-2.5 rounded-xl font-medium hover:bg-red-600 transition-colors shadow-sm shadow-red-200 text-sm">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    @endauth

</body>
</html>