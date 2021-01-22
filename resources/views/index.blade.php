<x-app-layout>
    <x-slot name="header">
        Hobbyfußball seit {{ \Carbon\Carbon::make('25.11.1979')->diffForHumans() }}
    </x-slot>

    <livewire:random-quote />

</x-app-layout>
