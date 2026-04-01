@extends('layouts.navbar')

@section('title', 'Verify Your Email | Daily Essentials')

@section('content')
<div class="min-h-[70vh] flex flex-col justify-center items-center px-6 py-12 relative overflow-hidden">
    
    {{-- Decorative Background Blur --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-orange-200/40 rounded-full blur-[80px] -z-10"></div>

    <div class="w-full max-w-md bg-white shadow-2xl shadow-slate-200/50 rounded-[2.5rem] border border-gray-100 p-8 md:p-10 text-center relative">
        
        {{-- Top Accent Line --}}
        <div class="absolute top-0 left-0 w-full h-2 bg-orange-500 rounded-t-[2.5rem]"></div>

        {{-- Envelope Icon --}}
        <div class="mx-auto w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-orange-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.909A2.25 2.25 0 0 1 2.25 6.993V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.909A2.25 2.25 0 0 1 2.25 6.993V6.75" />
            </svg>
        </div>

        <h2 class="font-inria text-3xl font-bold text-slate-800 mb-4">Check Your Inbox</h2>

        <p class="text-sm text-gray-500 leading-relaxed mb-8">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>

        {{-- Success Message for Resending --}}
        @if (session('status') == 'verification-link-sent')
            <div class="mb-8 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center gap-3">
                <div class="bg-green-500 text-white rounded-full p-1 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                </div>
                <p class="text-[11px] font-bold text-green-700 uppercase tracking-widest text-left">
                    {{ __('A new verification link has been sent!') }}
                </p>
            </div>
        @endif

        {{-- Action Buttons --}}
        <div class="flex flex-col gap-5">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-slate-900 text-white px-8 py-4 rounded-full font-bold shadow-lg hover:bg-orange-500 transition-all active:scale-95 text-xs tracking-widest uppercase">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-[11px] font-bold uppercase tracking-widest text-gray-400 hover:text-red-500 transition-colors">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>

    </div>
</div>
@endsection