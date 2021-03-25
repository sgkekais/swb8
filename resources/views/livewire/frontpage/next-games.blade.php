@if ($next_dates)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($next_dates->filter() as $next_date)
            <div>
                <x-box-with-shadow>
                    <div class="absolute flex flex-col top-0 left-0 font-bold text-sm text-center">
                        <div class="p-1 bg-gray-300 ">
                            @if ($next_date->match->teamHome->owner)
                                {{ $next_date->match->teamHome->name_code }}
                            @elseif ($next_date->match->teamAway->owner)
                                {{ $next_date->match->teamAway->name_code }}
                            @endif
                        </div>
                        <div class="p-1 {{ $next_date->match->teamHome->owner ? "bg-gray-700 text-white" : "bg-gray-100 text-black" }}">
                            @if ($next_date->match->teamHome->owner)
                                H
                            @elseif ($next_date->match->teamAway->owner)
                                A
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col w-full {{ $next_date->match->cancelled ? "text-gray-500" : null }}">
                        <div class="flex flex-1 justify-center items-center text-sm space-x-2">
                            @unless ($next_date->match->cancelled)
                                <x-date-and-match-type :date="$next_date" />
                            @else
                                <span class="font-bold text-red-700 animate-pulse">ABGESAGT</span>
                            @endif
                        </div>
                        <div class="flex items-center">
                            <!-- home -->
                            <div class="flex-1 flex-col text-center font-bold">
                                <img src="{{ $next_date->match->teamHome->logo() }}" class="m-auto w-16 h-auto"/>
                                <span>{{ $next_date->match->teamHome->name  }}</span>
                            </div>
                            <!-- result -->
                            <div class="flex-1 flex-col text-center {{ $next_date->match->cancelled ? "line-through" : null }}">
                                <div class="text-lg font-bold">
                                    {{ $next_date->datetime->isoFormat('dddd') }}
                                </div>
                                <div class="">
                                    {{ $next_date->datetime->isoFormat('DD.MM.') }} <strong>{{ $next_date->datetime->isoFormat('H:mm') }}</strong>
                                </div>
                                <div class="text-sm">
                                    {{ $next_date->datetime->diffForHumans() }}
                                </div>
                            </div>
                            <!-- away -->
                            <div class="flex-1 flex-col text-center font-bold">
                                <img src="{{ $next_date->match->teamAway->logo() }}" class="m-auto w-16 h-auto"/>
                                <span class="tracking-tighter">{{ $next_date->match->teamAway->name  }}</span>
                            </div>
                        </div>
                        <div class="text-center">
                            @if( $next_date->location)
                                <i class="fas fa-map-marker-alt text-red-500"></i>
                                @if ($next_date->location->url)
                                    <a href="{{ $next_date->location->url }}" target="_blank" class="inline-link " title="Auf Google Maps zeigen">{{ $next_date->location ? $next_date->location->name_short : "-" }}</a>
                                    <i class="fas fa-external-link-alt text-gray-700 fa-sm"></i>
                                @else
                                    {{ $next_date->location->name_short ?: $next_date->location->name }}
                                @endif
                            @endif
                        </div>
                    </div>
                </x-box-with-shadow>

                <x-participate-button :date="$next_date" class="flex flex-row justify-end items-center space-x-2 mt-4" >
                    Rückmelden
                </x-participate-button>
            </div>
        @endforeach
    </div>
@endif
