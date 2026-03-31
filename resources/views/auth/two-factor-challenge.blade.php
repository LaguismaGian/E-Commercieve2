<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Authentication</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- ════════════════════════════════════════════
         2FA VERIFICATION CONTENT 
    ════════════════════════════════════════════ --}}
    <div class="bg-section-bg py-12 md:py-20 px-6 min-h-[calc(100vh-80px)] flex items-center justify-center">
        
        {{-- Popup Card --}}
        <div class="max-w-5xl w-full bg-white rounded-[2.5rem] shadow-xl border border-gray-50 overflow-hidden flex flex-col lg:flex-row">
            
            {{-- Left Side: The Image (Hidden on smaller screens) --}}
            <div class="lg:w-1/2 relative hidden lg:block">
                {{-- Optional subtle overlay to blend with your brand colors --}}
                <div class="absolute inset-0 bg-orange-900/10 mix-blend-multiply z-10"></div>
                <img src="{{ asset('images/login.png') }}" alt="Daily Essentials Security" class="absolute inset-0 w-full h-full object-cover">
            </div>

            {{-- Right Side: The Stacked Forms --}}
            <div class="lg:w-1/2 p-8 md:p-12 relative">
                
                {{-- Decorative top border for mobile --}}
                <div class="absolute top-0 left-0 w-full h-1.5 bg-brand-orange lg:hidden"></div>

                <div class="mb-6">
                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-gray-900 mb-2">Security Check</h2>
                    <p class="text-sm text-gray-500">Confirm access by entering your authenticator code.</p>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 text-red-600 px-5 py-4 rounded-2xl mb-6">
                        <ul class="list-disc list-inside text-xs font-bold tracking-wide">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 1. Authenticator Code Form (Primary Action) --}}
                <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="code" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Authenticator App Code</label>
                        <input id="code" 
                               type="text" 
                               name="code" 
                               autofocus 
                               placeholder="000 000"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:bg-white transition-all text-lg tracking-[0.5em] text-center font-mono font-bold text-gray-900">
                    </div>
                    <button type="submit" class="w-full bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg hover:shadow-orange-200 active:scale-[0.98] tracking-widest uppercase text-xs">
                        Verify Code & Login
                    </button>
                </form>

                {{-- Aesthetic Divider --}}
                <div class="relative flex items-center py-6">
                    <div class="flex-grow border-t border-gray-100"></div>
                    <span class="flex-shrink-0 mx-4 text-[10px] font-bold uppercase tracking-widest text-gray-300">Or use a backup</span>
                    <div class="flex-grow border-t border-gray-100"></div>
                </div>

                {{-- 2. Recovery Code Form (Secondary Action) --}}
                <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="recovery_code" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Recovery Code</label>
                        <input id="recovery_code" 
                               type="text" 
                               name="recovery_code" 
                               placeholder="Enter your emergency code"
                               class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-orange-200 transition-all text-sm font-mono font-bold text-gray-900">
                    </div>
                    <button type="submit" class="w-full bg-white text-gray-600 border-2 border-gray-100 px-8 py-3.5 rounded-2xl font-bold hover:border-brand-orange hover:text-brand-orange transition-all active:scale-[0.98] tracking-widest uppercase text-xs">
                        Use Recovery Code
                    </button>
                </form>

                {{-- Back Link --}}
                <div class="text-center mt-8">
                    <a href="/" class="text-xs font-bold text-gray-400 hover:text-brand-orange transition-colors uppercase tracking-wider">
                        ← Cancel and return home
                    </a>
                </div>

            </div>
        </div>
    </div>
    
</body>
</html>