<x-guest-layout>
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator app.') }}
        </div>

        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf

            <div>
                <x-input-label for="code" :value="__('Code')" />
                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" autofocus autocomplete="one-time-code" />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                {{ __('Or use a recovery code:') }}
            </p>
        </div>

        <form method="POST" action="{{ route('two-factor.login') }}" class="mt-2">
            @csrf

            <div>
                <x-input-label for="recovery_code" :value="__('Recovery Code')" />
                <x-text-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" autocomplete="one-time-code" />
                <x-input-error :messages="$errors->get('recovery_code')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>