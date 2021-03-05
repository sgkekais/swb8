<x-app-layout>
    <x-slot name="header">
        <div>Schwarz-Weiß Bilk '79</div>
        <div class="text-xl font-normal">Hobbyfußball seit {{ \Carbon\Carbon::make('25.11.1979')->diffForHumans(null, true, false, 4) }}</div>
    </x-slot>

    <div class="flex space-x-8">
        <div class="flex-grow">
            <x-main-box class="p-2 bg-gray-100">
                <x-slot name="header">
                    Nächstes Spiel
                </x-slot>

                <livewire:frontpage.next-game />
            </x-main-box>

            <x-main-box class="">
                <x-slot name="header">
                    ToDo
                </x-slot>



                Die letzten Spiele

                Aktivitäten?
                ... xyz hat an Termin teilgenommen

                Kurzlisten?
            </x-main-box>

        </div>
        <div class="flex flex-col space-y-4 w-1/4">
            <x-sidebar-box class="w-full">
                <x-slot name="header">
                    Weisheiten
                </x-slot>
                <livewire:random-quote />
            </x-sidebar-box>
            <x-sidebar-box class="w-full">
                <x-slot name="header">
                    Geburtstage
                </x-slot>
                <livewire:next-birthday />
            </x-sidebar-box>
            <x-sidebar-box class="w-full">
                <x-slot name="header">
                    Knipser
                </x-slot>

            </x-sidebar-box>
        </div>
    </div>

</x-app-layout>
