<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    Terminart
    <br>
    Titel
    <br>
    Beschreibung
    <br>
    Spiel
    <br>
    Turnier
    <br>
    etc.
    <h2 class="text-primary-500 font-bold">
        {{ $date->title }}
    </h2>
    <!-- poll details -->
    <div class="bg-gray-200 p-4">
        {{ $date->description }}
        <br>
        Anzahl Optionen: {{ $date->dateOptions->count() }}
        <br>
    </div>
    <!-- poll participation -->
    <div class="table">
        <div class="table-header-group divide-x divide-black">
            <div class="table-cell">
                &nbsp;
            </div>
            @foreach ($date->dateOptions as $date_option)
                <div class="table-cell p-4">
                    <div class="font-bold">
                        {{ $date_option->description }}
                    </div>
                    <div>
                        {{ $date_option->users()->count() }} rückgemeldet
                    </div>
                    <div>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="table-row-group divide-x divide-black">
            <div class="table-cell">
                {{ auth()->user()->name }}
            </div>
            @foreach ($date->dateOptions as $date_option)
                <div class="table-cell p-4 text-center">
                    <x-input-checkbox
                        wire:key="{{ $date_option->id }}"
                        wire:model.defer="checked_options"
                        name="date_option_{{ $date_option->id }}"
                        value="{{ $date_option->id }}" />
                </div>
            @endforeach
            <div class="table-cell">
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
        <!-- assign club to date as 'valid for this club or multiple clubs' -->
        <!-- teilgenommen / nicht teilgenommen, status can play -->
        <!-- TODO: date clubs -> wie nicht doppelt? intersect? -->
        @foreach(\App\Models\Club::find(33)->players()->orderBy('first_name')->get() as $player)
            <div class="table-row-group divide-x divide-black">
                <div class="table-cell">
                    <div class="flex items-center space-x-2">
                        <div class="h-8 w-8">
                            @isset($player->user)
                                <img class="h-8 w-8 ring-1 ring-white rounded-full object-cover" src="{{ $player->user->profile_photo_url }}" alt="{{ $player->first_name }}" />
                            @endisset
                        </div>
                        <div class="pl-2">
                            {{ $player->first_name }},{{ \Illuminate\Support\Str::substr($player->last_name,0,1) }}.
                        </div>
                    </div>
                </div>
                @php
                    $user_participated = false;
                @endphp
                @foreach($date->dateOptions()->with('users')->get() as $date_option)
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
                                    <i class="far fa-thumbs-up text-primary-500"></i>
                                @else
                                    <i class="far fa-thumbs-down text-red-500"></i>
                                @endif
                                @php
                                    $player->last_poll_update = $player->user->dateOptions->find($date_option->id)->pivot->updated_at->diffForHumans();
                                @endphp
                            @else
                                <i class="far fa-thumbs-down text-red-500"></i>
                            @endif
                        @else
                            <i class="far fa-thumbs-down text-red-500"></i>
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
