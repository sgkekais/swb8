<x-section>

    <div>
        <div class="mb-6 flex flex-col space-y-4 md:space-y-0 md:flex-row">
            <div>
                <x-select-label for="selected_season" class="text-primary-700">
                    Saison:
                </x-select-label>
                <x-select name="selected_season" wire:model="selected_season">
                    @foreach ($seasons as $season)
                        <option value="{{ $season->id }}">{{ $season->title }}</option>
                    @endforeach
                </x-select>
            </div>
            <!-- season stats -->
            <div class="flex flex-1 justify-around font-bold items-center text-3xl divide-x divide-gray-200 tracking-tighter" wire:loading.remove>
                <div class="flex flex-1 flex-col items-center">
                    <span class="text-gray-700">
                        {{ $stat_count_wins }}
                    </span>
                    <span class="font-normal text-xl text-gray-500">
                        S
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center">
                    <span class="text-gray-700">
                         {{ $stat_count_draws }}
                    </span>
                    <span class="font-normal text-xl text-gray-500">
                        U
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center">
                    <span class="text-gray-700">
                        {{ $stat_count_losses }}
                    </span>
                    <span class="font-normal text-xl text-gray-500">
                        N
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center">
                    <span class="text-gray-700">
                        {{ $stat_count_goals }}
                    </span>
                    <span class="font-normal text-lg text-gray-500">
                        <i class="far fa-futbol"></i>
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center">
                    <span class="text-gray-700">
                        {{ $stat_count_cards }}
                    </span>
                    <span class="font-normal text-lg text-gray-500">
                        <i class="far fa-copy"></i>
                    </span>
                </div>
                @if ($matches->first()->season->final_position)
                    <div class="flex flex-1 flex-col items-center">
                        <span class="text-yellow-500">
                            {{ $matches->first()->season->final_position }}.
                        </span>
                        <span class="font-normal text-xl text-gray-500">
                            Pl.
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <x-load-indicator />

        @if ($matches->first()->season->description)
            <div class="flex items-center p-4 mb-4 border border-gray-700 space-x-4" wire:loading.remove>
                <div class="">
                    <i class="far fa-lightbulb"></i>
                </div>
                <div class="">
                    {{ $matches->first()->season->description }}
                </div>
            </div>
        @endif
        <div class="flex items-center p-4 mb-4 border border-yellow-500 space-x-4" wire:loading.remove>
            <div class="">
                <i class="fas fa-info"></i>
            </div>
            <div class="">
                Klick auf eine Zeile, um Tore, Karten und den Spielbericht einzublenden!
            </div>
        </div>
        <div class="divide-y divide-gray-200" wire:loading.remove>
            @php
                $points = 0;
                $goals_for = 0;
                $goals_against = 0;
            @endphp
            @foreach ($matches->sortBy('date.datetime') as $match)
                <div x-data="{ show:false }">
                    <!-- match type and datetime on mobile -->
                    <div class="p-1 flex md:hidden justify-between space-x-2 text-xs text-gray-700 bg-gray-100">
                        <div class="flex space-x-2">
                        <span class="">
                            {{ $match->matchType->description }}
                        </span>
                            @if ($match->matchweek)
                                <span>
                                {{ $match->matchweek ? ($match->matchType->id == 2 ? $match->matchweek.".ST" : $match->matchweek) : null }}
                            </span>
                            @endif
                            @if ($match->date->datetime)
                                <span class="font-bold">{{ $match->date->datetime->isoFormat('DD.MM.YY') }}</span>
                                <span>um</span>
                                <span class="font-bold">{{ $match->date->datetime->format('H:i') }}</span>
                            @endif
                        </div>
                        @isset($match->date->location)
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-map-marker-alt text-red-500"></i>
                                <span class="">{{ $match->date->location->name_short }}</span>
                            </div>
                        @endisset
                    </div>
                    <!-- match row -->
                    <div @click="show=!show" class="flex flex-row min-h-16 {{ $match->cancelled ? "text-gray-500" : null }} cursor-pointer hover:bg-gray-100" >
                        {{-- first, icon + datetime --}}
                        <div class="w-1/4 flex ">
                            <!-- home away -->
                            <div class="flex {{ $match->teamHome->owner ? "bg-gray-50" : "bg-gray-100" }} items-center p-1">
                                @if ($match->teamHome->owner)
                                    H
                                @elseif ($match->teamAway->owner)
                                    A
                                @endif
                            </div>
                            <!-- icon -->
                            <div class="p-1 flex w-full md:w-2/6 justify-center items-center">
                                @if ($match->matchType->id == 1)
                                    <i class="far fa-handshake sm:fa-lg text-blue-600"></i>
                                @elseif ($match->matchType->id == 2)
                                    <x-hlw-logo class="fill-current text-primary-600 h-3 sm:h-4"/>
                                @elseif ($match->matchType->id == 3)
                                    <i class="fas fa-trophy sm:fa-lg text-yellow-600"></i>
                                @elseif ($match->matchType->id == 4)
                                    <x-hlw-logo class="fill-current text-primary-600 h-3 sm:h-4"/>
                                @endif
                            </div>
                            {{-- matchtype + datetime --}}
                            <div class="p-1 hidden md:flex flex-col flex-1 justify-center">
                                <div class="flex text-xs text-gray-700 space-x-2">
                                <span class="">
                                    {{ $match->matchType->description }}
                                </span>
                                <span>
                                    {{ $match->matchweek ? ($match->matchType->id == 2 ? $match->matchweek.".ST" : $match->matchweek) : null }}
                                </span>
                                </div>
                                <div class="flex flex-row space-x-2 {{ $match->cancelled ? "line-through" : null }}">
                                    @if ($match->date->datetime)
                                        <span>{{ $match->date->datetime->isoFormat('DD.MM.YY') }}</span>
                                        <span>{{ $match->date->datetime->format('H:i') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- second, teams and result --}}
                        <div class="w-2/4 flex justify-around">
                            {{-- home team --}}
                            <div class="w-2/5 flex flex-col flex-col-reverse sm:flex-row justify-center sm:justify-end items-center sm:space-x-2 tracking-tighter text-right">
                                <span class="inline-block md:hidden text-sm">{{ $match->teamHome->name_code }}</span>
                                <span class="hidden md:inline-block lg:hidden">{{ $match->teamHome->name_short }}</span>
                                <span class="hidden lg:inline-block">{{ $match->teamHome->name }}</span>
                                <img src="{{ $match->teamHome->logo() }}" class="w-8 h-auto" alt="{{ $match->teamHome->name_short." Logo" }}"/>
                            </div>
                            {{-- result --}}
                            <div class="w-1/5 flex flex-col justify-center">
                                @if ($match->cancelled)
                                    <div class="text-center no-underline text-red-500">
                                        Abgs.
                                    </div>
                                @elseif ($match->isPlayedOrRated())
                                    <div class="p-1 flex flex-col font-extrabold text-center ">
                                        @php
                                            $score_color = "text-black";
                                            if ($match->isRated()) {
                                                $score_color = "text-yellow-500";
                                            } elseif ($match->isWon() && !$match->cancelled) {
                                                $score_color = "text-primary-600";
                                            } elseif ($match->isLost() && !$match->cancelled) {
                                                $score_color = "text-red-500";
                                            }
                                        @endphp
                                        @if ($match->isRated())
                                            <i class="fas fa-gavel text-xs {{ $score_color }}"></i>
                                            <span class="{{ $score_color }}">{{ $match->goals_home_rated }}:{{ $match->goals_away_rated }}</span>
                                            @if ($match->isPlayed())
                                                <span class="text-sm">Alt: {{ $match->goals_home }}:{{ $match->goals_away }}</span>
                                            @endif
                                        @elseif ($match->isPenalties())
                                            <span class="{{ $score_color }}">{{ $match->goals_home_pen }}:{{ $match->goals_away_pen}} i.E.</span>
                                            <span class="text-sm">90' {{ $match->goals_home }}:{{ $match->goals_away }}</span>
                                        @else
                                            <span class="{{ $score_color }}">{{ $match->goals_home }}:{{ $match->goals_away }}</span>
                                        @endif
                                    </div>
                                    @if ($match->goals_home_ht && $match->goals_away_ht)
                                        <div class="text-center text-sm ">
                                            ({{ $match->goals_home_ht }}:{{ $match->goals_away_ht }})
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center">-:-</div>
                                @endif
                            </div>
                            {{-- away team --}}
                            <div class="w-2/5 flex flex-col sm:flex-row justify-center sm:justify-start items-center sm:space-x-2 tracking-tighter text-left">
                                <img src="{{ $match->teamAway->logo() }}" class="w-8 h-auto" alt="{{ $match->teamAway->name_short." Logo" }}"/>
                                <span class="inline-block md:hidden text-sm">{{ $match->teamAway->name_code }}</span>
                                <span class="hidden md:inline-block lg:hidden">{{ $match->teamAway->name_short }}</span>
                                <span class="hidden lg:inline-block">{{ $match->teamAway->name }}</span>
                            </div>
                        </div>
                        {{-- third, location and points --}}
                        <div class="w-1/4 flex justify-around">
                            <div class="hidden md:flex flex-1 items-center text-sm">
                                @isset($match->date->location)
                                    <span class="lg:hidden">{{ $match->date->location->name_short }}</span>
                                    <span class="hidden lg:inline-flex">{{ $match->date->location->name }}</span>
                                @endisset
                            </div>
                            <div class="w-2/12 flex items-center justify-center tracking-tighter">
                                @if ($match->matchType->is_point_match)
                                    @if ($match->isWon())
                                        @php
                                            $points += 3;
                                        @endphp
                                    @elseif ($match->isDraw())
                                        @php
                                            $points += 1;
                                        @endphp
                                    @endif
                                    {{ $points }}
                                @endif
                            </div>
                            <div class="w-3/12 flex items-center justify-center tracking-tighter">
                                @if ($match->matchType->is_point_match)
                                    @if ($match->teamHome->owner)
                                        @if ($match->isRated())
                                            {{ $goals_for += $match->goals_home_rated }}:{{ $goals_against += $match->goals_away_rated }}
                                        @elseif ($match->isPlayed())
                                            {{ $goals_for += $match->goals_home }}:{{ $goals_against += $match->goals_away }}
                                        @endif
                                    @else
                                        @if ($match->isRated())
                                            {{ $goals_for += $match->goals_away_rated }}:{{ $goals_against += $match->goals_home_rated }}
                                        @elseif ($match->isPlayed())
                                            {{ $goals_for += $match->goals_away }}:{{ $goals_against += $match->goals_home }}
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- match details -->
                    <div x-show.transition="show" class="p-4 flex flex-col space-y-2 lg:flex-row lg:space-x-2 lg:space-y-0 bg-gray-100">
                        @if ($match->isPlayedorRated())
                            {{-- goals --}}
                            <div class="flex flex-col lg:w-1/5">
                                <div class="font-bold text-primary-700">
                                    Tore
                                </div>
                                @if ($match->goals->count() > 0)
                                    @foreach ($match->goals as $goal)
                                        <div class="flex space-x-2 items-center">
                                            <div class="w-6">
                                                @unless ($goal->penalty)
                                                    <i class="far fa-futbol"></i>
                                                @else
                                                    <span class="text-sm font-bold tracking-tighter">11m</span>
                                                @endunless
                                            </div>
                                            <div class="">
                                                {{ $goal->minute ? $goal->minute."'" : null }} {{ $goal->score }} {{ $goal->player->name_short }}
                                            </div>
                                            @if ($goal->assist)
                                                <div class="text-sm">
                                                    ({{ $goal->assist->player->name_short }})
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    Flaute
                                @endif
                            </div>
                            {{-- cards --}}
                            <div class="flex flex-col lg:w-1/5">
                                <div class="font-bold text-primary-700">
                                    Karten
                                </div>
                                @if ($match->cards->count() > 0)
                                    @foreach ($match->cards as $card)
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
                                            {{ $card->player->name_short }}
                                        </div>
                                    @endforeach
                                @else
                                    Keine
                                @endif
                            </div>
                            {{-- details --}}
                            <div class="flex flex-col flex-1">
                                <div class="font-bold text-primary-700">
                                    Spielbericht
                                </div>
                                <div>
                                    @if ($match->match_details)
                                        {!! $match->match_details !!}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        @else
                            Hier gibt's (noch) nix zu sehen ¯\_(ツ)_/¯
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-section>

