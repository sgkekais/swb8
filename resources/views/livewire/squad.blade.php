<x-section class="py-0">

    @if ($club->players()->count() > 0)

        <div class="pb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 ">
            @foreach($club->players->sortBy('name_short') as $player)
                <div class="relative border border-gray-500 overflow-hidden">
                    <!-- number -->
                    <div class="absolute inset-0 text-5xl text-primary-700 font-extrabold flex items-center">
                        <img src="/img/swblogo.png" class="w-40 h-auto m-auto opacity-5" />
                    </div>
                    <div class="absolute top-0 right-0 text-7xl text-black font-extrabold opacity-50">
                        {{ $player->clubs->find($club->id )->pivot->number }}
                    </div>
                    <div class="relative flex flex-col space-y-2">
                        <!-- pic, name, title -->
                        <div class="p-4 flex items-center space-x-4 bg-gray-200 bg-opacity-25">
                            @isset($player->user)
                                <img class="h-16 w-16 rounded-full object-cover" src="{{ $player->user->profile_photo_url }}" alt="{{ $player->first_name }}" />
                            @else
                                <img class="inline-flex h-16 w-16 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ $player->name }}&color=FFFFFF&background=505050" />
                            @endisset
                            <div class="flex flex-col">
                                <div>{{ $player->name_short }}</div>
                                <div class="text-sm text-gray-700">{{ $player->full_name }}</div>
                                <div class="text-sm font-bold text-yellow-500">
                                    {{ $player->public_note }}
{{--                                    @if ($player->public_note)--}}
{{--                                        {{ $player->public_note }}--}}
{{--                                    @else--}}
{{--                                        &nbsp;--}}
{{--                                    @endif--}}
                                </div>
                            </div>
                        </div>
                        <!-- player status -->
                        <div class="px-4 text-sm text-gray-700">
                            {{ $player->playerStatus->description }}
                        </div>
                        <!-- joined -->
                        <div class="px-4 text-sm text-gray-700">
                            @if ($player->joined)
                                <i class="fas fa-birthday-cake"></i> Dabei seit {{ $player->joined->isoFormat('MM.Y') }} ({{ $player->joined->diffInYears() > 0 ? $player->joined->diffInYears()." J." : $player->joined->diffInMonths()." M." }})
                            @else
                                &nbsp;
                            @endif
                        </div>
                        <!-- stats -->
                        <div class="px-4 flex items-center space-x-4 text-gray-700 justify-around">
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
            @endforeach
        </div>

    @else
        Keine Spieler zugeordnet.
    @endif

</x-section>
