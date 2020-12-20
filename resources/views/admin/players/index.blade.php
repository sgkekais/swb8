<x-app-layout>
    <x-slot name="header">
        Spieler
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <livewire:admin.create-player /> --}}

            <livewire:admin.player-table />
        </div>
    </div>

</x-app-layout>
