<div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-3 sm:space-y-0">
    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto">
        <x-button class="w-full sm:w-auto">
            <i class="far fa-calendar-check pr-2"></i> Deine Termine
        </x-button>
    </a>
    <a href="{{ route('dashboard.my-stats') }}" class="w-full sm:w-auto">
        <x-button class="w-full sm:w-auto">
            <i class="fas fa-chart-line pr-2"></i> Deine Statistiken
        </x-button>
    </a>
    <a href="{{ route('dashboard.vs') }}" class="w-full sm:w-auto">
        <x-button class="w-full sm:w-auto">
            <i class="fas fa-not-equal pr-2"></i> VS
        </x-button>
    </a>
</div>
