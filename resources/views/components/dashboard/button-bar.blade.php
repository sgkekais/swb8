<div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-3 sm:space-y-0">
    <a href="{{ route('dashboard') }}">
        <x-button>
            <i class="far fa-calendar-check pr-2"></i> Meine Termine
        </x-button>
    </a>
    <a href="{{ route('dashboard.my-stats') }}">
        <x-button>
            <i class="fas fa-chart-line pr-2"></i> Meine Statistiken
        </x-button>
    </a>
    <a href="{{ route('dashboard.vs') }}">
        <x-button>
            <i class="fas fa-not-equal pr-2"></i> VS
        </x-button>
    </a>
</div>