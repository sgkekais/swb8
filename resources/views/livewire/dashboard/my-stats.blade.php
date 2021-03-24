<div>
    <div class="mb-6 flex flex-wrap space-x-2">
        <span class="font-bold">Springe zu: </span>
        <a href="#tore" class="inline-link">Tore</a> ({{ $my_goals->count() }})
        <a href="#assists" class="inline-link">Assists</a> ({{ $my_assists->count() }})
        <a href="#karten" class="inline-link">Karten</a> ({{ $my_cards->count() }})
    </div>

    <!-- My Goals -->
    <x-headline id="tore" class="text-xl">Deine Tore</x-headline>

    <div class="mb-6 flex flex-col">
        @foreach ($my_goals->sortByDesc('match.date.datetime') as $my_goal)
            <x-box-with-shadow class="-mt-1">
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
    <x-headline id="assists" class="text-xl">Deine Assists</x-headline>

    <div class="mb-6 flex flex-col">
        @foreach ($my_assists->sortByDesc('goal.match.date.datetime') as $my_assist)
            <x-box-with-shadow class="-mt-1">
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
    <x-headline id="karten" class="text-xl">Deine Karten</x-headline>

    <div class="mb-6 flex flex-col">
        @foreach ($my_cards->sortByDesc('match.date.datetime') as $my_card)
            <x-box-with-shadow class="-mt-1">
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
</div>
