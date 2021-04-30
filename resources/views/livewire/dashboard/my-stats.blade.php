<div>
    @if (auth()->user()->player)
        <div class="mb-6 flex flex-wrap space-x-2">
            <span class="font-bold">Springe zu: </span>
            <a href="#titles" class="inline-link">Titel</a> ({{ $my_ananas_titles->count() + $my_scorer_titles->count() }})
            <a href="#tore" class="inline-link">Tore</a> ({{ $my_goals->count() }})
            <a href="#assists" class="inline-link">Assists</a> ({{ $my_assists->count() }})
            <a href="#karten" class="inline-link">Karten</a> ({{ $my_cards->count() }})
        </div>

        <!-- My Titles -->
        <x-headline id="titles" class="text-xl">Deine Titel ({{ $my_ananas_titles->count() + $my_scorer_titles->count() }})</x-headline>

        @if ($my_scorer_titles->count() === 0 && $my_ananas_titles->count() === 0)
            <div class="tracking-tighter">¯\_(ツ)_/¯</div>
        @else
            <div class="mb-6 flex flex-col">
                @foreach ($my_scorer_titles->sortBy('is_ah_season')->sortByDesc('number') as $my_scorer_title)
                    <x-box-with-shadow class="p-2 -mt-1" shadow-color="bg-gray-600">
                        <div class="flex space-x-2 items-center">
                            <div class="font-bold text-center text-primary-700">
                                <x-cannon class="h-6 fill-current text-yellow-500" />
                            </div>
                            <div class="">
                                <span class="p-1 font-bold text-sm bg-gray-100">{{ $my_scorer_title->is_ah_season ? "AH" : "HLW" }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-2 sm:items-center">
                                    <div>Torschützenkönig</div>
                                    <div class="font-bold">{{ $my_scorer_title->title }}</div>
                                </div>
                            </div
                        </div>
                    </x-box-with-shadow>
                @endforeach
            </div>
            <div class="mb-6 flex flex-col">
                @foreach ($my_ananas_titles->sortBy('is_ah_season')->sortByDesc('number') as $my_ananas_title)
                    <x-box-with-shadow class="p-2 -mt-1" shadow-color="bg-gray-600">
                        <div class="flex space-x-2 items-center">
                            <div class="font-bold text-center text-primary-700">
                                &#127821;
                            </div>
                            <div class="">
                                <span class="p-1 font-bold text-sm bg-gray-100">{{ $my_ananas_title->is_ah_season ? "AH" : "HLW" }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-2 sm:items-center">
                                    <div>Goldene Ananas</div>
                                    <div class="font-bold">{{ $my_ananas_title->title }}</div>
                                </div>
                            </div>
                        </div>
                    </x-box-with-shadow>
                @endforeach
            </div>
        @endif

        <!-- My Goals -->
        <x-headline id="tore" class="text-xl">Deine Tore ({{ $my_goals->count() }})</x-headline>

        <div class="mb-6 flex flex-col">
            @foreach ($my_goals->sortByDesc('match.date.datetime') as $my_goal)
                <x-box-with-shadow class="p-2 -mt-1" shadow-color="bg-gray-600">
                    <div class="flex space-x-2 items-center">
                        <div class="font-bold w-8 text-center text-primary-700">
                            @if ($my_goal->penalty)
                                11m
                            @else
                                <i class="far fa-futbol"></i>
                            @endif
                        </div>
                        <div class="flex flex-1">
                            <div class="flex flex-col sm:flex-row sm:space-x-2 sm:items-center">
                                <div class="flex items-center space-x-2">
                                    <span>zum</span>
                                    <span class="text-xl font-bold tracking-tighter">{{ $my_goal->score }}</span>
                                    @if ($my_goal->minute)
                                        <span>({{ $my_goal->minute }}')</span>
                                    @endif
                                    <span>im Spiel</span>
                                </div>
                                <div class="flex items-center space-x-2 tracking-tighter">
                                    <span class="sm:hidden font-bold">{{ $my_goal->match->teamHome->name_short }}</span>
                                    <span class="hidden sm:inline-flex font-bold">{{ $my_goal->match->teamHome->name }}</span>
                                    <span class="">
                                        {{ $my_goal->match->goals_home }}:{{ $my_goal->match->goals_away }}
                                    </span>
                                    <span class="sm:hidden font-bold">{{ $my_goal->match->teamAway->name_short }}</span>
                                    <span class="hidden sm:inline-flex font-bold">{{ $my_goal->match->teamAway->name }}</span>
                                </div>
                                <div>
                                    am {{ $my_goal->match->date->datetime->isoFormat('DD.MM.YYYY') }}
                                </div>
                                @if ($my_goal->assist)
                                    <div>
                                        <i class="fas fa-hands-helping text-indigo-700"></i> Vorlage durch {{ $my_goal->assist->player->name }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </x-box-with-shadow>
            @endforeach
        </div>

        <!-- My Assists -->
        <x-headline id="assists" class="text-xl">Deine Assists ({{ $my_assists->count() }})</x-headline>

        <div class="mb-6 flex flex-col">
            @foreach ($my_assists->sortByDesc('goal.match.date.datetime') as $my_assist)
                <x-box-with-shadow class="p-2 -mt-1" shadow-color="bg-gray-600">
                    <div class="flex space-x-2 items-center">
                        <div class="font-bold w-8 text-center">
                            <i class="fas fa-hands-helping text-indigo-700"></i>
                        </div>
                        <div class="flex flex-1">
                            <div class="flex flex-col sm:flex-row sm:space-x-2 sm:items-center">
                                <div class="flex items-center space-x-2">
                                    <span>auf</span>
                                    <span class="text-lg font-bold tracking-tighter">{{ $my_assist->goal->player->name_short }}</span>
                                    <span>zum {{ $my_assist->goal->score }}</span>
                                    <span>im Spiel</span>
                                </div>
                                <div class="flex items-center space-x-2 tracking-tighter">
                                    <span class="sm:hidden font-bold">{{ $my_assist->goal->match->teamHome->name_short }}</span>
                                    <span class="hidden sm:inline-flex font-bold">{{ $my_assist->goal->match->teamHome->name }}</span>
                                    <span class="">
                                        {{ $my_assist->goal->match->goals_home }}:{{ $my_assist->goal->match->goals_away }}
                                    </span>
                                    <span class="sm:hidden font-bold">{{ $my_assist->goal->match->teamAway->name_short }}</span>
                                    <span class="hidden sm:inline-flex font-bold">{{ $my_assist->goal->match->teamAway->name }}</span>
                                </div>
                                <div>
                                    am {{ $my_assist->goal->match->date->datetime->isoFormat('DD.MM.YYYY') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </x-box-with-shadow>
            @endforeach
        </div>

        <!-- My Cards -->
        <x-headline id="karten" class="text-xl">Deine Karten ({{ $my_cards->count() }})</x-headline>

        <div class="mb-6 flex flex-col">
            @foreach ($my_cards->sortByDesc('match.date.datetime') as $my_card)
                <x-box-with-shadow class="p-2 -mt-1" shadow-color="bg-gray-600">
                    <div class="flex space-x-2 items-center">
                        <div class="font-bold w-8 text-center">
                            @switch($my_card->color)
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
                        </div>
                        <div class="flex flex-1">
                            <div class="flex flex-col sm:flex-row sm:space-x-2 sm:items-center">
                                <div>
                                    im Spiel
                                </div>
                                <div class="flex items-center space-x-2 tracking-tighter">
                                    <span class="sm:hidden font-bold">{{ $my_card->match->teamHome->name_short }}</span>
                                    <span class="hidden sm:inline-flex font-bold">{{ $my_card->match->teamHome->name }}</span>
                                    <span class="">
                                        {{ $my_card->match->goals_home }}:{{ $my_card->match->goals_away }}
                                    </span>
                                    <span class="sm:hidden font-bold">{{ $my_card->match->teamAway->name_short }}</span>
                                    <span class="hidden sm:inline-flex font-bold">{{ $my_card->match->teamAway->name }}</span>
                                </div>
                                <div>
                                    am {{ $my_card->match->date->datetime->isoFormat('DD.MM.YYYY') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </x-box-with-shadow>
            @endforeach
        </div>
    @else
        Dir ist kein Spieler zugeordnet.
    @endif
</div>
