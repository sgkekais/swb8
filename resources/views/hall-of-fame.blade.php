<x-app-layout>
    <x-slot name="header">
        Ruhmeshalle
    </x-slot>

    <x-section class="mb-6">
        <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-3 sm:space-y-0">
            <a href="#tor" class="w-full sm:w-auto">
                <x-button class="w-full sm:w-auto">
                    Torschützenkönige
                </x-button>
            </a>
            <a href="#ananas" class="w-full sm:w-auto">
                <x-button class="w-full sm:w-auto">
                    Goldene Ananas
                </x-button>
            </a>
        </div>
    </x-section>

    <x-section>
        <x-headline id="tor" class="text-2xl">
            Torschützenkönige
        </x-headline>
        <livewire:hall-of-fame-scorer-kings />
    </x-section>

    <x-section>
        <x-headline id="ananas" class="text-2xl">
            Goldene Ananas
        </x-headline>
        <livewire:hall-of-fame-ananas-kings />
    </x-section>

</x-app-layout>
