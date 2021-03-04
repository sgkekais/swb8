<x-app-layout>
    <x-slot name="header">
        Hobbyfußball seit {{ \Carbon\Carbon::make('25.11.1979')->diffForHumans() }}
    </x-slot>

    <div class="flex">
        <div class="flex-grow">

            Nächstes Spiel

            Geburtstage

            Die letzten Spiele

            Aktivitäten?
            ... xyz hat an Termin teilgenommen

            Kurzlisten?
        </div>
        <div class="w-1/4">
            <x-sidebar-box>
                <livewire:random-quote />
            </x-sidebar-box>
        </div>
    </div>

</x-app-layout>
