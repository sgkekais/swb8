<x-app-layout>
    <x-slot name="header">
        Dein Verein - Hi, {{ auth()->user()->name }}!
    </x-slot>

    <x-section>
        <x-dashboard.button-bar />

        <div class="py-6">
            <livewire:dashboard />
        </div>
    </x-section>

</x-app-layout>
