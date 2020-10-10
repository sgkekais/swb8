<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            Standorte
        </h2>
    </x-slot>

    {{-- @livewire('admin.clubs') --}}
    <livewire:datatable model="App\Models\Location" />

</x-app-layout>
