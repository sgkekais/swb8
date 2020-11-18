<x-app-layout>
    <x-slot name="header">
        Spielarten
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:admin.create-date-type />

            <livewire:admin.date-type-table />
        </div>
    </div>

</x-app-layout>
