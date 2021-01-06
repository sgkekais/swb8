<div>
    <div class="mb-6">
        <label for="selected_season" class="font-bold text-primary-600">
            Saison auswählen
        </label>
        <select name="selected_season" wire:model="selected_season">
            @foreach ($seasons as $season)
                <option value="{{ $season->id }}">{{ $season->title }}</option>
            @endforeach
        </select>
    </div>
    <div class>
        {{ $season->description }}
    </div>
    <div class="" wire:loading>
        <i class="fas fa-circle-notch fa-spin"></i>
    </div>
    <table class="w-full" wire:loading.remove>
        @php
            $points = 0;
            $goals_for = 0;
            $goals_against = 0;
        @endphp
        @foreach ($matches->sortBy('date.datetime') as $match)
            {{-- <div class="flex w-full justify-start items-center space-x-4 py-4 border-b border-gray-200" wire:loading.remove> --}}
            <tr class="border-b border-gray-300 h-16">
                <td class="px-2">
                    <div class="flex justify-center">
                        @if ($match->matchType->id == 1)
                            <i class="far fa-handshake fa-lg text-blue-600"></i>
                        @elseif ($match->matchType->id == 2)
                            <x-hlw-logo class="fill-current text-primary-600 h-4"/>
                        @elseif ($match->matchType->id == 3)
                            <i class="fas fa-trophy fa-lg text-yellow-600"></i>
                        @elseif ($match->matchType->id == 4)
                            <x-hlw-logo class="fill-current text-primary-600 h-6"/>
                        @endif
                    </div>
                </td>
                <td class="">
                    <div class="text-sm text-gray-700">
                        @if ($match->matchType->description_short == 'M')
                            {{ $match->matchType->description }} | <span class="font-bold">{{ $match->matchweek }}</span>.ST
                        @else
                            {{ $match->matchType->description }}
                        @endif
                    </div>
                    <div>
                        {{ $match->date->datetime ? $match->date->datetime->format('d.m.Y').", ".$match->date->datetime->format('H:s') : null }}
                    </div>
                </td>
                <td class=" text-right text-lg tracking-tighter">
                    {{ $match->teamHome->name }}
                </td>
                <td class=" tracking-tighter text-center">
                    <div class="font-extrabold text-xl
                        @if (($match->teamHome->owner && ($match->goals_home > $match->goals_away)) ||
                                ($match->teamAway->owner && ($match->goals_home < $match->goals_away)))
                            text-primary-600
                        @elseif ($match->goals_home == $match->goals_away || $match->goals_home == NULL || $match->goals_away == NULL)

                        @else
                            text-red-500
                        @endif
                    ">
                        {{ $match->goals_home }}:{{ $match->goals_away }}
                    </div>
                    <div class="text-base">
                        ({{ $match->goals_home_ht }}:{{ $match->goals_away_ht }})
                    </div>
                </td>
                <td class=" text-left text-lg tracking-tighter">
                    {{ $match->teamAway->name }}
                </td>
                <td class="">
                    {{ $match->date->location->name }}
                </td>
                <td class=" text-center">
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
                <td class=" text-center">
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
