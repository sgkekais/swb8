<div>
    <div class="mb-6 flex flex-wrap space-x-2">
        <span class="font-bold">Springe zu: </span>
        <a href="#tore" class="inline-link">Tore</a> ({{ $my_goals->count() }})
        <a href="#assists" class="inline-link">Assists</a> ({{ $my_assists->count() }})
        <a href="#karten" class="inline-link">Karten</a> ({{ $my_cards->count() }})
    </div>

    <x-headline id="tore" class="text-xl">Deine Tore</x-headline>

    <div class="mb-6 flex flex-col">
        @foreach ($my_goals->sortByDesc('match.date.datetime') as $my_goal)
            <x-box-with-shadow class="-mt-1">
                <div class="flex space-x-2 items-center">
                    <div class="font-bold w-8 text-center">
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
                                <span class="font-bold">{{ $my_goal->match->teamHome->name }}</span>
                                <span class="">
                                    {{ $my_goal->match->goals_home }}:{{ $my_goal->match->goals_away }}
                                </span>
                                <span class="font-bold">{{ $my_goal->match->teamAway->name }}</span>
                            </div>
                            <div>
                                am {{ $my_goal->match->date->datetime->isoFormat('DD.MM.YYYY') }}
                            </div>
                            @if ($my_goal->assist)
                                <div>
                                    <i class="fas fa-hands-helping"></i> Vorlage durch {{ $my_goal->assist->player->name }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </x-box-with-shadow>
        @endforeach
    </div>

    <x-headline id="assists" class="text-xl">Deine Assists</x-headline>

    <div>
        {{ $my_assists->count() }}
    </div>

    <x-headline id="karten" class="text-xl">Deine Karten</x-headline>

    <div>
        {{ $my_cards->count() }}
    </div>
</div>
