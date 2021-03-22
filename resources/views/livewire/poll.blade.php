<x-section class="pt-0">
    <x-box-with-shadow>
        <x-slot name="header">
            {{ $date->dateType->description }}
        </x-slot>
        <div class="">
            <div class="font-sans font-extrabold text-xl tracking-tighter ">
                {{ $date->title }}
            </div>
            <!-- poll details -->
            <div class="">
                {{ $date->description }}
                <br>
                Anzahl Optionen: {{ $date->dateOptions->count() }}
                (
                @foreach ($date->dateOptions as $dateOption)
                    {{ $dateOption->description }}
                    @unless ($loop->last)
                        ,
                    @endunless
                @endforeach
                )
            </div>
            <div>
                Umfrage geöffnet bis {{ $date->poll_ends->isoFormat('dd D.M.YY') }}
            </div>
        </div>
    </x-box-with-shadow>

    <!-- poll participation -->
    <div class="table overflow-x-scroll">
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
        @foreach($date_players->sortBy('nickname') as $player)
            <div class="table-row-group divide-x divide-gray-500">
                <div class="py-1 table-cell">
                    <div class="flex items-center">
                        &nbsp;
                        @isset($player->user)
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ $player->user->profile_photo_url }}" alt="{{ $player->first_name }}" />
                        @endisset
                        <div class="pl-2">
                            {{ $player->nickname ?: $player->full_name_short }}
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
</x-section>

