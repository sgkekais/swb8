<x-app-layout>
    <x-slot name="header">
        Dein Verein - Hi, {{ auth()->user()->name }}!
    </x-slot>

    <x-dashboard.button-bar />

    <div class="py-6">
        <livewire:dashboard />
    </div>

</x-app-layout>
