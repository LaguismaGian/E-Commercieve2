@extends('layouts.navbar')

@section('title', 'My Profile | Daily Essentials')

@section('content')

    {{-- ════════════════════════════════════════════
         TOP PAGE HERO
    ════════════════════════════════════════════ --}}
    <section class="relative min-h-[200px] flex flex-col items-center justify-center text-center px-6" 
             style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/bgphoto2.png') }}'); background-size: cover; background-position: center;">
        <h1 class="font-inria text-white text-4xl md:text-5xl font-bold tracking-tight mb-2">
            My Account
        </h1>
        <p class="text-white/90 text-sm tracking-widest uppercase font-medium">Manage your profile and orders</p>
    </section>

    {{-- ════════════════════════════════════════════
         PROFILE DASHBOARD
    ════════════════════════════════════════════ --}}
    <main class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        {{-- Left Column: User Profile Card (Fixed Sticky Behavior) --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 text-center lg:sticky lg:top-24">
            
            {{-- Aesthetic Avatar (Uses the first letter of their name) --}}
            <div class="w-24 h-24 bg-orange-50 text-brand-orange rounded-full flex items-center justify-center text-4xl font-inria font-bold mx-auto mb-4 border-4 border-white shadow-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            
            
            <h2 class="font-inria text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
            <p class="text-sm text-gray-500 mb-6">{{ Auth::user()->email }}</p>
            
            {{-- Email Verification Status Badges --}}
            @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
                @if (Auth::user()->hasVerifiedEmail())
                    {{-- Verified Status --}}
                    <div class="inline-flex items-center gap-1.5 bg-green-50 border border-green-100 text-green-700 px-3 py-1 rounded-full mb-6 -mt-1 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                            <path fill-rule="evenodd" d="M16.403 12.652a3 3 0 0 0 0-5.304 3 3 0 0 0-3.75-3.751 3 3 0 0 0-5.305 0 3 3 0 0 0-3.751 3.75 3 3 0 0 0 0 5.305 3 3 0 0 0 3.75 3.751 3 3 0 0 0 5.305 0 3 3 0 0 0 3.751-3.75Zm-2.546-4.46a.75.75 0 0 0-1.214-.883l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Verified</span>
                    </div>
                @else
                    {{-- Unverified Status --}}
                    <div class="inline-flex items-center gap-1.5 bg-orange-50 border border-orange-100 text-orange-600 px-3 py-1 rounded-full mb-6 -mt-1 shadow-sm">
                        <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Unverified</span>
                    </div>
                @endif
            @endif

            
            
            <div class="border-t border-gray-50 pt-6 text-left space-y-4">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Member Since</p>
                    <p class="font-medium text-sm text-gray-900">{{ Auth::user()->created_at->format('F j, Y') }}</p>
                </div>
                
                {{-- Quick Admin Link (Only visible to admins) --}}
                @if(Auth::user()->isAdmin())
                    <div class="pt-2">
                        <a href="{{ route('admin.products.index') }}" class="flex items-center justify-between bg-slate-50 hover:bg-slate-100 p-3 rounded-xl transition-colors border border-gray-100 group">
                            <span class="text-xs font-bold uppercase tracking-widest text-gray-600 group-hover:text-gray-900">Manage Store</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-400 group-hover:text-gray-900"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                        </a>
                    </div>
                @endif
            </div>

            {{-- Edit Profile / Account Settings Link --}}
            <div class="pt-2">
                <a href="{{ route('profile.edit') }}" class="flex items-center justify-between bg-white hover:bg-orange-50 p-3 rounded-xl transition-colors border border-gray-100 group shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400 group-hover:text-brand-orange">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-600 group-hover:text-gray-900">Account Settings</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-300 group-hover:text-brand-orange transition-transform group-hover:translate-x-1"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                </a>
            </div>

            {{-- Logout Button --}}
            <form method="POST" action="{{ route('logout') }}" class="mt-8 pt-6 border-t border-gray-50">
                @csrf
                <button type="submit" class="w-full bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 px-4 py-3.5 rounded-2xl font-bold text-xs uppercase tracking-widest transition-colors shadow-sm">
                    Sign Out
                </button>
            </form>
        </div>

        {{-- Right Column: Security & Orders --}}
        <div class="lg:col-span-2 space-y-8">
            
           
            {{-- 1. Order History Section --}}
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-orange-50 rounded-2xl flex items-center justify-center text-brand-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                    </div>
                    <h2 class="font-inria text-2xl font-bold text-slate-800">My Orders</h2>
                </div>

                {{-- Fetch orders for the logged-in user --}}
                @php
                    $orders = Auth::user()->orders()->latest()->get();
                @endphp

                @if($orders->count() > 0)
                    {{-- Order List Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="py-4 pr-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Order ID</th>
                                    <th class="py-4 px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Date</th>
                                    <th class="py-4 px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Total</th>
                                    <th class="py-4 px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Status</th>
                                    <th class="py-4 pl-4 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($orders as $order)
                                    <tr class="group hover:bg-gray-50/50 transition-colors">
                                        <td class="py-4 pr-4">
                                            <span class="font-bold text-sm text-gray-900">{{ $order->order_number }}</span>
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $order->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="py-4 px-4 font-bold text-gray-900 whitespace-nowrap">
                                            ₱{{ number_format($order->total_amount, 2) }}
                                        </td>
                                        <td class="py-4 px-4">
                                            {{-- Dynamic Status Pill --}}
                                            <span class="px-3 py-1.5 text-[9px] font-bold uppercase tracking-widest rounded-full whitespace-nowrap
                                                {{ $order->status == 'pending' ? 'bg-orange-50 text-orange-600' : '' }}
                                                {{ $order->status == 'processing' ? 'bg-blue-50 text-blue-600' : '' }}
                                                {{ $order->status == 'completed' ? 'bg-green-50 text-green-600' : '' }}
                                                {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-600' : '' }}
                                            ">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 pl-4 text-right">
                                            <a href="{{ route('orders.show', $order) }}" class="text-[10px] font-bold text-gray-400 hover:text-brand-orange uppercase tracking-widest transition-colors">
                                                View Receipt &rarr;
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="text-center py-10 bg-gray-50 rounded-[2rem] border border-dashed border-gray-200">
                        <p class="text-gray-500 text-sm mb-6">You haven't placed any orders yet.</p>
                        <a href="/shop" class="inline-block bg-slate-900 text-white px-8 py-3.5 rounded-full font-bold shadow-lg hover:bg-brand-orange transition-all active:scale-95 text-xs tracking-widest uppercase">
                            Start Shopping
                        </a>
                    </div>
                @endif
            </div>

            {{-- Security Settings (2FA) --}}
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    </div>
                    <h2 class="font-inria text-2xl font-bold text-slate-800">Security Settings</h2>
                </div>
                
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Two-Factor Authentication</h3>
                
                @if(auth()->user()->two_factor_confirmed_at)
                    <div class="bg-green-50 border border-green-100 text-green-700 px-5 py-4 rounded-2xl mb-6 flex items-center gap-3">
                        <div class="bg-green-500 text-white rounded-full p-1 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        </div>
                        <span class="font-medium text-sm">Two-factor authentication is <strong>ENABLED</strong></span>
                    </div>
                    
                    <form method="POST" action="{{ route('two-factor.disable') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-white border border-red-200 text-red-500 px-6 py-3 rounded-xl hover:bg-red-50 font-bold text-xs uppercase tracking-widest transition-colors">
                            Disable 2FA
                        </button>
                    </form>
                @else
                    <div class="bg-orange-50 border border-orange-100 text-orange-700 px-5 py-4 rounded-2xl mb-6 flex items-center gap-3">
                        <span class="text-lg">⚠️</span>
                        <span class="font-medium text-sm">Two-factor authentication is <strong>DISABLED</strong></span>
                    </div>
                    
                    <form method="POST" action="{{ route('two-factor.enable') }}">
                        @csrf
                        <button type="submit" class="bg-slate-900 text-white px-8 py-3.5 rounded-xl hover:bg-brand-orange font-bold text-xs uppercase tracking-widest transition-colors shadow-md">
                            Enable 2FA
                        </button>
                    </form>
                @endif

                {{-- Show QR Code when enabling 2FA --}}
                @if(session('status') == 'two-factor-authentication-enabled')
                    <div class="mt-8 p-6 bg-slate-50 rounded-[2rem] border border-gray-100">
                        <p class="text-sm text-gray-700 mb-4 font-bold">1. Scan this QR code with your authenticator app:</p>
                        <div class="inline-block p-4 bg-white rounded-2xl shadow-sm border border-gray-100 mb-6">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        
                        <p class="text-sm text-gray-700 mb-3 font-bold">2. Save your Recovery Codes:</p>
                        <p class="text-xs text-gray-500 mb-4">Keep these safe! You'll need them if you lose your phone.</p>
                        
                        <div class="bg-white p-5 rounded-2xl border border-gray-100">
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm font-mono text-gray-600">
                                @foreach(auth()->user()->recoveryCodes() as $code)
                                    <li>{{ $code }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </main>

@endsection