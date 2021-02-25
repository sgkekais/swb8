<div>
    <div class="mb-3 flex items-center space-x-2">
        <x-select-label for="selected_season">Saison: </x-select-label>
        <select name="selected_season" wire:model="selected_season">
            @foreach ($selectable_seasons as $selected_season)
                <option value="{{ $selected_season->id }}">{{ $selected_season->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex text-right text-xl font-bold">
        <div class="w-1/2">
            Tore: {{ $season->goals_count }}
        </div>
        <div class="w-1/2">
            Vorlagen: {{ $season->assists_count }}
        </div>
    </div>
    <div wire:loading>
        <i class="far fa-futbol fa-spin" ></i>
    </div>
    <div class="flex space-x-2">
        <!-- scorers -->
        <div class="flex w-1/2 flex-col space-y-2" wire:loading.remove>
            @php
                $scorer_place = 1;
                $prev_goals_total = 0;
                $prev_place = 0;
                $scorer_place_color = "";
            @endphp
            @foreach($scorers as $scorer)
                @php
                    if ($scorer->goals_total < $prev_goals_total)
                    {
                        $scorer_place++;
                    }
                    if ($scorer_place == 1)
                    {
                        $scorer_place_color = "bg-yellow-300";
                    } elseif ($scorer_place == 2) {
                        $scorer_place_color = "bg-gray-400";
                    } elseif ($scorer_place == 3) {
                       $scorer_place_color = "bg-yellow-600";
                    } else {
                        $scorer_place_color = "bg-white";
                    }
                @endphp
                <div class="flex items-center">
                    <div class="p-2 text-lg">
                        <div class="rounded-full h-8 w-8 flex items-center justify-center {{ $scorer_place_color }}" >
                            @if ($scorer_place != $prev_place || $scorer_place < 4)
                                {{ $scorer_place }}
                            @else
                                &nbsp;
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="flex w-full items-center justify-between">
                            <div class="">
                                {{ $scorer->nickname }}
                            </div>
                        </div>
                        <div class="flex w-full">
                            <div class="h-2 bg-primary-600" style="width: {{ ceil(($scorer->goals_total / ($season->goals_count))*100) }}% ">

                            </div>
                        </div>
                        <div class="flex items-center w-full text-gray-600 text-xs space-x-1">
                            @foreach ($scorer->player_goals->groupBy('match.matchType.id')->sortKeys() as $player_goal_type => $player_goal_type_goals)
                                <div class="flex space-x-1">
                                    <div>
                                        {{ $player_goal_type_goals->first()->match->matchType->description }}
                                    </div>
                                    <div class="font-bold">
                                        {{ $player_goal_type_goals->count() }}
                                    </div>
                                    @if ($player_goal_type_goals->where('penalty')->count() > 0)
                                        <div>
                                            (<span class="font-bold">{{ $player_goal_type_goals->where('penalty')->count() }}</span> 11m)
                                        </div>
                                    @endif
                                    @unless($loop->last)
                                        <div>
                                            ,
                                        </div>
                                    @endunless
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-lg font-bold">
                        {{ $scorer->goals_total }}
                    </div>
                </div>
                @php
                    $prev_goals_total = $scorer->goals_total;
                    $prev_place = $scorer_place;
                @endphp
            @endforeach
        </div>
        <!-- assists -->
        <div class="flex w-1/2 flex-col space-y-2" wire:loading.remove>
            @php
                $assist_place = 1;
                $prev_assist_total = 0;
                $prev_assist_place = 0;
                $assist_place_color = "";
            @endphp
            @foreach($assist_players as $assist_player)
                @php
                    if ($assist_player->assists_total < $prev_assist_total)
                    {
                        $assist_place++;
                    }
                    if ($assist_place == 1)
                    {
                        $assist_place_color = "bg-yellow-300";
                    } elseif ($assist_place == 2) {
                        $assist_place_color = "bg-gray-400";
                    } elseif ($assist_place == 3) {
                       $assist_place_color = "bg-yellow-600";
                    } else {
                        $assist_place_color = "bg-white";
                    }
                @endphp
                <div class="flex items-center">
                    <div class="p-2 text-lg">
                        <div class="rounded-full h-8 w-8 flex items-center justify-center {{ $assist_place_color }}" >
                            @if ($assist_place != $prev_assist_place || $assist_place < 4)
                                {{ $assist_place }}
                            @else
                                &nbsp;
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="flex w-full items-center justify-between">
                            <div class="">
                                {{ $assist_player->nickname }}
                            </div>
                        </div>
                        <div class="flex w-full">
                            <div class="h-2 bg-primary-600" style="width: {{ ceil(($assist_player->assists_total / ($season->assists_count))*100) }}% ">

                            </div>
                        </div>
                        <div class="flex items-center w-full text-gray-600 text-xs space-x-1">
                            @foreach ($assist_player->player_assists->groupBy('goal.match.matchType.id')->sortKeys() as $player_assist_type => $player_assist_type_assists)
                                <div class="flex space-x-1">
                                    <div>
                                        {{ $player_assist_type_assists->first()->goal->match->matchType->description }}
                                    </div>
                                    <div class="font-bold">
                                        {{ $player_assist_type_assists->count() }}
                                    </div>
                                    @unless($loop->last)
                                        <div>
                                            ,
                                        </div>
                                    @endunless
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-lg font-bold">
                        {{ $assist_player->assists_total }}
                    </div>
                </div>
                @php
                    $prev_assist_total = $assist_player->assists_total;
                    $prev_assist_place = $assist_place;
                @endphp
            @endforeach
        </div>
    </div>

</div>
