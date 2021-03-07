<div>
    <div class="mb-6 flex items-center space-x-2">
        <x-select-label for="selected_year" class="text-primary-600">
            Jahr auswählen:
        </x-select-label>
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
        <div class="flex flex-wrap items-center space-x-2 ">
            <div class="">
                Springe zu:
            </div>
            @foreach ($dates->groupBy(function ($d) {return \Carbon\Carbon::parse($d->datetime)->isoFormat('MMM');} ) as $key => $date_group)
                <div>
                    <a href="#{{ $key }}" class="text-primary-600 underline">{{ $key }}</a> ({{ $date_group->count() }})
                </div>
            @endforeach
        </div>
        <div>
            @foreach ($dates->groupBy(function ($d) {return \Carbon\Carbon::parse($d->datetime)->translatedFormat('F');} ) as $key => $date_group)
                <div class="flex flex-col">
                    <h2 class="my-3 font-sans font-black text-2xl" id="{{ $key }}">{{ $key }}</h2>
                    <div class="border-l-2 border-primary-600">
                        @foreach ($date_group as $date)
                            <div class="pl-4 pt-2 flex items-center space-x-2 text-sm ">
                                <div>Für</div>
                                @foreach ($date->clubs as $club)
                                    <div class="font-bold tracking-tighter {{ $club->ah ? "text-gray-700" : "text-primary-600" }}">{{ $club->name_code }}</div>
                                @endforeach
                            </div>
                            <div class="flex items-center space-x-3 border-b border-gray-300 {{ $date->cancelled ? "text-gray-500 line-through" : null }}">
                                {{-- date and time --}}
                                <div class="p-4 flex flex-col text-center">
                                    <div>
                                        {{ $date->datetime->isoFormat('dd') }}
                                    </div>
                                    <div class="text-2xl font-extrabold">
                                        {{ $date->datetime->format('d') }}
                                    </div>
                                </div>
                                {{-- date icons --}}
                                <div class="flex flex-col space-y-1">
                                    <div class="flex flex-row space-x-1 items-center">
                                        @switch ($date->dateType->id)
                                            @case (1)
                                                <i class="fas fa-calendar-day text-indigo-600" title="{{ $date->dateType->description }}"></i>
                                                @break
                                            @case (2)
                                                @switch ($date->match->matchType->id)
                                                    @case (1)
                                                        <i class="far fa-handshake text-blue-600" title="{{ $date->dateType->description }}"></i>
                                                        @break
                                                    @case (2)
                                                        <x-hlw-logo class="fill-current text-primary-600 h-3"/>
                                                        @break
                                                    @case (3)
                                                        <i class="fas fa-trophy text-yellow-600" title="{{ $date->dateType->description }}"></i>
                                                        @break
                                                    @case (4)
                                                        <x-hlw-logo class="fill-current text-primary-600 h-4"/>
                                                        @break
                                                @endswitch
                                                <div class="text-xs">
                                                    {{ $date->match->matchType->description }} {{ $date->match->matchweek ? "| ".$date->match->matchweek.".ST" : null }}
                                                </div>
                                                @break
                                            @case (3)
                                                <i class="fas fa-list-ol text-purple-600" title="{{ $date->dateType->description }}"></i>
                                                @break
                                            @case (4)
                                                <i class="fas fa-glass-cheers text-pink-600" title="{{ $date->dateType->description }}"></i>
                                                @break
                                        @endswitch
                                        @unless ($date->dateType->id == 2)
                                            <span class="text-xs">{{ $date->dateType->description }}</span>
                                        @endunless
                                        <div class="text-xs">
                                            @if ($date->poll_begins && $today < $date->poll_begins)
                                                (<i class="far fa-calendar-check text-gray-600" title="Rückmelden"></i> Umfrage öffnet am {{ $date->poll_begins->isoFormat('Do MMM') }})
                                            @elseif ($date->poll_begins && $date->poll_ends && $today >= $date->poll_begins && $today <= $date->poll_ends)
                                                (<i class="far fa-calendar-check text-gray-600" title="Rückmelden"></i> Umfrage endet {{ $date->poll_ends->diffForHumans() }})
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-row items-center space-x-2">
                                        @unless ($date->dateType->id == 1)
                                            <div class="font-bold">
                                                {{ $date->datetime->format('H:i') }}
                                            </div>
                                        @endunless
                                        <div>
                                            @switch ($date->dateType->id)
                                                @case (1)
                                                    <div class="flex flex-col space-y-1">
                                                        <div class="font-bold">
                                                            {{ $date->title }}
                                                        </div>
                                                        <div class="text-sm">
                                                            {{ \Illuminate\Support\Str::of($date->description)->limit(50) }}
                                                        </div>
                                                    </div>
                                                @break
                                                @case (2)
                                                    <div class="flex items-center space-x-1">
                                                        <div class="tracking-tighter">
                                                            {{ $date->match->teamHome->name  }}
                                                        </div>
                                                        <div class="rounded bg-gray-300 p-1 text-sm tracking-tighter">
                                                            @if ($date->match->isRated())
                                                                {{ $date->match->goals_home_rated }}:{{ $date->match->goals_away_rated }}
                                                            @elseif ($date->match->isPlayed())
                                                                {{ $date->match->goals_home }}:{{ $date->match->goals_away }}
                                                            @else
                                                                -:-
                                                            @endif
                                                        </div>
                                                        <div class="tracking-tighter">
                                                            {{ $date->match->teamAway->name }}
                                                        </div>
                                                    </div>
                                                    @break
                                                @case (3)
                                                    <div class="flex flex-col">
                                                        <div class="text-sm text-gray-700">
                                                            {{ $date->tournament->title }}
                                                        </div>
                                                        <div class="text-xs">
                                                            {{ $date->tournament->description }}
                                                        </div>
                                                        <div class="">
                                                            {{ $date->tournament->place }}
                                                        </div>
                                                    </div>
                                                    @break
                                                @case (4)
                                                    <div class="flex flex-col space-y-1">
                                                        <div class="font-bold">
                                                            {{ $date->title }}
                                                        </div>
                                                        <div class="text-sm">
                                                        </div>
                                                    </div>
                                                    @break
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                                {{-- poll --}}
                                {{-- is date valid for me, i.e. date->clubs contains at least one of player->clubs --}}
                                @auth
                                    @if ($date->clubs->intersect(auth()->user()->player->clubs)->isNotEmpty() && $date->poll_begins && $date->poll_ends)
                                        <div class="flex flex-grow justify-end items-center space-x-2">
                                            {{-- if open -> participate in poll --}}
                                            <div class="flex flex-col space-y-1 text-right">
                                                @if ($date->poll_is_open && $today >= $date->poll_begins && $today <= $date->poll_ends)
                                                    <a href="{{ route('poll', $date) }}" class="flex justify-end">
                                                        <x-button>
                                                            <i class="far fa-calendar-plus pr-1" title="Rückmelden" ></i>Rückmelden
                                                        </x-button>
                                                    </a>
                                                    <div class="text-xs">
                                                        @if (auth()->user()->dateOptions()->where('date_id', $date->id)->count() > 0)
                                                            <span class="text-primary-600">Du hast teilgenommen</span>
                                                        @else
                                                            <span class="text-red-600">Du hast noch nicht teilgenommen</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
