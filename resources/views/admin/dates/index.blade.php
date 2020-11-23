<x-app-layout>
    <x-slot name="header">
        Termine und Umfragen
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:admin.create-date />

            <livewire:admin.date-table />
        </div>
    </div>

</x-app-layout>
