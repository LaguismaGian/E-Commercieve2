<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Login | Daily Essentials</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- ════════════════════════════════════════════
         LOGIN CONTENT 
    ════════════════════════════════════════════ --}}
    <div class="bg-section-bg py-12 md:py-20 px-6 min-h-[calc(100vh-80px)] flex items-center justify-center">
        
        {{-- Popup Card --}}
        <div class="max-w-5xl w-full bg-white rounded-[2.5rem] shadow-xl border border-gray-50 overflow-hidden flex flex-col lg:flex-row">
            
            
            <div class="lg:w-1/2 relative hidden lg:block">
                {{-- Optional subtle overlay to blend with your brand colors --}}
                <div class="absolute inset-0 bg-orange-900/10 mix-blend-multiply z-10"></div>
                <img src="{{ asset('images/login.png') }}" alt="Daily Essentials Login" class="absolute inset-0 w-full h-full object-cover">
            </div>

            {{-- Form --}}
            <div class="lg:w-1/2 p-8 md:p-12 lg:p-16 relative">
                
                
                <div class="absolute top-0 left-0 w-full h-1.5 bg-brand-orange lg:hidden"></div>

                <div class="mb-10">
                    <h2 class="font-inria text-3xl md:text-4xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                    <p class="text-sm text-gray-500">Sign in to access your curated candle collection.</p>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4 text-green-600 font-bold text-sm bg-green-50 p-4 rounded-xl" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Email Address</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username"
                               placeholder="hello@example.com"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm">
                        @error('email')
                            <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Password</label>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm">
                        @error('password')
                            <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me & Forgot Password Options --}}
                    <div class="flex items-center justify-between pt-2">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-brand-orange focus:ring-brand-orange cursor-pointer">
                            <span class="ml-2 text-xs font-bold text-gray-500 group-hover:text-gray-900 transition-colors">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-gray-400 hover:text-brand-orange transition-colors underline decoration-transparent hover:decoration-brand-orange underline-offset-4">
                                Forgot your password?
                            </a>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="pt-4 space-y-4">
                        <button type="submit" class="w-full bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg hover:shadow-orange-200 active:scale-[0.98] tracking-widest uppercase text-xs">
                            Log in
                        </button>
                        
                        <div class="text-center">
                            <span class="text-xs text-gray-500">Don't have an account?</span>
                            <a href="{{ route('register') }}" class="text-xs font-bold text-brand-orange hover:text-orange-600 transition-colors ml-1 uppercase tracking-wider">
                                Sign up here
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
</body>
</html>