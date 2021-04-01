@props(['title' => __('Confirm Password'), 'content' => __('Zu deiner Sicherheit, bestätige bitte dein Passwort, um fortzufahren.'), 'button' => 'Bestätigen'])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span
    {{ $attributes->wire('then') }}
    x-data
    x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{ $slot }}
</span>

@once
<x-jet-dialog-modal wire:model="confirmingPassword">
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="content">
        {{ $content }}

        <div class="mt-4" x-data="{}" x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
            <x-input-text type="password" class="mt-1 block w-full" placeholder="{{ __('Password') }}"
                        x-ref="confirmable_password"
                        wire:model.defer="confirmablePassword"
                        wire:keydown.enter="confirmPassword" />

            <x-jet-input-error for="confirmable_password" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="flex items-center justify-end space-x-2">
            <x-button type="button" wire:click="stopConfirmingPassword" wire:loading.attr="disabled">
                Abbrechen
            </x-button>

            <x-confirmation-button class="" wire:click="confirmPassword" wire:loading.attr="disabled">
                {{ $button }}
            </x-confirmation-button>
        </div>

    </x-slot>
</x-jet-dialog-modal>
@endonce
