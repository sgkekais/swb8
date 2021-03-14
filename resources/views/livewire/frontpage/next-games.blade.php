@if ($next_matches)
    <div class="flex flex-col lg:flex-row w-full space-x-2">
        @foreach ($next_matches->filter() as $next_match)
            <div class="flex flex-col {{ $next_matches->count() > 1 ? "lg:w-1/2" : null }}">
                <x-box-with-shadow>
                    <x-slot name="header">
                        <div class="text-xl text-gray-700">
                            @if ($next_match->match->teamHome->owner)
                                {{ $next_match->match->teamHome->name_code }}
                            @elseif ($next_match->match->teamAway->owner)
                                {{ $next_match->match->teamAway->name_code }}
                            @endif
                        </div>
                    </x-slot>
                    <div class="flex flex-col w-full">
                        <div class="text-center text-sm">
                            {{ $next_match->match->matchType->description }} {{ $next_match->match->matchweek ? $next_match->match->matchweek.".ST" : null }}
                        </div>
                        <div class="flex items-center">
                            <!-- home -->
                            <div class="flex-1 flex-col text-center font-bold">
                                <img src="{{ $next_match->match->teamHome->logo() }}" class="m-auto w-20 h-auto"/>
                                <span>{{ $next_match->match->teamHome->name_short  }}</span>
                            </div>
                            <!-- result -->
                            <div class="flex-1 flex-col text-center">
                                <div class="text-lg font-bold">
                                    {{ $next_match->datetime->isoFormat('dddd') }}
                                </div>
                                <div class="">
                                    {{ $next_match->datetime->isoFormat('DD.MM.') }} <strong>{{ $next_match->datetime->isoFormat('H:mm') }}</strong>
                                </div>
                                <div class="text-sm">
                                    {{ $next_match->datetime->diffForHumans() }}
                                </div>
                            </div>
                            <!-- away -->
                            <div class="flex-1 flex-col text-center font-bold">
                                <img src="{{ $next_match->match->teamAway->logo() }}" class="m-auto w-20 h-auto"/>
                                <span>{{ $next_match->match->teamAway->name_short  }}</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                            @if ($next_match->location->url)
                                <a href="{{ $next_match->location->url }}" target="_blank" class="text-primary-700 underline hover:no-underline" title="Auf Google Maps zeigen">{{ $next_match->location ? $next_match->location->name_short : "-" }}</a>
                                <i class="fas fa-external-link-alt text-gray-700 fa-sm"></i>
                            @else
                                {{ $next_match->location ? $next_match->location->name_short : "-" }}
                            @endif
                        </div>
                    </div>
                </x-box-with-shadow>

                <x-participate-button :date="$next_match" class="flex flex-row justify-end items-center space-x-2 mt-4" />
            </div>
        @endforeach
    </div>
@endif
