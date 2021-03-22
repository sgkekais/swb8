<x-section>

    <div>
        <div class="mb-6">
            <label for="selected_season" class="font-bold text-primary-600">
                Saison auswählen
            </label>
            <select name="selected_season" wire:model="selected_season" class="focus:ring-primary-700 focus:border-primary-700">
                @foreach ($seasons as $season)
                    <option value="{{ $season->id }}">{{ $season->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="" wire:loading>
            <i class="far fa-futbol fa-spin"></i>
        </div>
        <div class="flex items-center p-4 mb-4 bg-gray-100 space-x-4" wire:loading.remove>
            <div class="">
                <i class="far fa-lightbulb"></i>
            </div>
            <div class="">
                {{ $matches->first()->season->description }}
            </div>
        </div>
        <table class="w-full overflow-x-scroll" wire:loading.remove>
            @php
                $points = 0;
                $goals_for = 0;
                $goals_against = 0;
            @endphp
            @foreach ($matches->sortBy('date.datetime') as $match)
                {{-- <div class="flex w-full justify-start items-center space-x-4 py-4 border-b border-gray-200" wire:loading.remove> --}}
                <tr class="sm:hidden">
                    <td colspan="8" class="bg-gray-100">
                        <div class="p-1 flex text-xs text-gray-700 space-x-2">
                            <span class="">
                                {{ $match->matchType->description }}
                            </span>
                            @if ($match->matchweek)
                                <span>
                                    {{ $match->matchType->id == 2 ? $match->matchweek.".ST" : $match->matchweek }}
                                </span>
                            @endif
                            @if ($match->date->datetime)
                                <span class="font-bold">{{ $match->date->datetime->isoFormat('DD.MM.YY') }}</span>
                                <span class="font-bold"> um {{ $match->date->datetime->format('H:i') }}</span>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr class="border-b border-gray-300 sm:h-16">
                    <td class="px-2">
                        <div class="flex justify-center">
                            @if ($match->matchType->id == 1)
                                <i class="far fa-handshake sm:fa-lg text-blue-600"></i>
                            @elseif ($match->matchType->id == 2)
                                <x-hlw-logo class="fill-current text-primary-600 h-3 sm:h-4"/>
                            @elseif ($match->matchType->id == 3)
                                <i class="fas fa-trophy sm:fa-lg text-yellow-600"></i>
                            @elseif ($match->matchType->id == 4)
                                <x-hlw-logo class="fill-current text-primary-600 h-3 sm:h-4"/>
                            @endif
                        </div>
                    </td>
                    <td class="hidden sm:table-cell">
                        <div class="flex text-sm text-gray-700 space-x-2">
                            <span class="">
                                {{ $match->matchType->description }}
                            </span>
                            <span>
                                {{ $match->matchweek ? ($match->matchType->id == 2 ? $match->matchweek.".ST" : $match->matchweek) : null }}
                            </span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:space-x-2">
                            @if ($match->date->datetime)
                                <span>{{ $match->date->datetime->isoFormat('DD.MM.YY') }}</span>
                                <span>{{ $match->date->datetime->format('H:i') }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="">
                        <div class="flex flex-col flex-col-reverse sm:flex-row justify-end items-center sm:space-x-2 tracking-tighter text-right">
                            <span class="inline-block md:hidden text-sm">{{ $match->teamHome->name_code }}</span>
                            <span class="hidden md:inline-block lg:hidden">{{ $match->teamHome->name_short }}</span>
                            <span class="hidden lg:inline-block">{{ $match->teamHome->name }}</span>
                            <img src="{{ $match->teamHome->logo() }}" class="w-8 h-auto" alt="{{ $match->teamHome->name_short." Logo" }}"/>
                        </div>
                    </td>
                    <td class="tracking-tighter text-center">
                        @if ($match->isPlayedOrRated())
                            <div class="font-extrabold text-xl p-1
                                @if ($match->isWon())
                                    text-primary-600
                                @elseif ($match->isLost())
                                    text-red-500
                                @else
                                    text-black
                                @endif
                            ">

                                {{ $match->goals_home }}:{{ $match->goals_away }}
                            </div>
                            <div class="">
                                ({{ $match->goals_home_ht }}:{{ $match->goals_away_ht }})
                            </div>
                        @else
                            <div>-:-</div>
                        @endif
                    </td>
                    <td class="">
                        <div class="flex flex-col sm:flex-row justify-start items-center sm:space-x-2 tracking-tighter text-left">
                            <img src="{{ $match->teamAway->logo() }}" class="w-8 h-auto" alt="{{ $match->teamAway->name_short." Logo" }}"/>
                            <span class="inline-block md:hidden text-sm">{{ $match->teamAway->name_code }}</span>
                            <span class="hidden md:inline-block lg:hidden">{{ $match->teamAway->name_short }}</span>
                            <span class="hidden lg:inline-block">{{ $match->teamAway->name }}</span>
                        </div>
                    </td>
                    <td class="hidden sm:table-cell">
                        @isset($match->date->location)
                            <span class="lg:hidden">{{ $match->date->location->name_short }}</span>
                            <span class="hidden lg:inline-flex">{{ $match->date->location->name }}</span>
                        @endisset
                    </td>
                    <td class="text-center">
                        @if ($match->matchType->is_point_match)
                            @if (($match->teamHome->owner && ($match->goals_home > $match->goals_away)) || ($match->teamAway->owner && ($match->goals_home < $match->goals_away)))
                                @php
                                    $points += 3;
                                @endphp
                            @elseif ($match->goals_home == $match->goals_away && $match->goals_home !== NUll && $match->goals_away !== NULL)
                                @php
                                    $points += 1;
                                @endphp
                            @endif
                            {{ $points }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($match->matchType->is_point_match)
                            @if ($match->teamHome->owner)
                                {{ $goals_for += $match->goals_home }}:{{ $goals_against += $match->goals_away }}
                            @else
                                {{ $goals_for += $match->goals_away }}:{{ $goals_against += $match->goals_home }}
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-section>

