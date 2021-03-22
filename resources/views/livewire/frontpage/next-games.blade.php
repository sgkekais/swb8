@if ($next_matches)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($next_matches->filter() as $next_match)
            <div>
                <x-box-with-shadow>
                    <div class="absolute flex flex-col top-0 left-0 font-bold text-sm text-center">
                        <div class="p-1 bg-gray-300 ">
                            @if ($next_match->match->teamHome->owner)
                                {{ $next_match->match->teamHome->name_code }}
                            @elseif ($next_match->match->teamAway->owner)
                                {{ $next_match->match->teamAway->name_code }}
                            @endif
                        </div>
                        <div class="p-1 {{ $next_match->match->teamHome->owner ? "bg-gray-700 text-white" : "bg-gray-100 text-black" }}">
                            @if ($next_match->match->teamHome->owner)
                                H
                            @elseif ($next_match->match->teamAway->owner)
                                A
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="flex flex-1 justify-center items-center text-sm space-x-2">
                            <x-date-and-match-type :date="$next_match" />
                        </div>
                        <div class="flex items-center">
                            <!-- home -->
                            <div class="flex-1 flex-col text-center font-bold">
                                <img src="{{ $next_match->match->teamHome->logo() }}" class="m-auto w-16 h-auto"/>
                                <span>{{ $next_match->match->teamHome->name  }}</span>
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
                                <img src="{{ $next_match->match->teamAway->logo() }}" class="m-auto w-16 h-auto"/>
                                <span class="tracking-tighter">{{ $next_match->match->teamAway->name  }}</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                            @if ($next_match->location->url)
                                <a href="{{ $next_match->location->url }}" target="_blank" class="inline-link " title="Auf Google Maps zeigen">{{ $next_match->location ? $next_match->location->name_short : "-" }}</a>
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
