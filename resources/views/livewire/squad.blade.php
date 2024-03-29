<x-section class="py-0">
    @auth
        <div class="flex items-center p-4 mb-4 border border-yellow-500 space-x-4">
            <div class="">
                <i class="fas fa-info fa-fw"></i>
            </div>
            <div class="">
                Vollständige Namen werden nur angemeldeten Mitgliedern angezeigt.
            </div>
        </div>
    @endauth
    <div class="mb-4 flex flex-wrap items-center space-x-2 ">
        <div class="">
            <span class="font-bold">Springe zu:</span>
        </div>
        @foreach ($club->players->where('pivot.playerStatus.display_in_squad')->sortBy('pivot.playerStatus.sort_order')->groupBy('pivot.playerStatus.description') as $key => $player_status_group)
            <div>
                <a href="#{{ $key }}" class="inline-link">{{ $key }}</a> ({{ $player_status_group->count() }})
            </div>
        @endforeach
    </div>
    @if ($club->players()->count() > 0)
        @foreach($club->players->where('pivot.playerStatus.display_in_squad')->sortBy('pivot.playerStatus.sort_order')->groupBy('pivot.playerStatus.description') as $key => $player_status_group)
            <x-headline class="text-2xl" id="{{ $key }}">
                {{ $key }}
            </x-headline>
            <div class="pb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 ">
                @foreach($player_status_group->sortBy('name_short') as $player)
                    <x-box-with-shadow shadow-color="bg-gray-600">
                        <div class="flex">
                            <!-- pic -->
                            <div class="p-4 bg-white flex flex-col">
                                <div class="flex items-center h-32 w-24 border-2 border-gray-700 bg-white">
                                    @if($player->user && $player->user->profile_photo_path)
                                        <img class="h-full w-full object-cover" src="{{ $player->user->profile_photo_url }}" alt="{{ $player->first_name }}" />
                                    @else
                                        <img src="{{ asset('img/swblogo.png') }}" class="w-16 h-auto m-auto opacity-75" />
                                    @endif
                                </div>
                                <div class="-mt-2 number text-6xl text-yellow-500 text-center">
                                    <span class="inline-flex p-1 rounded bg-white">
                                         {{ $player->clubs->find($club->id )->pivot->number }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-col w-full">
                                <div class="py-2 flex flex-col" style="
                                    background-color: #ffffff;
                                    opacity: 1;
                                    background-image: linear-gradient(to right, #202020, #202020 30px, #ffffff 30px, #ffffff );
                                    background-size: 60px 100%;
                                ">
                                    <div>
                                        <span class="p-1 inline-flex text-2xl text-black font-extrabold bg-white">{{ $player->name_short }}</span>
                                    </div>
                                    <div>
                                        @auth
                                            <span class="p-1 inline-flex text-sm text-black bg-white">{{ $player->full_name }}</span>
                                        @endauth
                                    </div>
                                    <div>
                                        @if ($player->public_note)
                                            <span class="p-1 inline-flex text-sm font-sans font-bold text-yellow-500 bg-white">{{ $player->public_note }}</span>
                                        @else
                                            &nbsp;
                                        @endif
                                    </div>
                                </div>
                                <div class="py-4 text-sm text-gray-900">
                                    @if ($player->joined)
                                        <i class="fas fa-pen-nib"></i> {{ $player->joined->isoFormat('MM.Y') }} ({{ $player->joined->diffInYears() > 0 ? $player->joined->diffInYears()." J." : $player->joined->diffInMonths()." M." }})
                                    @else
                                        &nbsp;
                                    @endif
                                </div>
                                <div class="p-1 font-sans font-extrabold text-sm uppercase bg-gray-100">
                                    {{ $club->name_code }} - Stats
                                </div>
                                <div class="py-2 flex">
                                    @if ($player->scorerTitles()->where('is_ah_season', $club->ah)->count() > 0)
                                        <div class="flex w-1/2 -space-x-1 overflow-hidden items-center">
                                            @foreach ($player->scorerTitles()->where('is_ah_season', $club->ah)->get() as $scorerTitle)
                                                <x-cannon class="inline-block w-6 h-auto rounded-full ring-2 ring-white fill-current text-yellow-500 "/>
                                            @endforeach
                                            <span class="inline-flex pl-2">x{{ $player->scorerTitles()->where('is_ah_season', $club->ah)->count() }}</span>
                                        </div>
                                    @endif
                                    @if ($player->ananasTitles()->where('is_ah_season', $club->ah)->count() > 0)
                                        <div class="flex w-1/2 -space-x-2 overflow-hidden items-center">
                                            @foreach ($player->ananasTitles()->where('is_ah_season', $club->ah)->get() as $ananasTitle)
                                                <span class="inline-block">
                                                    &#127821;
                                                </span>
                                            @endforeach
                                            <span class="inline-block pl-2">x{{ $player->ananasTitles()->where('is_ah_season', $club->ah)->count() }}</span>
                                        </div>
                                    @else
                                        &nbsp;
                                    @endif
                                </div>
                                <div class="pb-4 flex items-center space-x-4 text-gray-900">
                                    <div>
                                        <i class="far fa-futbol"></i> {{ $player->goals()
                                            ->whereHas('match', function($query) use ($club) { return $query->where('team_home', $club->id); })->count() +
                                            $player->goals()
                                            ->whereHas('match', function($query) use ($club) { return $query->where('team_away', $club->id); })->count() }}
                                    </div>
                                    <div>
                                        <i class="fas fa-hands-helping"></i> {{ $player->assists()
                                            ->whereHas('goal.match', function($query) use ($club) { return $query->where('team_home', $club->id); })->count() +
                                            $player->assists()
                                            ->whereHas('goal.match', function($query) use ($club) { return $query->where('team_away', $club->id); })->count() }}
                                    </div>
                                    <div>
                                        <i class="far fa-copy"></i> {{ $player->cards()
                                            ->whereHas('match', function($query) use ($club) { return $query->where('team_home', $club->id); })->count() +
                                            $player->goals()
                                            ->whereHas('match', function($query) use ($club) { return $query->where('team_away', $club->id); })->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-box-with-shadow>
                @endforeach
            </div>
        @endforeach
    @else
        Keine Spieler zugeordnet.
    @endif

</x-section>
