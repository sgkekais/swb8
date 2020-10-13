<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            Standorte
        </h2>
    </x-slot>

    @include('admin.includes._alert')

    <livewire:admin.create-location />

    <livewire:admin.locations-table />

</x-app-layout>
