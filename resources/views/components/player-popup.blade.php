@props(
    ['player' => null]
)

@if ($player)
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
                <div class="pt-4 flex flex-col">
                    @foreach ($player->clubs as $club)
                        <div class="flex justify-between items-center space-x-2">
                            <span class="p-1 bg-gray-700 text-white font-extrabold">{{ $club->name_code }}</span>
                            @if ($club->pivot->number)
                                <span class="text-3xl number">{{ $club->pivot->number }}</span>
                            @endif
                        </div>
                    @endforeach
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
                <div class="pb-4 flex">
                    @if ($player->scorerTitles()->count() > 0)
                        <div class="flex w-1/2 -space-x-1 overflow-hidden items-center">
                            @foreach ($player->scorerTitles as $scorerTitle)
                                <x-cannon class="inline-block w-6 h-auto rounded-full ring-2 ring-white fill-current text-yellow-500 "/>
                            @endforeach
                            <span class="inline-flex pl-2">x{{ $player->scorerTitles()->count() }}</span>
                        </div>
                    @endif
                    @if ($player->ananasTitles()->count() > 0)
                        <div class="flex w-1/2 -space-x-2 overflow-hidden items-center">
                            @foreach ($player->ananasTitles as $ananasTitle)
                                <span class="inline-block">
                                                    &#127821;
                                                </span>
                            @endforeach
                            <span class="inline-block pl-2">x{{ $player->ananasTitles()->count() }}</span>
                        </div>
                    @else
                        &nbsp;
                    @endif
                </div>
                <div class="pb-4 flex items-center space-x-4 text-gray-900">
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
@endif
