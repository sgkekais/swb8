<x-app-layout>
    <x-slot name="header">
        Mein Verein - Hi, {{ auth()->user()->name }}!
    </x-slot>

    <div class="flex items-center space-x-3">
        <x-button>
            <i class="far fa-calendar-check fa-fw"></i> Meine Termine
        </x-button>
        <x-button>
            <i class="fas fa-chart-line fa-fw"></i> Meine Statistiken
        </x-button>
        <x-button>
            <i class="fas fa-not-equal fa-fw"></i> VS
        </x-button>
    </div>
    <div class="py-6">
        <livewire:dashboard />
    </div>

</x-app-layout>
