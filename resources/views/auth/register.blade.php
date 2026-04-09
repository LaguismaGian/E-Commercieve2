<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Signup | Daily Essentials</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- ════════════════════════════════════════════
         REGISTER CONTENT 
    ════════════════════════════════════════════ --}}
    <div class="bg-section-bg py-12 md:py-20 px-6 min-h-[calc(100vh-80px)] flex items-center justify-center">
        
        {{-- Popup Card --}}
        <div class="max-w-5xl w-full bg-white rounded-[2.5rem] shadow-xl border border-gray-50 overflow-hidden flex flex-col lg:flex-row">
            
            {{-- Left Side: The Image (Hidden on smaller screens) --}}
            <div class="lg:w-1/2 relative hidden lg:block">
                {{-- Optional subtle overlay to blend with your brand colors --}}
                <div class="absolute inset-0 bg-orange-900/10 mix-blend-multiply z-10"></div>
                <img src="{{ asset('images/login.png') }}" alt="Daily Essentials Registration" class="absolute inset-0 w-full h-full object-cover">
            </div>

            {{-- Right Side: The Form --}}
            <div class="lg:w-1/2 p-8 md:p-12 lg:p-16 relative">
                
                {{-- Decorative top border for mobile --}}
                <div class="absolute top-0 left-0 w-full h-1.5 bg-brand-orange lg:hidden"></div>

                <div class="mb-8">
                    <h2 class="font-inria text-3xl md:text-4xl font-bold text-gray-900 mb-2">Create an Account</h2>
                    <p class="text-sm text-gray-500">Join us to start building your curated candle collection.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Full Name --}}
                    <div>
                        <label for="name" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Full Name</label>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               autocomplete="name"
                               placeholder="e.g. Kyle Renyer"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm">
                        @error('name')
                            <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Email Address</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="username"
                               placeholder="hello@example.com"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm">
                        @error('email')
                            <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password & Confirm Password (Grid layout on larger screens) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Password</label>
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="••••••••"
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm">
                            @error('password')
                                <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Confirm Password</label>
                            <input id="password_confirmation" 
                                   type="password" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="••••••••"
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm">
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-4 space-y-4">
                        <button type="submit" class="w-full bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg hover:shadow-orange-200 active:scale-[0.98] tracking-widest uppercase text-xs">
                            Create Account
                        </button>
                        
                        <div class="text-center">
                            <span class="text-xs text-gray-500">Already registered?</span>
                            <a href="{{ route('login') }}" class="text-xs font-bold text-brand-orange hover:text-orange-600 transition-colors ml-1 uppercase tracking-wider">
                                Log in here
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>