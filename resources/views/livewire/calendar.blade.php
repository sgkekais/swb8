<div>
    <div class="mb-6">
        <label for="selected_year" class="font-bold text-primary-600">
            Jahr auswählen
        </label>
        <select name="selected_year" wire:model="selected_year">
            @foreach ($selectable_years->sortByDesc('date') as $selectable_year)
                <option value="{{ $selectable_year->date }}">{{ $selectable_year->date }}</option>
            @endforeach
        </select>
    </div>
    <div wire:loading>
        <i class="far fa-futbol fa-spin" ></i>
    </div>
    <div wire:loading.remove>
        <div>
            Springe zu:
        </div>
        <div class="flex flex-wrap items-center space-x-2 mb-6 ">
            @foreach ($dates->groupBy(function ($d) {return \Carbon\Carbon::parse($d->datetime)->translatedFormat('F');} ) as $key => $date_group)
                <div>
                    <a href="#{{ $key }}" class="text-primary-600 underline">{{ $key }}</a> ({{ $date_group->count() }})
                </div>
            @endforeach
        </div>
        <div>
            @foreach ($dates->groupBy(function ($d) {return \Carbon\Carbon::parse($d->datetime)->translatedFormat('F');} ) as $key => $date_group)
                <div class="flex flex-col">
                    <h2 class="font-sans font-black text-2xl" id="{{ $key }}">{{ $key }}</h2>
                    <div class="">
                        @foreach ($date_group as $date)
                            <div class="flex items-center py-1 divide-x divide-gray-300 {{ $date->cancelled ? "text-gray-500 line-through" : null }}">
                                {{-- date and time --}}
                                <div class="p-4 text-2xl">
                                    {{ $date->datetime->format('d') }}.
                                </div>
                                <div class="p-4 text-xl">
                                    {{ $date->datetime->format('H:i') }}
                                </div>
                                {{-- date icons --}}
                                <div class="p-4 flex-col items-center justify-center text-center text-lg space-y-1">
                                    @switch ($date->dateType->id)
                                        @case (1)
                                        <i class="fas fa-calendar-day fa-fw text-indigo-600" title="{{ $date->dateType->description }}"></i>
                                        @break
                                        @case (2)
                                        @switch ($date->match->matchType->id)
                                            @case (1)
                                            <i class="far fa-handshake text-blue-600" title="{{ $date->dateType->description }}"></i>
                                            @break
                                            @case (2)
                                            <x-hlw-logo class="fill-current text-primary-600 h-4"/>
                                            @break
                                            @case (3)
                                            <i class="fas fa-trophy text-yellow-600" title="{{ $date->dateType->description }}"></i>
                                            @break
                                            @case (4)
                                            <x-hlw-logo class="fill-current text-primary-600 h-4"/>
                                            @break
                                        @endswitch
                                        @break
                                        @case (3)
                                        <i class="fas fa-list-ol fa-fw text-purple-600" title="{{ $date->dateType->description }}"></i>
                                        @break
                                        @case (4)
                                        <i class="fas fa-glass-cheers fa-fw text-pink-600" title="{{ $date->dateType->description }}"></i>
                                        @break
                                    @endswitch
                                    <div class="text-xs">
                                        {{ $date->dateType->description }}
                                    </div>
                                </div>
                                {{-- match and tournament --}}
                                @switch ($date->dateType->id)
                                    @case (2)
                                    <div class="p-4 flex flex-col">
                                        <div class="text-sm text-gray-700">
                                            @if (($date->match->teamHome->owner == 1 && $date->match->teamHome->ah == 1) || ($date->match->teamAway->owner == 1 && $date->match->teamAway->ah == 1))
                                                <span class="bg-gray-300 font-bold">AH</span>
                                            @endif
                                            {{ $date->match->matchType->description }} {{ $date->match->matchweek ? "| ".$date->match->matchweek.".ST" : null }}
                                        </div>
                                        <div class="">
                                            {{ $date->match->teamHome->name  }} : {{ $date->match->teamAway->name }}
                                        </div>
                                    </div>
                                    @break
                                    @case (3)
                                    <div class="p-4 flex flex-col">
                                        <div class="text-sm text-gray-700">
                                            {{ $date->tournament->title }}
                                        </div>
                                        <div class="text-xs">
                                            {{ $date->tournament->description }}
                                        </div>
                                    </div>
                                    @break
                                @endswitch
                                {{-- date title and description --}}
                                @if ($date->title || $date->description)
                                    <div class="p-4 flex flex-col">
                                        <div class="font-bold">
                                            {{ $date->title }}
                                        </div>
                                        <div class="text-xs">
                                            {{ $date->description }}
                                        </div>
                                    </div>
                                @endif
                                {{-- poll --}}
                                {{-- is date valid for me, i.e. date->clubs contains at least one of player->clubs --}}
                                @if ($date->clubs->intersect(auth()->user()->player->clubs) && $date->poll_begins && $date->poll_ends)
                                    <div class="p-4 flex flex-grow justify-end items-center space-x-2">
                                        <div class="flex flex-col text-center">
                                            <div>
                                                <div class="text-xs">Umfragebeginn</div>
                                                <div class="text-sm">{{ $date->poll_begins ? $date->poll_begins->format('d.m.y') : null }}</div>
                                            </div>
                                            <div>
                                                <div class="text-xs">Umfrageende</div>
                                                <div class="text-sm">{{ $date->poll_ends ? $date->poll_ends->format('d.m.y') : null }}</div>
                                            </div>
                                        </div>
                                        {{-- if open -> participate in poll --}}
                                        <div class="">
                                            @if ($date->poll_is_open && $today >= $date->poll_begins && $today <= $date->poll_ends)
                                                <a href="{{ route('poll', $date) }}" class="block">
                                                    <x-button>
                                                        <i class="far fa-calendar-plus fa-lg " title="Rückmelden"></i>
                                                    </x-button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    {{----}}
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
