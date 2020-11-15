<x-app-layout>
    <x-slot name="header">
        Paarungen
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <livewire:admin.create-match-type /> --}}

            <livewire:admin.match-table />
        </div>
    </div>

</x-app-layout>
