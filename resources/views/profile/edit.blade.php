@extends('layouts.navbar')

@section('title', 'Account Settings | Daily Essentials')

@section('content')
    <main class="max-w-4xl mx-auto px-6 py-12 space-y-8">
        
        {{-- Page Header --}}
        <div class="mb-8">
            <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-brand-orange transition-colors mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                Back to Dashboard
            </a>
            <h1 class="font-inria text-4xl font-bold text-gray-900 mb-2">Account Settings</h1>
            <p class="text-sm text-gray-500">Update your personal details, change your password, or manage your account data.</p>
        </div>

        {{-- 1. Profile Information Form --}}
        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-lg border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- 2. Update Password Form --}}
        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-lg border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- 3. Delete Account Form --}}
        <div class="bg-red-50/30 p-8 md:p-10 rounded-[2.5rem] shadow-lg border border-red-100">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </main>
@endsection