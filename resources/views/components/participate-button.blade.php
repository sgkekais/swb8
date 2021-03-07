@props(
    ['date']
)

@auth
    @if ($date->clubs->intersect(auth()->user()->player->clubs)->isNotEmpty() && $date->poll_begins && $date->poll_ends)
        <div class="flex flex-grow justify-end items-center space-x-2">
            {{-- if open -> participate in poll --}}
            <div class="flex flex-col space-y-1 text-right">
                @if ($date->poll_is_open && $today >= $date->poll_begins && $today <= $date->poll_ends)
                    <a href="{{ route('poll', $date) }}" class="flex justify-end">
                        <x-button>
                            <i class="far fa-calendar-plus pr-1" title="Rückmelden" ></i>Rückmelden
                        </x-button>
                    </a>
                    <div class="text-xs">
                        @if (auth()->user()->dateOptions()->where('date_id', $date->id)->count() > 0)
                            <span class="text-primary-600">Du hast teilgenommen</span>
                        @else
                            <span class="text-red-600">Du hast noch nicht teilgenommen</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @endif
@endauth
