<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4">
    @foreach ($last_dates as $last_date)
        @if ($last_date->match->isPlayedOrRated())
            <div class="border border-black">
                {{ $last_date->id }}
                <div class="flex items-center">
                    <!-- home -->
                    <div class="flex-1 flex-col text-center font-bold">
                        <img src="{{ $last_date->match->teamHome->logo() }}" class="m-auto w-12"/>
                        <span>{{ $last_date->match->teamHome->name_short  }}</span>
                    </div>
                    <!-- result -->
                    <div class="flex-1 flex-col text-center">
                        <div class="">
                            {{ $last_date->match->matchType->description }}{{ $last_date->match->matchweek ? ", ".$last_date->match->matchweek.". ST"  : null}}
                        </div>
                        <div class="">
                            {{ $last_date->datetime->isoFormat('DD.MM.') }}, {{ $last_date->datetime->isoFormat('H:mm') }} Uhr
                        </div>
                        <div class="py-2 font-bold text-3xl">
                            @if ($last_date->match->isRated())
                                {{ $last_date->match->goals_home_rated }}:{{ $last_date->match->goals_away_rated }}
                            @elseif ($last_date->match->isPlayed())
                                @php
                                    $result_color = "";
                                    if ($last_date->match->isWon()) {
                                        $result_color = "text-primary-600";
                                    } elseif ($last_date->match->isLost()) {
                                        $result_color = "text-red-600";
                                    }
                                @endphp
                                <div class="{{ $result_color }}">{{ $last_date->match->goals_home }}:{{ $last_date->match->goals_away }}</div>
                                @if ($last_date->match->goals_home_ht && $last_date->match->goals_away_ht)
                                    <div class="text-base">({{ $last_date->match->goals_home_ht }}:{{ $last_date->match->goals_away_ht }})</div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <!-- away -->
                    <div class="flex-1 flex-col text-center font-bold">
                        <img src="{{ $last_date->match->teamAway->logo() }}" class="m-auto w-12"/>
                        <span>{{ $last_date->match->teamAway->name_short  }}</span>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ $last_date->location->url }}" target="_blank" title="Auf Google Maps zeigen">
                        <i class="fas fa-map-marker-alt text-red-500"></i> {{ $last_date->location ? $last_date->location->name : "-" }}
                    </a>
                </div>
                <!-- goals and cards -->
                @if ($last_date->match->goals->count() > 0 || $last_date->match->cards->count() > 0)
                    <div class="p-1 flex justify-center bg-gray-100">
                        @if ($last_date->match->goals->count() > 0)
                            <div class="flex flex-col">
                                @foreach ($last_date->match->goals as $goal)
                                    <div class="flex space-x-2 items-center">
                                        <i class="far fa-futbol"></i>
                                        <div class="">
                                            {{ $goal->minute ? $goal->minute."'" : null }} {{ $goal->score }} {{ $goal->player->nickname ?: $goal->player->full_name_short }}
                                        </div>
                                        @if ($goal->assist)
                                            <div class="text-sm">
                                                ({{ $goal->assist->player->nickname ?: $goal->assist->player->full_name_short }})
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if ($last_date->match->cards->count() > 0)
                            <div class="flex flex-col">
                                @foreach ($last_date->match->cards as $card)
                                    <div class="flex-col">
                                        <div>
                                            @switch($card->color)
                                                @case('gelb')
                                                <i class="fas fa-square text-yellow-400"></i>
                                                @break
                                                @case('gelb-rot')
                                                <i class="fas fa-square text-yellow-400"></i><i class="fas fa-square text-red-500"></i>
                                                @break
                                                @case('rot')
                                                <i class="fas fa-square text-red-500"></i>
                                                @break
                                                @case('10min')
                                                <i class="fas fa-stopwatch text-gray-400 "></i>
                                                @break
                                            @endswitch
                                            {{ $card->player->nickname ?: $card->player->full_name_short }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
                {{-- match details --}}
                @if ($last_date->match->match_details)
                    <div class="p-1 bg-gray-300">
                        {!! $last_date->match->match_details !!}
                    </div>
                @endif
            </div>
        @endif

    @endforeach
</div>
