<x-app-layout>
    <x-slot name="header">
        Dein Verein
    </x-slot>

    <x-section>
        <x-dashboard.button-bar />

        <div class="py-6">
            <livewire:dashboard />
        </div>
    </x-section>

</x-app-layout>
