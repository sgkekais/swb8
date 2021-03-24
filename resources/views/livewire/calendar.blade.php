<x-section class="pb-6">
    <div class="mb-6 ">
        <x-select-label for="selected_year" class="text-primary-700">
            Jahr auswählen:
        </x-select-label>
        <select name="selected_year" wire:model="selected_year" >
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
                <span class="font-bold">Springe zu:</span>
            </div>
            @foreach ($dates->groupBy(function ($d) {return \Carbon\Carbon::parse($d->datetime)->isoFormat('MMMM');} ) as $month => $date_group)
                <div>
                    <a href="#{{ $month }}" class="inline-link">{{ $month }}</a> ({{ $date_group->count() }})
                </div>
            @endforeach
        </div>
        @foreach ($dates->groupBy(function ($d) {return \Carbon\Carbon::parse($d->datetime)->isoFormat('MMMM');} ) as $month => $date_group)
            <div class="flex flex-col max-w-full">
                <h2 class="my-3 font-sans font-black text-2xl" id="{{ $month }}">{{ $month }}</h2>
                <div class="border-l-2 border-gray-300">
                    @foreach ($date_group as $date)
                        <div class="p-1 flex items-center space-x-2 border-b border-gray-300 {{ $date->cancelled ? "text-gray-500 line-through" : null }}">
                            {{-- day --}}
                            <div class="p-3 pr-0 flex flex-col text-center">
                                <div>
                                    {{ $date->datetime->isoFormat('dd') }}
                                </div>
                                <div class="text-2xl font-extrabold">
                                    {{ $date->datetime->format('d') }}
                                </div>
                            </div>
                            {{-- dateType / matchType icon --}}
                            <div class="w-10 flex justify-center">
                                @switch ($date->dateType->id)
                                    @case (1)
                                        <i class="fas fa-calendar-day text-indigo-600" title="{{ $date->dateType->description }}"></i>
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
                                        @break
                                    @case (3)
                                        <i class="fas fa-medal text-yellow-600" title="{{ $date->dateType->description }}"></i>
                                        @break
                                    @case (4)
                                        <i class="fas fa-glass-cheers text-pink-600" title="{{ $date->dateType->description }}"></i>
                                        @break
                                @endswitch
                            </div>
                            {{-- date / match / tournament description --}}
                            <div class="flex flex-1 flex-col space-y-1">
                                @switch ($date->dateType->id)
                                    {{-- general poll --}}
                                    @case (1)
                                        <div class="text-xs">
                                            {{ $date->dateType->description }}{{ $date->poll_ends ? ', endet am '.$date->poll_ends->isoFormat('D.M.') : null }}
                                        </div>
                                        <div class="">
                                            {{ $date->title }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ \Illuminate\Support\Str::of($date->description)->limit(50) }}
                                        </div>
                                        @break
                                    {{-- matches --}}
                                    @case (2)
                                        <div class="text-xs">
                                            {{ $date->match->matchType->description }}{{ $date->match->matchweek ? " | ".($date->match->matchType->id == 2 ? $date->match->matchweek.".ST" : $date->match->matchweek) : null }}
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <div class="tracking-tighter">
                                                <span class="inline-block sm:hidden text-sm">{{ $date->match->teamHome->name_short }}</span>
                                                <span class="hidden sm:inline-block md:hidden">{{ $date->match->teamHome->name_short }}</span>
                                                <span class="hidden md:inline-block">{{ $date->match->teamHome->name }}</span>
                                            </div>
                                            <div class="p-1 text-sm tracking-tighter font-bold bg-gray-100">
                                                {{ $date->datetime->format('H:i') }}
                                            </div>
                                            <div class="tracking-tighter">
                                                <span class="inline-block sm:hidden text-sm">{{ $date->match->teamAway->name_short }}</span>
                                                <span class="hidden sm:inline-block md:hidden">{{ $date->match->teamAway->name_short }}</span>
                                                <span class="hidden md:inline-block">{{ $date->match->teamAway->name }}</span>
                                            </div>
                                        </div>
                                        @break
                                    {{-- tournament--}}
                                    @case (3)
                                        <div class="text-xs">
                                            {{ $date->dateType->description }}
                                        </div>
                                        <div class="">
                                            {{ $date->tournament->title }}
                                        </div>
                                        <div class="flex space-x-1">
                                            <div class="p-1 text-sm tracking-tighter font-bold bg-gray-100">
                                                {{ $date->datetime->format('H:i') }}
                                            </div>
                                            <div class="p-1 text-sm text-gray-500">
                                                {{ $date->tournament->description }}
                                            </div>
                                        </div>
                                        @break
                                    {{-- date or party --}}
                                    @case (4)
                                        <div class="text-xs">
                                            {{ $date->dateType->description }}
                                        </div>
                                        <div class="">
                                            {{ $date->title }}
                                        </div>
                                        <div class="flex space-x-1">
                                            <div class="p-1 text-sm tracking-tighter font-bold bg-gray-100">
                                                {{ $date->datetime->format('H:i') }}
                                            </div>
                                            <div class="p-1 text-sm text-gray-500">
                                                {{ $date->description }}
                                            </div>
                                        </div>
                                        @break
                                @endswitch
                                @if ($date->location)
                                    <div class="text-sm">
                                        <i class="fas fa-map-marker-alt text-red-500"></i> {{ $date->location->name_short ?: $date->location->name }}
                                    </div>
                                @endif
                            </div>
                            {{-- poll --}}
                            @auth
                                <div class="flex justify-end items-center space-x-2">
                                    <div class="hidden md:flex text-xs text-center text-gray-500">
                                        @if ($date->poll_is_open)
                                            @if ($date->poll_ends > \Carbon\Carbon::today())
                                                Schließt {{ $date->poll_ends->diffForHumans() }}
                                            @elseif ($date->poll_ends == \Carbon\Carbon::today())
                                                Schließt heute
                                            @endif
                                        @else
                                            Rückmeldung geschlossen
                                        @endif
                                    </div>
                                    <x-participate-button :date="$date" >
                                        Rückmelden
                                    </x-participate-button>
                                </div>
                            @endauth
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-section>

