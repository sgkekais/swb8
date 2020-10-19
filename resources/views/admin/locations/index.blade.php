<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            Standorte
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:admin.create-location />

            <div class="text-xs text-gray-300">
                Werte sind in Zellen editierbar.
            </div>

            <livewire:admin.locations-table />
        </div>
    </div>

</x-app-layout>
