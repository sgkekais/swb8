<x-app-layout>
    <x-section class="py-4 bg-gray-900" slot-class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-white">
        <div class="font-sans font-extrabold text-2xl sm:text-3xl tracking-tighter">
            Schwarz-Weiß Bilk '79
        </div>
        <div>
            Hobbyfußball seit {{ \Carbon\Carbon::make('25.11.1979')->diffForHumans(['syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE, 'parts' => 4, 'join' => ['n, ', ' und ']]) }}
        </div>
    </x-section>

    <x-section class="py-4">
        <x-main-box class="">
            <x-slot name="header">
                <x-headline class="text-2xl">
                    Demnächst
                </x-headline>
            </x-slot>

            <livewire:frontpage.next-games />
        </x-main-box>
    </x-section>
    <x-section class="py-4 bg-gray-100 border-t-2 border-b-2 border-primary-700">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="">
                <x-box-with-shadow class="p-2">
                    <x-slot name="header">
                        Weisheiten
                    </x-slot>
                    <livewire:random-quote />
                </x-box-with-shadow>
            </div>
            @auth
                <div class="">
                    <x-box-with-shadow class="p-2">
                        <x-slot name="header">
                            Geburtstage
                        </x-slot>
                        <livewire:next-birthday />
                    </x-box-with-shadow>
                </div>
            @endauth
        </div>
    </x-section>
    <x-section class="py-4 ">
        <x-main-box class="">
            <x-slot name="header">
                <x-headline class="text-2xl">
                    Zuletzt
                </x-headline>
            </x-slot>

            <livewire:frontpage.last-games />
        </x-main-box>
    </x-section>

</x-app-layout>
