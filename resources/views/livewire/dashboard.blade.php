<div>

    <div class="flex items-center p-4 mb-4 bg-gray-100 space-x-4">
        <div class="">
            <i class="far fa-lightbulb"></i>
        </div>
        <div class="">
            Anstehende Termine, an deren Umfragen du teilgenommen hast.
        </div>
    </div>

    <div class="flex flex-col space-y-3">
        @foreach ($future_dates as $date)
            <x-box-with-shadow>
                <div class="flex items-center space-x-2 text-sm">
                    @foreach(auth()->user()->dateOptions()->where('date_id', $date->id)->get() as $dateOption)
                        @if ($dateOption->pivot->attend)
                            <i class="fas fa-check-circle text-primary-700"></i>
                            <span class="inline-flex flex-1 p-1 bg-primary-700 text-white font-bold">
                                {{ $dateOption->description }}
                            </span>
                        @else
                            <i class="fas fa-times-circle text-red-700"></i>
                            <span class="inline-flex flex-1 p-1 bg-red-100 text-red-700 font-bold">
                                {{ $dateOption->description }}
                            </span>
                        @endif
                    @endforeach
                </div>
                <div class="w-full p-1 flex items-center space-x-2 {{ $date->cancelled ? "text-gray-500 line-through" : null }}">
                    {{-- day --}}
                    <div class="p-3 pr-0 flex flex-col text-center">
                        <div>
                            {{ $date->datetime->isoFormat('dd') }}
                        </div>
                        <div class="text-2xl font-extrabold">
                            {{ $date->datetime->isoFormat('DD.MM') }}
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
                                Ändern
                            </x-participate-button>
                        </div>
                    @endauth
                </div>
            </x-box-with-shadow>
        @endforeach
    </div>

{{--        <x-main-box>--}}
{{--            <x-slot name="header">--}}
{{--                <x-headline class="text-xl">--}}
{{--                    Zurückliegend brauchen? --}}
{{--                </x-headline>--}}
{{--            </x-slot>--}}
{{--            <ul class="list-disc">--}}
{{--                @foreach ($past_dates as $past_date)--}}
{{--                    <li>{{ $past_date }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </x-main-box>--}}

</div>

