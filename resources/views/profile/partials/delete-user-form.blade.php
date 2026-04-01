<section class="space-y-6">
    <header class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-red-100 rounded-2xl flex items-center justify-center text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            <h2 class="font-inria text-2xl font-bold text-slate-800">
                {{ __('Delete Account') }}
            </h2>
        </div>
        <p class="text-sm text-red-400/80 pl-[52px]">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- Custom Styled Trigger Button --}}
    <div class="pl-[52px]">
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="bg-white border border-red-200 text-red-500 px-8 py-3.5 rounded-full font-bold shadow-lg hover:bg-red-50 hover:text-red-700 transition-all active:scale-95 text-xs tracking-widest uppercase"
        >
            {{ __('Delete Account') }}
        </button>
    </div>

    {{-- The Pop-up Modal --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 md:p-10">
            @csrf
            @method('delete')

            <h2 class="font-inria text-2xl font-bold text-white mb-2">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1 sr-only">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm px-4 py-3 transition-colors bg-gray-50/50"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs text-red-500" />
            </div>

            {{-- Modal Action Buttons --}}
            <div class="mt-8 flex items-center justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="bg-white border border-gray-200 text-gray-600 px-6 py-3.5 rounded-full font-bold shadow-sm hover:bg-gray-50 transition-all active:scale-95 text-xs tracking-widest uppercase">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="bg-red-600 text-white px-6 py-3.5 rounded-full font-bold shadow-lg hover:bg-red-700 transition-all active:scale-95 text-xs tracking-widest uppercase">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>