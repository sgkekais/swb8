<x-section>
    <div>
        <div class="mb-3 flex items-center space-x-2">
            <x-select-label for="selected_season">Saison: </x-select-label>
            <select name="selected_season" wire:model="selected_season">
                @foreach ($selectable_seasons as $selected_season)
                    <option value="{{ $selected_season->id }}">{{ $selected_season->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="">
            Punkteregel für die goldene Ananas (&#127821;): gelbe Karte oder Zeitstrafe = 1 Punkt, gelb-rote Karte = 3 Punkte, rote Karte = 5 Punkte.
        </div>
        <div wire:loading>
            <i class="far fa-futbol fa-spin" ></i>
        </div>

        <x-table.table wire:loading.remove>
            <x-slot name="header">
                <x-table.row>
                    <x-table.heading class="text-center">#</x-table.heading>
                    <x-table.heading></x-table.heading>
                    <x-table.heading class="text-center" wire:click="sortBy('total_time_penalties')" selectable direction="{{ $sortField == 'total_time_penalties' ? $sortDirection : null }}">
                        <i class="fas fa-stopwatch text-gray-400 "></i>
                    </x-table.heading>
                    <x-table.heading class="text-center" wire:click="sortBy('total_yellow_cards')" selectable direction="{{ $sortField == 'total_yellow_cards' ? $sortDirection : null }}">
                        <i class="fas fa-square text-yellow-400"></i>
                    </x-table.heading>
                    <x-table.heading class="text-center" wire:click="sortBy('total_yellow_red_cards')" selectable direction="{{ $sortField == 'total_yellow_red_cards' ? $sortDirection : null }}">
                        <i class="fas fa-square text-yellow-400"></i><i class="fas fa-square text-red-500"></i>
                    </x-table.heading>
                    <x-table.heading class="text-center" wire:click="sortBy('total_red_cards')" selectable direction="{{ $sortField == 'total_red_cards' ? $sortDirection : null }}">
                        <i class="fas fa-square text-red-500"></i>
                    </x-table.heading>
                    <x-table.heading class="text-center" wire:click="sortBy('sinner_points')" selectable direction="{{ $sortField == 'sinner_points' ? $sortDirection : null }}">
                        &#127821;
                    </x-table.heading>
                </x-table.row>
            </x-slot>
            <x-slot name="body">
                @php
                    $sinner_place = 1;
                    ${"prev_$sortField"} = 0;
                    $prev_sinner_place = 0;
                    $sinner_place_color = "";
                @endphp
                @foreach($sinners as $sinner)
                    @php
                        if ($sinner->$sortField < ${"prev_$sortField"})
                        {
                            $sinner_place++;
                        }
                        if ($sinner_place == 1)
                        {
                            $sinner_place_color = "bg-yellow-300";
                        } elseif ($sinner_place == 2) {
                            $sinner_place_color = "bg-gray-300";
                        } elseif ($sinner_place == 3) {
                           $sinner_place_color = "bg-yellow-600";
                        } else {
                            $sinner_place_color = "bg-white";
                        }
                    @endphp
                    <x-table.row>
                        <x-table.cell class="text-center font-bold">
                            <div class="flex justify-center">
                                <div class="rounded-full h-8 w-8 flex items-center justify-center {{ $sinner_place_color }}" >
                                    @if (($sinner_place != $prev_sinner_place || $sinner_place < 4) && $sortDirection != 'asc')
                                        {{ $sinner_place }}
                                    @endif
                                </div>
                            </div>
                        </x-table.cell>
                        <x-table.cell class="py-2 flex-col">
                            <div class="">
                                {{ $sinner->fulL_name_short }}
                            </div>
                            <div class="flex">
                                <div class="h-2 bg-gray-400" style="width: {{ ceil(($sinner->total_time_penalties / ($sinners->sum('sinner_points')))*100) }}% "></div>
                                <div class="h-2 bg-yellow-400" style="width: {{ ceil(($sinner->total_yellow_cards / ($sinners->sum('sinner_points')))*100) }}% "></div>
                                <div class="h-2" style="width: {{ ceil(($sinner->total_yellow_red_cards * 3 / ($sinners->sum('sinner_points')))*100) }}%;
                                    background-image: linear-gradient(90deg, #fbbf24 25%, #ef4444 25%, #ef4444 50%, #fbbf24 50%, #fbbf24 75%, #ef4444 75%, #ef4444 100%);
                                    background-size: 20px 20px;"></div>
                                <div class="h-2 bg-red-500" style="width: {{ ceil(($sinner->total_red_cards * 5 / ($sinners->sum('sinner_points')))*100) }}% "></div>
                            </div>
                        </x-table.cell>
                        <x-table.cell class="text-center">{{ $sinner->total_time_penalties }}</x-table.cell>
                        <x-table.cell class="text-center">{{ $sinner->total_yellow_cards }}</x-table.cell>
                        <x-table.cell class="text-center">{{ $sinner->total_yellow_red_cards }}</x-table.cell>
                        <x-table.cell class="text-center">{{ $sinner->total_red_cards }}</x-table.cell>
                        <x-table.cell class="text-center font-bold text-primary-700">{{ $sinner->sinner_points }}</x-table.cell>
                    </x-table.row>
                @php
                    ${"prev_$sortField"} = $sinner->$sortField;
                    $prev_sinner_place = $sinner_place;
                @endphp
            @endforeach
            <!-- totals -->
                <x-table.row>
                    <x-table.cell></x-table.cell>
                    <x-table.cell></x-table.cell>
                    <x-table.cell class="border-t border-gray-300 text-center">{{ $sinners->sum('total_time_penalties') }}</x-table.cell>
                    <x-table.cell class="border-t border-gray-300 text-center">{{ $sinners->sum('total_yellow_cards') }}</x-table.cell>
                    <x-table.cell class="border-t border-gray-300 text-center">{{ $sinners->sum('total_yellow_red_cards') }}</x-table.cell>
                    <x-table.cell class="border-t border-gray-300 text-center">{{ $sinners->sum('total_red_cards') }}</x-table.cell>
                    <x-table.cell class="border-t border-gray-300 text-center font-bold">{{ $sinners->sum('sinner_points') }}</x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table.table>

    </div>
</x-section>

