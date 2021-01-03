<x-app-layout>
    <x-slot name="header">
        Saisons
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:admin.create-season />

            <livewire:admin.season-table />
        </div>
    </div>

</x-app-layout>
