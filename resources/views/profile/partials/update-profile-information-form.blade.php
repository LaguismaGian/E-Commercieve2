<section>
    <header class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-orange-50 rounded-2xl flex items-center justify-center text-brand-orange">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
            </div>
            <h2 class="font-inria text-2xl font-bold text-slate-800">
                {{ __('Profile Information') }}
            </h2>
        </div>
        <p class="text-sm text-gray-500 pl-13">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        {{-- Name Input --}}
        <div>
            <label for="name" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" 
                   class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm px-4 py-3 transition-colors bg-gray-50/50" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('name')" />
        </div>

        {{-- Email Input --}}
        <div>
            <label for="email" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" 
                   class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm px-4 py-3 transition-colors bg-gray-50/50" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('email')" />

            {{-- Unverified Email Warning (Only shows if email verification is enabled) --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 bg-orange-50 border border-orange-100 p-4 rounded-2xl">
                    <p class="text-sm text-orange-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="font-bold underline text-orange-600 hover:text-orange-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors ml-1">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-green-600 uppercase tracking-widest">
                            {{ __('A new link has been sent!') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Save Button & Success Message --}}
        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="bg-slate-900 text-white px-8 py-3.5 rounded-full font-bold shadow-lg hover:bg-orange-500 transition-all active:scale-95 text-xs tracking-widest uppercase">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition
                     x-init="setTimeout(() => show = false, 4000)"
                     class="flex items-center gap-2 text-green-600 bg-green-50 px-4 py-2 rounded-xl border border-green-100 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    <span class="text-xs font-bold uppercase tracking-widest">{{ __('Saved') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>