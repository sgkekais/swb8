@props([
    'date' => null,
])

@isset($date)
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
            <span class="inline-flex">
                {{ $date->match->matchType->description }}{{ $date->match->matchweek ? " | ".($date->match->matchType->id == 2 ? $date->match->matchweek.".ST" : $date->match->matchweek) : null }}
            </span>
            @break
        @case (3)
            <i class="fas fa-medal text-yellow-600" title="{{ $date->dateType->description }}"></i>
            @break
        @case (4)
            <i class="fas fa-glass-cheers text-pink-600" title="{{ $date->dateType->description }}"></i>
            @break
    @endswitch
@endif
