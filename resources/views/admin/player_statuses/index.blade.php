<x-app-layout>
    <x-slot name="header">
        Spieler-Status
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:admin.create-player-status />

            <livewire:admin.player-status-table />
        </div>
    </div>

</x-app-layout>
