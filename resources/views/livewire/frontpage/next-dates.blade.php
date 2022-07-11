@isset ($next_dates)
    @if ($next_dates->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($next_dates as $next_date)
                <div>
                    <x-box-with-shadow class="p-2" shadow-color="bg-primary-600">
                        @if ($next_date->date_type_id == 2)
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
                                        @if ($next_date->match->teamHome)
                                            <img src="{{ $next_date->match->teamHome->logo() }}" class="m-auto w-16 h-auto" title="{{ $next_date->match->teamHome->name }}" alt="{{ $next_date->match->teamHome->name }}-Wappen"/>
                                            <span>{{ $next_date->match->teamHome->name  }}</span>
                                        @else
                                            <span class="italic">noch unbekannt</span>
                                        @endif
                                    </div>
                                    <!-- result -->
                                    <div class="flex-1 flex-col text-center {{ $next_date->match->cancelled ? "line-through" : null }}">
                                        <div class="text-lg font-bold">
                                            {{ $next_date->datetime->isoFormat('dddd') }}
                                        </div>
                                        <div class="font-bold">
                                            {{ $next_date->datetime->isoFormat('DD.MM.') }} {{ $next_date->datetime->isoFormat('H:mm') }}
                                        </div>
                                        <div class="text-sm">
                                            {{ $next_date->datetime->diffForHumans() }}
                                        </div>
                                    </div>
                                    <!-- away -->
                                    <div class="flex-1 flex-col text-center font-bold">
                                        @if ($next_date->match->teamAway)
                                            <img src="{{ $next_date->match->teamAway->logo() }}" class="m-auto w-16 h-auto" title="{{ $next_date->match->teamHome->name }}" alt="{{ $next_date->match->teamHome->name }}-Wappen"/>
                                            <span class="tracking-tighter">{{ $next_date->match->teamAway->name  }}</span>
                                        @else
                                            <span class="italic">noch unbekannt</span>
                                        @endif
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
                        @elseif ($next_date->date_type_id == 3)
                            <div class="flex items-center justify-center text-sm space-x-2">
                                <x-date-and-match-type :date="$next_date" />
                                <div class="">
                                    {{ $next_date->dateType->description }}
                                </div>
                                @foreach ($next_date->clubs()->pluck('name_code') as $club_name_code)
                                    <div class="p-1 bg-gray-100 text-xs font-bold">{{ $club_name_code }}</div>
                                @endforeach
                            </div>
                            <div class="flex items-center justify-center text-center font-bold">
                                {{ $next_date->tournament->title }}
                            </div>
                            <div class="py-2 flex items-center space-x-4 {{ $next_date->cancelled ? "line-through" : null }}">
                                <div class="flex-1 flex-col text-center justify-center items-center w-1/2">
                                    <div class="text-lg font-bold">
                                        {{ $next_date->datetime->isoFormat('dddd') }}
                                    </div>
                                    <div class="font-bold">
                                        {{ $next_date->datetime->isoFormat('DD.MM.') }} {{ $next_date->datetime->isoFormat('H:mm') }}
                                    </div>
                                    <div class="text-sm">
                                        {{ $next_date->datetime->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="flex-1 flex-col text-center justify-center items-center w-1/2">
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
                        @elseif ($next_date->date_type_id == 4)
                            <div class="flex items-center justify-center text-sm space-x-2">
                                <x-date-and-match-type :date="$next_date" />
                                <div class="">
                                    {{ $next_date->dateType->description }}
                                </div>
                                @foreach ($next_date->clubs()->pluck('name_code') as $club_name_code)
                                    <div class="p-1 bg-gray-100 text-xs font-bold">{{ $club_name_code }}</div>
                                @endforeach
                            </div>
                            <div class="py-2 flex items-center space-x-4 {{ $next_date->cancelled ? "line-through" : null }}">
                                <div class="flex-1 text-center text-lg">
                                    {{ $next_date->title }}
                                </div>
                                <div class="flex-1 flex-col text-center justify-center items-center w-1/2">
                                    <div class="text-lg font-bold">
                                        {{ $next_date->datetime->isoFormat('dddd') }}
                                    </div>
                                    <div class="font-bold">
                                        {{ $next_date->datetime->isoFormat('DD.MM.') }} {{ $next_date->datetime->isoFormat('H:mm') }}
                                    </div>
                                    <div class="text-sm">
                                        {{ $next_date->datetime->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="flex-1 flex-col">
                                    @foreach ($next_date->dateOptions as $dateOption)
                                        <div class="flex items-center space-x-2 text-sm">
                                            <i class="fas fa-vote-yea text-gray-700"></i>
                                            <span>{{ $dateOption->description }}</span>
                                        </div>
                                    @endforeach
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
                        @endif
                    </x-box-with-shadow>

                    <x-participate-button :date="$next_date" class="mt-4 flex flex-row justify-end items-center space-x-2" >
                        Rückmelden
                    </x-participate-button>
                </div>
            @endforeach
        </div>
    @else
        <span class="text-white">Findet nix statt. ¯\_(ツ)_/¯</span>
    @endif
@endisset

