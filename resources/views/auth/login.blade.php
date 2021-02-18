<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="mb-6">
            <h1 class="font-sans font-extrabold text-3xl tracking-tighter">Login</h1>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label value="{{ __('Email') }}" />
                <x-input-text type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-input-text type="password" name="password" required autocomplete="current-password"  />
            </div>

            <div class="block mt-4">
                <div class="flex items-center space-x-2">
                    <x-input-checkbox name="remember" />
                    <x-input-checkbox-label>{{ __('Merken?') }}</x-input-checkbox-label>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4 space-x-2">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-500 hover:text-green-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-confirmation-button class="">
                    {{ __('Login') }}
                </x-confirmation-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
