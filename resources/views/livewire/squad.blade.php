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

    @if ($club->players()->count() > 0)
        @foreach($club->players->where('playerStatus.display_in_squad')->sortByDesc('playerStatus.can_play')->groupBy('playerStatus.description') as $key => $player_status_group)
            <x-headline class="text-2xl" id="{{ $key }}">
                {{ $key }}
            </x-headline>
            <div class="pb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 ">
                @foreach($player_status_group->sortBy('name_short') as $player)
                    <x-box-with-shadow shadow-color="bg-gray-600">
                        <div class="relative overflow-hidden">
                            <!-- number -->
                            <div class="absolute inset-0 text-5xl text-primary-700 font-extrabold flex items-center">
                                <img src="/img/swblogo.png" class="w-40 h-auto m-auto opacity-5" />
                            </div>
                            <div class="relative flex flex-col space-y-2">
                                <!-- pic, name, title -->
                                <div class="p-4 h-24 flex items-center relative" style="
                                background-color: #ffffff;
                                opacity: 1;
                                background-image: linear-gradient(to right, #202020, #202020 30px, #ffffff 30px, #ffffff );
                                background-size: 60px 100%;">
                                    @isset($player->user)
                                        <img class="absolute <!--top-6 h-24 w-24--> top-2 h-32 w-24 rounded object-cover border-2 border-black" src="{{ $player->user->profile_photo_url }}" alt="{{ $player->first_name }}" />
                                    @else
                                        <img class="absolute top-2 h-32 w-24 rounded object-cover border-2 border-black" src="https://eu.ui-avatars.com/api/?name={{ $player->first_name }}+{{ $player->last_name }}&color=000&background=fff" />
                                    @endisset
                                    <div class="pl-28 flex flex-col relative">
                                        <div class="text-lg text-black font-extrabold">
                                            <span class="inline-flex p-1 bg-white">{{ $player->name_short }}</span>
                                        </div>
                                        @auth
                                            <div class="text-sm text-black">
                                                <span class="inline-flex px-1 bg-white">{{ $player->full_name }}</span>
                                            </div>
                                        @endauth
                                        <div class="text-sm font-bold text-yellow-500">
                                            <span class="inline-flex p-1 bg-white">{{ $player->public_note }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute w-24 top-28 left-4 number text-6xl text-black text-center">
                                    {{ $player->clubs->find($club->id )->pivot->number }}
                                </div>
                                <div class="pl-32 text-sm text-gray-900">
                                    @if ($player->joined)
                                        <i class="fas fa-pen-nib"></i> Dabei seit {{ $player->joined->isoFormat('MM.Y') }} ({{ $player->joined->diffInYears() > 0 ? $player->joined->diffInYears()." J." : $player->joined->diffInMonths()." M." }})
                                    @else
                                        &nbsp;
                                    @endif
                                </div>
                                <div class="pl-32 py-4 flex items-center space-x-4 text-gray-900">
                                    <div>
                                        <i class="far fa-futbol"></i> {{ $player->goals()->count() }}
                                    </div>
                                    <div>
                                        <i class="fas fa-hands-helping"></i> {{ $player->assists()->count() }}
                                    </div>
                                    <div>
                                        <i class="far fa-copy"></i> {{ $player->cards()->count() }}
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
