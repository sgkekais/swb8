<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        <x-headline class="text-2xl">
            Passwort ändern
        </x-headline>
    </x-slot>

    <x-slot name="description">
        Stell sicher, dass dein Konto ein langes, zufälliges Passwort verwendet, um sicher zu sein.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="current_password" value="Aktuelles Passwort" />
            <x-input-text id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="Neues Passwort" />
            <x-input-text id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="Passwort bestätigen" />
            <x-input-text id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            Gespeichert.
        </x-jet-action-message>

        <x-confirmation-button type="submit">
            Speichern
        </x-confirmation-button>
    </x-slot>
</x-jet-form-section>
