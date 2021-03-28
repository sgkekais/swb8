<x-section class="pt-0">
    <x-box-with-shadow class="p-2">
        <x-slot name="header">
            {{ $date->dateType->description }}
        </x-slot>
        <div class="flex flex-col space-y-4">
            <div class="font-sans font-extrabold text-xl tracking-tighter ">
                @if ($date->dateType->id === 1 || $date->dateType->id === 4 )
                    {{ $date->title }}
                @elseif ($date->dateType->id === 2)
                    {{ $date->match->matchType->description }}
                    @if ($date->match->matchweek)
                        <span>
                            | {{ $date->match->matchweek ? ($date->match->matchType->id == 2 ? $date->match->matchweek.".ST" : $date->match->matchweek) : null }}
                        </span>
                    @endif
                @elseif ($date->dateType->id === 3)
                    {{ $date->tournament->title }}
                @endif
            </div>
            <!-- poll details -->
            <div class="text-gray-700">
                {{ $date->description }}
            </div>
            <div>
                Optionen ({{ $date->dateOptions->count() }}):
                <ul class="list-inside">
                    @foreach ($date->dateOptions as $dateOption)
                        <li><i class="far fa-question-circle text-yellow-500"></i> {{ $dateOption->description }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="">
                <i class="far fa-clock"></i> Umfrage geöffnet vom <span class="font-bold">{{ $date->poll_begins->isoFormat('dd D.M.YY') }}</span> bis <span class="font-bold">{{ $date->poll_ends->isoFormat('dd D.M.YY') }}</span>
            </div>
        </div>
    </x-box-with-shadow>

    <!-- poll participation -->
    <div class="max-w-screen overflow-x-scroll">
        <div class="table ">
            <div class="table-header-group">
                <div class="table-cell">
                    &nbsp;
                </div>
                @foreach ($date->dateOptions as $date_option)
                    <div class="table-cell p-4 text-center">
                        <div class="font-bold text-lg">
                            {{ $date_option->description }}
                        </div>
                        <div class="flex flex-col text-sm">
                            <div>{{ $date_option->users()->count() }} rückgemeldet</div>
                            <div>({{ $date_option->users()->wherePivot('attend', true)->count() }} zugesagt)</div>
                        </div>
                        <div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="table-row-group divide-x divide-gray-500">
                <div class="table-cell border-b border-gray-500 font-bold text-primary-600 text-center">
                    Du:
                </div>
                @foreach ($date->dateOptions as $date_option)
                    <div class="table-cell border-b border-gray-500 p-4 text-center">
                        <x-input-checkbox
                            wire:key="{{ $date_option->id }}"
                            wire:model.defer="checked_options"
                            name="date_option_{{ $date_option->id }}"
                            value="{{ $date_option->id }}" />
                    </div>
                @endforeach
                <div class="table-cell border-b border-gray-500">
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
            <!-- poll participants -->
            @foreach($date_players->sortBy('name_short') as $player)
                <div class="table-row-group divide-x divide-gray-500">
                    <div class="py-1 table-cell">
                        <div x-data="{ show:false }" class="relative flex items-center cursor-pointer">
                            <div x-show="show" class="absolute top-7 z-50 w-96 max-w-screen bg-white">
                                <x-box-with-shadow class="p-4">
                                    <div class="flex flex-col space-y-1">
                                        <div class="flex items-center space-x-2">
                                            @isset($player->user)
                                                <img class="h-12 w-12 rounded-full object-cover" src="{{ $player->user->profile_photo_url }}" alt="{{ $player->first_name }}" />
                                            @endisset
                                            <div class="flex flex-col">
                                                <span>{{ $player->full_name }}</span>
                                                <span class="text-green-700 italic">{{ $player->public_note }}</span>
                                            </div>
                                        </div>
                                        @if ($player->joined)
                                            <div class="text-gray-700">
                                                <i class="fas fa-birthday-cake"></i> Dabei seit {{ $player->joined->isoFormat('MM.Y') }} ({{ $player->joined->diffInYears() }})
                                            </div>
                                        @endif
                                        <div class="flex items-center space-x-4 text-gray-700">
                                            <div>
                                                <i class="far fa-futbol"></i> {{ $player->goals->count() }}
                                            </div>
                                            <div>
                                                <i class="fas fa-hands-helping"></i> {{ $player->assists->count() }}
                                            </div>
                                            <div>
                                                <i class="far fa-copy"></i> {{ $player->cards->count() }}
                                            </div>
                                        </div>
                                    </div>

                                </x-box-with-shadow>
                            </div>
                            <div @click="show = !show" class="relative">
                                @isset($player->user)
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $player->user->profile_photo_url }}" alt="{{ $player->first_name }}" />
                                @endisset
                                <div class="pl-2">
                                    {{ $player->name_short }}
                                </div>
                            </div>
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
                                        <div class="w-full bg-primary-100">
                                            <i class="far fa-thumbs-up text-primary-500"></i>
                                        </div>
                                    @else
                                        <div class="w-full bg-red-100">
                                            <i class="far fa-thumbs-down text-red-500"></i>
                                        </div>
                                    @endif
                                    @php
                                        $player->last_poll_update = $player->user->dateOptions->find($date_option->id)->pivot->updated_at->diffForHumans();
                                    @endphp
                                @else
                                    <div class="w-full bg-yellow-100">
                                        <i class="fas fa-question-circle text-yellow-500"></i>
                                    </div>
                                @endif
                            @else
                                <div class="w-full bg-gray-100 text-sm">
                                    kein User
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div class="table-cell pl-2 text-xs text-gray-700">
                        {{ $player->last_poll_update }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-section>

