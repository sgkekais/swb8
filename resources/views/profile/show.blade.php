<x-app-layout>
    <x-slot name="header">
        Profil-Einstellungen
    </x-slot>

    <x-section>
        @livewire('profile.update-profile-information-form')

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif

        <x-jet-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        <x-jet-section-border />

{{--        <div class="mt-10 sm:mt-0">--}}
{{--            @livewire('profile.delete-user-form')--}}
{{--        </div>--}}
    </x-section>

</x-app-layout>
