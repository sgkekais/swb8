@props([
    'date' => null,
    'showPollClose' => false,
])

@auth
    @if($date && !$date->cancelled && auth()->user()->player)
        {{-- is date valid for me, i.e. date->clubs contains at least one of player->clubs --}}
        @if ($date->clubs->intersect(auth()->user()->player->clubs)->isNotEmpty() && $date->poll_begins && $date->poll_ends)
            <div {{ $attributes->merge(['class' => '']) }}>
                {{-- if open -> participate in poll --}}
                @if ($date->poll_is_open && \Carbon\Carbon::today() >= $date->poll_begins && \Carbon\Carbon::today() <= $date->poll_ends)
                    @if($showPollClose)
                        <div class="text-xs text-center text-gray-500">
                            @if ($date->poll_is_open)
                                @if ($date->poll_ends > \Carbon\Carbon::today())
                                    Schließt {{ $date->poll_ends->diffForHumans() }}
                                @elseif ($date->poll_ends == \Carbon\Carbon::today())
                                    Schließt heute
                                @endif
                            @else
                                Rückmeldung geschlossen
                            @endif
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('poll', $date) }}" class="flex justify-center">
                            <x-button>
                                @if (auth()->user()->dateOptions()->where('date_id', $date->id)->count() > 0)
                                    <i class="far fa-calendar-check text-primary-600" title="Du hast dich rückgemeldet."></i>
                                @else
                                    <i class="far fa-calendar-plus text-yellow-500 animate-pulse" title="Du hast dich noch nicht rückgemeldet."></i>
                                @endif
                                <span class="hidden sm:inline-block pl-1">{{ $slot }}</span>
                            </x-button>
                        </a>
                    </div>
                @endif
            </div>
        @endif
    @endif
@endauth
