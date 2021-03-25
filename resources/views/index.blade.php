<x-app-layout>

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
    <x-section class="py-4 bg-gray-100 border-t-2 border-b-2 border-primary-700 bg-pattern">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="">
                <x-box-with-shadow class="w-full">
                    <x-slot name="header">
                        Weisheiten
                    </x-slot>
                    <livewire:random-quote />
                </x-box-with-shadow>
            </div>
            @auth
                <div class="">
                    <x-box-with-shadow class="w-full">
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
