<x-app-layout>


    <div class="relative overflow-hidden">
        <div class="absolute inset-0">
            <x-pitch></x-pitch>
        </div>

        <x-section class="py-4 bg-gray-900" slot-class="relative">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-white">
                <div class="font-sans font-extrabold text-2xl sm:text-3xl tracking-tighter">
                    Schwarz-Weiß Bilk '79
                </div>
                <div>
                    Hobbyfußball seit {{ \Carbon\Carbon::make('25.11.1979')->diffForHumans(['syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE, 'parts' => 4, 'join' => ['n, ', ' und ']]) }}
                </div>
            </div>
            <x-main-box class="mt-4">
                <x-slot name="header">
                    <x-headline class="mt-4 text-2xl text-white">
                        Demnächst
                    </x-headline>
                </x-slot>
                <div class="mb-4">
                    <livewire:frontpage.next-dates />
                </div>
{{--                <livewire:frontpage.next-games />--}}
            </x-main-box>

        </x-section>

        <x-section class=" py-4 bg-gray-900">

        </x-section>

        <x-section class=" py-4 bg-gray-100 border-t-2 border-b-2 border-primary-700">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 relative">
                <div class="">
                    <x-box-with-shadow class="p-2" shadow-color="bg-gray-600">
                        <x-slot name="header">
                            Weisheiten
                        </x-slot>
                        <livewire:random-quote />
                    </x-box-with-shadow>
                </div>
                @auth
                    <div class="">
                        <x-box-with-shadow class="p-2" shadow-color="bg-gray-600">
                            <x-slot name="header">
                                Geburtstage
                            </x-slot>
                            <livewire:next-birthday />
                        </x-box-with-shadow>
                    </div>
                @endauth
            </div>
        </x-section>
    </div>


    <x-section class="py-4">
        <x-main-box>
            <x-slot name="header">
                <x-headline class="text-2xl">
                    Fieberkurve (letzte 10)
                </x-headline>
            </x-slot>

            <div class="grid sm:grid-cols-2 sm:gap-2">
                @push('scripts')
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                @endpush
                @foreach (\App\Models\Club::owner(true)->get() as $club)
                    <div class="flex flex-col">
                        <x-headline class="text-center">{{ $club->name_code }}</x-headline>
                        <livewire:frontpage.fever-curve :club="$club"/>
                    </div>
                @endforeach
            </div>
        </x-main-box>
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
