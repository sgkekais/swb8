<div class="flex flex-col space-y-2">
    @foreach ($last_matches as $last_match)
        @if ($last_match->match->isPlayedOrRated())
            <div class="border border-black">
                <div class="flex items-center">
                    <!-- home -->
                    <div class="flex-1 flex-col text-center font-bold">
                        <img src="{{ $last_match->match->teamHome->logo() }}" class="m-auto w-12"/>
                        <span>{{ $last_match->match->teamHome->name_short  }}</span>
                    </div>
                    <!-- result -->
                    <div class="flex-1 flex-col text-center">
                        <div class="">
                            {{ $last_match->match->matchType->description }}{{ $last_match->match->matchweek ? ", ".$last_match->match->matchweek.". ST"  : null}}
                        </div>
                        <div class="">
                            {{ $last_match->datetime->isoFormat('DD.MM.') }}, {{ $last_match->datetime->isoFormat('H:mm') }} Uhr
                        </div>
                        <div class="py-2 font-bold text-3xl">
                            @if ($last_match->match->isRated())
                                {{ $last_match->match->goals_home_rated }}:{{ $last_match->match->goals_away_rated }}
                            @elseif ($last_match->match->isPlayed())
                                @php
                                    $result_color = "";
                                    if ($last_match->match->isWon()) {
                                        $result_color = "text-primary-600";
                                    } elseif ($last_match->match->isLost()) {
                                        $result_color = "text-red-600";
                                    }
                                @endphp
                                <div class="{{ $result_color }}">{{ $last_match->match->goals_home }}:{{ $last_match->match->goals_away }}</div>
                                @if ($last_match->match->goals_home_ht && $last_match->match->goals_away_ht)
                                    <div class="text-base">({{ $last_match->match->goals_home_ht }}:{{ $last_match->match->goals_away_ht }})</div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <!-- away -->
                    <div class="flex-1 flex-col text-center font-bold">
                        <img src="{{ $last_match->match->teamAway->logo() }}" class="m-auto w-12"/>
                        <span>{{ $last_match->match->teamAway->name_short  }}</span>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ $last_match->location->url }}" target="_blank" title="Auf Google Maps zeigen">
                        <i class="fas fa-map-marker-alt text-red-500"></i> {{ $last_match->location ? $last_match->location->name : "-" }}
                    </a>
                </div>
                <!-- goals and cards -->
                @if ($last_match->match->goals->count() > 0 || $last_match->match->cards->count() > 0)
                    <div class="p-1 flex justify-center bg-gray-200">
                        @if ($last_match->match->goals->count() > 0)
                            <div class="flex flex-col">
                                @foreach ($last_match->match->goals as $goal)
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
                        @if ($last_match->match->cards->count() > 0)
                            <div class="flex flex-col">
                                @foreach ($last_match->match->cards as $card)
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
                <!-- old match details -->
                @if ($last_match->match->match_details)
                    <div class="p-1 flex justify-center bg-gray-100">
                        {{ $last_match->match->match_details }}
                    </div>
                @endif
            </div>
        @endif

    @endforeach
</div>
