<section>
    <header class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-orange-50 rounded-2xl flex items-center justify-center text-brand-orange">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
            </div>
            <h2 class="font-inria text-2xl font-bold text-slate-800">
                {{ __('Update Password') }}
            </h2>
        </div>
        <p class="text-sm text-gray-500 pl-13">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <label for="update_password_current_password" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm px-4 py-3 transition-colors bg-gray-50/50" 
                   autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs text-red-500" />
        </div>

        {{-- New Password --}}
        <div>
            <label for="update_password_password" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" 
                   class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm px-4 py-3 transition-colors bg-gray-50/50" 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="update_password_password_confirmation" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                   class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm px-4 py-3 transition-colors bg-gray-50/50" 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
        </div>

        {{-- Save Button & Success Message --}}
        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="bg-slate-900 text-white px-8 py-3.5 rounded-full font-bold shadow-lg hover:bg-orange-500 transition-all active:scale-95 text-xs tracking-widest uppercase">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
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