<div class="flex flex-col w-full">
    <div class="text-center">
        {{ $next_match->datetime->isoFormat('dddd') }}
    </div>
    <div class="text-center">
        {{ $next_match->datetime->isoFormat('DD.MM.') }}, {{ $next_match->datetime->isoFormat('H:mm') }} Uhr
    </div>
    <div class="text-center">
        {{ $next_match->match->matchType->description }}
    </div>
    <div class="flex items-center">
        <!-- home -->
        <div class="flex-1 flex-col text-center">
            <img src="{{ $next_match->match->teamHome->logo() }}" class="m-auto"/>
            <span>{{ $next_match->match->teamHome->name_short  }}</span>
        </div>
        <!-- result -->
        <div class="flex-1 text-center">
            -:-
        </div>
        <!-- away -->
        <div class="flex-1 flex-col text-center">
            <img src="{{ $next_match->match->teamAway->logo() }}" class="m-auto"/>
            <span>{{ $next_match->match->teamAway->name_short  }}</span>
        </div>
    </div>
    <div class="text-center">
        <i class="fas fa-map-marker-alt text-red-500"></i> {{ $next_match->location->name }}
    </div>
    {{-- poll --}}
    {{-- is date valid for me, i.e. date->clubs contains at least one of player->clubs --}}
    @auth
        @if ($next_match->clubs->intersect(auth()->user()->player->clubs) && $next_match->poll_begins && $next_match->poll_ends)
            <div class="flex flex-grow justify-end items-center space-x-2">
                {{-- if open -> participate in poll --}}
                <div class="flex flex-col space-y-1 text-right">
                    @if ($next_match->poll_is_open && $today >= $next_match->poll_begins && $today <= $next_match->poll_ends)
                        <a href="{{ route('poll', $next_match) }}" class="flex justify-end">
                            <x-button>
                                <i class="far fa-calendar-plus pr-1" title="Rückmelden" ></i>Rückmelden
                            </x-button>
                        </a>
                        <div class="text-xs">
                            @if (auth()->user()->dateOptions()->where('date_id', $next_match->id)->count() > 0)
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
</div>
