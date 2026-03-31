<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

{{-- ════════════════════════════════════════════
         FORGOT PASSWORD CONTENT 
    ════════════════════════════════════════════ --}}
    <div class="bg-section-bg py-12 md:py-20 px-6 min-h-[calc(100vh-80px)] flex items-center justify-center">
        
        {{-- The Aesthetic Popup Card --}}
        <div class="max-w-5xl w-full bg-white rounded-[2.5rem] shadow-xl border border-gray-50 overflow-hidden flex flex-col lg:flex-row">
            
            {{-- Left Side: The Image (Matches Login/Register) --}}
            <div class="lg:w-1/2 relative hidden lg:block">
                <div class="absolute inset-0 bg-orange-900/10 mix-blend-multiply z-10"></div>
                <img src="{{ asset('images/login.png') }}" alt="Reset Password" class="absolute inset-0 w-full h-full object-cover">
            </div>

            {{-- Right Side: The Form --}}
            <div class="lg:w-1/2 p-8 md:p-12 lg:p-16 relative">
                
                {{-- Decorative top border for mobile --}}
                <div class="absolute top-0 left-0 w-full h-1.5 bg-brand-orange lg:hidden"></div>

                <div class="mb-8">
                    <h2 class="font-inria text-3xl md:text-4xl font-bold text-gray-900 mb-2 tracking-tight">Forgot Password?</h2>
                    <p class="text-sm text-gray-500 leading-relaxed italic">
                        No problem. Enter your email address and we'll send you a link to choose a new one.
                    </p>
                </div>

                {{-- Session Status (Success Message when email is sent) --}}
                @if (session('status'))
                    <div class="mb-6 bg-green-50 border border-green-100 text-green-700 px-5 py-4 rounded-2xl text-xs font-bold tracking-wide animate-fade-in">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                               placeholder="Enter your registered email"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-sm">
                        @error('email')
                            <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="pt-4 space-y-4">
                        <button type="submit" class="w-full bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg hover:shadow-orange-200 active:scale-[0.98] tracking-widest uppercase text-xs">
                            Email Reset Link
                        </button>
                        
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-xs font-bold text-gray-400 hover:text-brand-orange transition-colors uppercase tracking-widest">
                                ← Back to Login
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
</body>
</html>