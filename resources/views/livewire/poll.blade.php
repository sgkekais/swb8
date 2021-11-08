<x-section class="pt-0">
    <x-box-with-shadow class="" shadow-color="bg-gray-600">
        <x-slot name="header">
            {{ $date->dateType->description }}
        </x-slot>
        <div class="p-2 flex items-center space-x-2 font-sans font-extrabold text-xl tracking-tighter bg-gray-100">
            @switch ($date->dateType->id)
                @case (1)
                    <i class="fas fa-calendar-day text-indigo-600" title="{{ $date->dateType->description }}"></i>
                    <span>{{ $date->title }}</span>
                    @break
                @case (2)
                    @switch ($date->match->matchType->id)
                        @case (1)
                            <i class="far fa-handshake text-blue-600" title=""></i>
                            @break
                        @case (2)
                            <x-hlw-logo class="fill-current text-primary-600 h-3"/>
                            @break
                        @case (3)
                            <i class="fas fa-trophy text-yellow-600" title=""></i>
                            @break
                        @case (4)
                            <x-hlw-logo class="fill-current text-primary-600 h-3"/>
                            @break
                    @endswitch
                    <span>{{ $date->match->matchType->description }}</span>
                    @if ($date->match->matchweek)
                        <span>
                            | {{ $date->match->matchweek ? ($date->match->matchType->id == 2 ? $date->match->matchweek.".ST" : $date->match->matchweek) : null }}
                        </span>
                    @endif
                    @break
                @case (3)
                    <i class="fas fa-medal text-yellow-600" title="{{ $date->dateType->description }}"></i>
                    <span>{{ $date->tournament->title }}</span>
                    @break
                @case (4)
                    <i class="fas fa-glass-cheers text-pink-600" title="{{ $date->dateType->description }}"></i>
                    <span>{{ $date->title }}</span>
                    @break
            @endswitch
        </div>
        <div class="p-2 flex flex-col space-y-2">

            <!-- poll details -->
            <div class="flex items-center space-x-2">
                <i class="fas fa-bullhorn fa-fw text-blue-500"></i>
                @switch ($date->dateType->id)
                    @case (1)
                        <div class="trix-content text-gray-700">
                            {!! $date->description !!}
                        </div>
                        @break
                    @case (2)
                        @if ($date->match->teamHome)
                            <span class="text-right">{{ $date->match->teamHome->name }}</span>
                            <img src="{{ $date->match->teamHome->logo() }}" class="w-8 h-auto" alt="{{ $date->match->teamHome->name_short." Logo" }}"/>
                        @else
                            <span class="italic">noch unbekannt</span>
                        @endif
                        <span class="font-bold text-sm">VS</span>
                        @if ($date->match->teamAway)
                            <img src="{{ $date->match->teamAway->logo() }}" class="w-8 h-auto" alt="{{ $date->match->teamAway->name_short." Logo" }}"/>
                            <span class="">{{ $date->match->teamAway->name }}</span>
                        @else
                            <span class="italic">noch unbekannt</span>
                        @endif
                        @break
                    @case (3)
                        <div class="trix-content text-gray-700">
                            {!! $date->tournament->description !!}
                        </div>
                        @break
                    @case (4)
                        <div class="trix-content text-gray-700">
                            {!! $date->description !!}
                        </div>
                        @break
                @endswitch
            </div>
            @if ($date->datetime && $date->dateType->id != 1)
                <div>
                    <i class="far fa-clock fa-fw text-gray-700"></i>
                    <span class="font-bold">{{ $date->datetime->isoFormat('DD.MM.YY HH:mm') }}</span>
                </div>
            @endif
            @if ($date->location)
                <div class="">
                    <i class="fas fa-map-marker-alt fa-fw text-red-500"></i>
                    {{ $date->location->name }}
                </div>
            @endif
            <div class="flex flex-wrap space-x-2 ">
                <div class=""><i class="fas fa-users fa-fw text-primary-700"></i> Anzahl Spieler: </div>
                @foreach ($date_players->sortByDesc('pivot.playerStatus.can_play')->groupBy('pivot.playerStatus.description') as $key => $player_status_group)
                    <div>
                        <a href="#{{ $key }}" class="inline-link"><span class="font-bold">{{ $key }}</span></a> {{ $player_status_group->count() }}
                    </div>
                @endforeach
            </div>
{{--            <div>--}}
{{--                <i class="fas fa-wheelchair fa-fw text-blue-700"></i> -> <span class="text-primary-700 font-bold">{{ $date_players->where('pivot.playerStatus.can_play', 1)->count() }}</span> können spielen--}}
{{--            </div>--}}
        </div>
        <div class="p-2 flex items-center space-x-2 bg-gray-100">
            <i class="fas fa-hourglass-half fa-fw text-yellow-500"></i>
            <div>
                Umfrage geöffnet vom <span class="font-bold">{{ $date->poll_begins->isoFormat('dd D.M.YY') }}</span> bis <span class="font-bold">{{ $date->poll_ends->isoFormat('dd D.M.YY') }}</span>
            </div>
        </div>
    </x-box-with-shadow>

    <!-- poll participation -->
    <div class="max-w-screen overflow-x-scroll bg-scroll-gradient <!--sm:shadow-none-->">
        <div class="table">
            <div class="table-header-group sticky top-0">
                <div class="table-row">
                    <div class="table-cell">
                        &nbsp;&nbsp;
                    </div>
                    @foreach ($date->dateOptions as $date_option)
                        <div class="table-cell p-4 text-center whitespace-nowrap">
                            <div class="font-bold text-lg">
                                {{ $date_option->description }}
                            </div>
                            <div class="flex flex-col text-sm">
                                <div><span class="font-bold">{{ $date_option->users()->count() }}</span>/{{ $date_players->count() }} rückgemeldet</div>
                                <div><span class="font-bold text-primary-800">{{ $date_option->users()->wherePivot('attend', true)->count() }}</span>/{{ $date_players->count() }} <span class="text-primary-700">zugesagt</span></div>
                            </div>
                            <div>
                                <i class="fas fa-vote-yea text-gray-700"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="table-row-group">
                <div class="table-row">
                    <div class="table-cell font-bold text-xl text-primary-700 text-center">
{{--                        <img class="inline-flex h-10 w-10 rounded-full object-cover" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" />--}}
                        <span>Du:</span>
                    </div>
                    @foreach ($date->dateOptions as $date_option)
                        <div class="table-cell pb-4 text-center">
                            <x-input-checkbox
                                wire:key="{{ $date_option->id }}"
                                wire:model.defer="checked_options"
                                name="date_option_{{ $date_option->id }}"
                                value="{{ $date_option->id }}" />
                        </div>
                    @endforeach
                    <div class="table-cell whitespace-nowrap">
                        <div class="flex items-center space-x-2 ml-2">
                            <x-confirmation-button wire:click="attend">
                                <div wire:loading wire:target="attend">
                                    <i class="fas fa-circle-notch fa-spin" ></i>
                                </div>
                                <div wire:loading.remove >
                                    <i class="fas fa-fw fa-save" ></i>
                                </div>
                            </x-confirmation-button>
                            @if($saved)
                                <div class="text-xs text-primary-600">
                                    Gespeichert.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- poll participants -->
            <div class="table-row-group">
                @foreach ($date_players->sortByDesc('pivot.playerStatus.can_play')->groupBy('pivot.playerStatus.description') as $key => $player_status_group)
                    <div class="table-row">
                        <div class="table-cell">
                            <x-headline class="text-xl" id="{{ $key }}">
                                {{ $key }}
                            </x-headline>
                        </div>
                    </div>
                    @foreach($player_status_group->sortBy('name_short') as $player)
                        <div class="table-row hover:bg-gray-100">
                            <!-- name -->
                            <div x-data="{ show:false }" class="p-2 table-cell relative cursor-pointer whitespace-nowrap">
                                <!-- player info popup -->
                                <div x-show="show" @click.away="show = false" class="absolute top-7 z-50 w-96 max-w-screen bg-white">
                                    <x-player-popup :player="$player" />
                                </div>
                                <div @click="show = !show" class="relative ">
                                    @if ($player->user)
                                        <img class="inline-flex h-10 w-10 rounded-full object-cover" src="{{ $player->user->profile_photo_url }}" alt="{{ $player->first_name }}" />
                                    @else
                                        <img class="inline-flex h-10 w-10 rounded-full object-cover" src="https://eu.ui-avatars.com/api/?name={{ $player->first_name }}+{{ $player->last_name }}&color=333333&background=dddddd" />
                                    @endif
                                    {{ $player->name_short }}
                                </div>
                            </div>
                            @php
                                $user_participated = false;
                            @endphp
                            @foreach($date->dateOptions as $date_option)
                                <div class="table-cell text-center">
                                    {{-- player has user? --}}
                                    @if ($player->user)
                                        {{-- player has this poll option? --}}
                                        @if($player->user->dateOptions->find($date_option->id))
                                            @php
                                                $user_participated = true;
                                            @endphp
                                            {{-- player has attended=1 for this poll option? --}}
                                            @if($player->user->dateOptions->find($date_option->id)->pivot->attend == 1)
                                                <i class="far fa-thumbs-up text-primary-700"></i>
                                            @else
                                                <i class="far fa-thumbs-down text-red-500"></i>
                                            @endif
                                            @php
                                                $player->last_poll_update = $player->user->dateOptions->find($date_option->id)->pivot->updated_at->diffForHumans(['short' => true]);
                                            @endphp
                                        @else
                                            <i class="fas fa-question-circle text-yellow-500"></i>
                                        @endif
                                    @else
                                        <div class="w-full text-sm text-gray-500">
                                            kein User
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            <div class="table-cell pl-2 text-xs text-gray-700 whitespace-nowrap">
                                {{ $player->last_poll_update }}
                            </div>
                        </div>
                    @endforeach
                @endforeach


            </div>
        </div>
    </div>

</x-section>

