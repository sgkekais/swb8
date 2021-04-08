<x-section>
    <div>
        <div class="mb-6 flex flex-col space-y-4 md:space-y-0 md:flex-row">
            <div>
                <x-select-label for="selected_season" class="text-primary-700">
                    Saison:
                </x-select-label>
                <x-select name="selected_season" wire:model="selected_season">
                    @foreach ($selectable_seasons as $selected_season)
                        <option value="{{ $selected_season->id }}">{{ $selected_season->title }}</option>
                    @endforeach
                </x-select>
            </div>
            <!-- season stats -->
            <div class="flex flex-1 justify-around font-bold items-center text-xl md:text-3xl divide-x divide-gray-200 tracking-tighter" wire:loading.remove>
                <div class="flex flex-1 flex-col items-center">
                    <span class="text-gray-700">
                        {{ $sinners->count() }}
                    </span>
                    <span class="font-normal text-base sm:text-lg md:text-xl text-gray-500">
                        Sünder
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center text-center">
                    <span class="text-gray-700">
                        {{ $sinners->sum('total_cards') }}
                    </span>
                    <span class="font-normal text-base sm:text-lg md:text-xl text-gray-500">
                        Karten
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center text-center">
                    <span class="text-gray-700">
                        {{ $sinners->sum('total_time_penalties') }}
                    </span>
                    <span class="font-normal text-base sm:text-lg md:text-xl text-gray-500">
                        10 Min.
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center text-center">
                    <span class="text-gray-700">
                         {{ $sinners->sum('total_yellow_cards') }}
                    </span>
                    <span class="font-normal text-base sm:text-lg md:text-xl text-gray-500">
                        Gelbe
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center text-center">
                    <span class="text-gray-700">
                        {{ $sinners->sum('total_yellow_red_cards') }}
                    </span>
                    <span class="font-normal text-base md:text-xl text-gray-500">
                        Gelb-Rote
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center text-center">
                    <span class="text-gray-700">
                        {{ $sinners->sum('total_red_cards') }}
                    </span>
                    <span class="font-normal text-base sm:text-lg md:text-xl text-gray-500">
                        Rote
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center text-center">
                    <span class="text-gray-700">
                        {{ $sinners->sum('sinner_points') }}
                    </span>
                    <span class="font-normal text-base sm:text-lg md:text-xl text-gray-500">
                        &#127821;
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center p-4 mb-4 bg-gray-100 space-x-4">
            <div class="">
                <i class="far fa-lightbulb fa-fw"></i>
            </div>
            <div class="flex flex-wrap space-x-2">
                <span>Datenbank: erste Karte erfasst am {{ $first_card->isoFormat('DD.MM.YY') }}</span>
                <span>Punkteregel für die goldene Ananas (&#127821;):</span>
                <span class="tracking-tighter"><i class="fas fa-square text-yellow-400"></i>/<i class="fas fa-stopwatch text-gray-400 "></i> = <span class="font-bold">1</span> Pkt, <i class="fas fa-square text-yellow-400" title="Gelb-Rote Karte"></i><i class="fas fa-square text-red-500" title="Gelb-Rote Karte"></i> = <span class="font-bold">3</span> Pkt, <i class="fas fa-square text-red-500" title="Rote Karte"></i> = <span class="font-bold">5</span>  Pkt</span>
            </div>
        </div>
        <div class="flex items-center p-4 mb-4 bg-yellow-100 space-x-4">
            <div class="">
                <i class="fas fa-info fa-fw"></i>
            </div>
            <div class="">
                Die Punkt-Spalten können auf- und absteigend sortiert werden.
            </div>
        </div>

        <x-load-indicator />

        <x-table.table wire:loading.remove class="w-full">
            <x-slot name="header">
                <x-table.row>
                    <x-table.heading class="w-1/12 text-center">#</x-table.heading>
                    <x-table.heading></x-table.heading>
                    <x-table.heading class="w-1/12 text-center" wire:click="sortBy('total_time_penalties')" selectable direction="{{ $sortField == 'total_time_penalties' ? $sortDirection : null }}">
                        <i class="fas fa-stopwatch text-gray-400 " title="10-Minuten-Strafe"></i>
                    </x-table.heading>
                    <x-table.heading class="w-1/12 text-center" wire:click="sortBy('total_yellow_cards')" selectable direction="{{ $sortField == 'total_yellow_cards' ? $sortDirection : null }}">
                        <i class="fas fa-square text-yellow-400" title="Gelbe Karte"></i>
                    </x-table.heading>
                    <x-table.heading class="w-1/12 text-center" wire:click="sortBy('total_yellow_red_cards')" selectable direction="{{ $sortField == 'total_yellow_red_cards' ? $sortDirection : null }}">
                        <i class="fas fa-square text-yellow-400" title="Gelb-Rote Karte"></i><i class="fas fa-square text-red-500" title="Gelb-Rote Karte"></i>
                    </x-table.heading>
                    <x-table.heading class="w-1/12 text-center" wire:click="sortBy('total_red_cards')" selectable direction="{{ $sortField == 'total_red_cards' ? $sortDirection : null }}">
                        <i class="fas fa-square text-red-500" title="Rote Karte"></i>
                    </x-table.heading>
                    <x-table.heading class="w-1/12 text-center" wire:click="sortBy('sinner_points')" selectable direction="{{ $sortField == 'sinner_points' ? $sortDirection : null }}">
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
                            $sinner_place_color = "bg-yellow-200 ring-yellow-400";
                        } elseif ($sinner_place == 2) {
                            $sinner_place_color = "bg-gray-200 ring-gray-400";
                        } elseif ($sinner_place == 3) {
                           $sinner_place_color = "bg-yellow-500 ring-yellow-600";
                        } else {
                            $sinner_place_color = "bg-white ring-white";
                        }
                    @endphp
                    @php
                        $user_row_color = "";
                        if ($sinner->user && auth()->user())
                            if ($sinner->user->id === auth()->user()->id)
                                $user_row_color = "bg-yellow-100 bg-opacity-50";
                    @endphp
                    <x-table.row class="hover:bg-gray-100 {{ $user_row_color }}">
                        <x-table.cell class="text-center font-bold">
                            <div class="flex justify-center">
                                <div class="ring rounded-full h-8 w-8 flex items-center justify-center {{ $sortDirection != 'asc' ? $sinner_place_color : null }} text-gray-900 text-lg font-bold" >
                                    @if (($sinner_place != $prev_sinner_place || $sinner_place < 4) && $sortDirection != 'asc')
                                        {{ $sinner_place }}
                                    @else
                                        <span class="text-gray-500">&bull;</span>
                                    @endif
                                </div>
                            </div>
                        </x-table.cell>
                        <x-table.cell x-data="{ show:false }" class="py-2 pl-4 md:pl-0 flex-col relative cursor-pointer">
                            <!-- player info popup -->
                            @auth
                                <div x-show="show" @click.away="show = false" class="absolute top-7 z-50 w-96 max-w-screen bg-white">
                                    <x-player-popup :player="$sinner" />
                                </div>
                            @endauth
                            <div @click="show = !show" class="relative">
                                {{ $sinner->name_short }}
                            </div>
                            <div class="flex items-center">
                                <div class="h-1 bg-gray-400" style="width: {{ round( $sinner->total_time_penalties / $sinners->sum('sinner_points'), 4 ) * 100 }}% "></div>
                                <div class="h-1 bg-yellow-400" style="width: {{ round( $sinner->total_yellow_cards / $sinners->sum('sinner_points'), 4 ) * 100 }}% "></div>
                                <div class="h-1" style="width: {{ round( $sinner->total_yellow_red_cards * 3 / $sinners->sum('sinner_points'), 4 ) * 100 }}%;
                                    background-image: linear-gradient(90deg, #fbbf14 25%, #ef4444 25%, #ef4444 50%, #fbbf24 50%, #fbbf24 75%, #ef4444 75%, #ef4444 100%);
                                    background-size: 20px 20px;"></div>
                                <div class="h-1 bg-red-500" style="width: {{ round( $sinner->total_red_cards * 5 / $sinners->sum('sinner_points'), 4 ) * 100 }}% "></div>
                                <div class="h-1 bg-gray-200 flex-1"></div>
                                <div class="text-xs pl-2">{{ round( $sinner->sinner_points / $sinners->sum('sinner_points'), 4 ) * 100 }}%</div>
                            </div>
                        </x-table.cell>
                        <x-table.cell class="text-lg text-center">{{ $sinner->total_time_penalties }}</x-table.cell>
                        <x-table.cell class="text-lg text-center">{{ $sinner->total_yellow_cards }}</x-table.cell>
                        <x-table.cell class="text-lg text-center">{{ $sinner->total_yellow_red_cards }}</x-table.cell>
                        <x-table.cell class="text-lg text-center">{{ $sinner->total_red_cards }}</x-table.cell>
                        <x-table.cell class="text-lg text-center font-bold text-primary-700">{{ $sinner->sinner_points }}</x-table.cell>
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
                    <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $sinners->sum('total_time_penalties') }}</x-table.cell>
                    <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $sinners->sum('total_yellow_cards') }}</x-table.cell>
                    <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $sinners->sum('total_yellow_red_cards') }}</x-table.cell>
                    <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $sinners->sum('total_red_cards') }}</x-table.cell>
                    <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $sinners->sum('sinner_points') }}</x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table.table>

    </div>
</x-section>

