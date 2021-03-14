<x-app-layout>
    <x-slot name="header">
        <div>Schwarz-Weiß Bilk '79</div>
        <div class="text-xl font-normal">Hobbyfußball seit {{ \Carbon\Carbon::make('25.11.1979')->diffForHumans(null, true, false, 4) }}</div>
    </x-slot>

    <div class="flex space-x-8">
        <div class="flex-grow">
            <x-main-box class="">
                <x-slot name="header">
                    Demnächst
                </x-slot>

                <livewire:frontpage.next-game />
            </x-main-box>
            <x-main-box class="">
                <x-slot name="header">
                    Zuletzt
                </x-slot>

                <livewire:frontpage.last-games />
            </x-main-box>
        </div>
        <div class="flex flex-col space-y-4 w-1/4">
            <x-box-with-shadow class="w-full">
                <x-slot name="header">
                    Weisheiten
                </x-slot>
                <livewire:random-quote />
            </x-box-with-shadow>
            <x-box-with-shadow class="w-full">
                <x-slot name="header">
                    Geburtstage
                </x-slot>
                <livewire:next-birthday />
            </x-box-with-shadow>
            <x-box-with-shadow class="w-full">
                <x-slot name="header">
                    Knipser
                </x-slot>

            </x-box-with-shadow>
        </div>
    </div>

</x-app-layout>
