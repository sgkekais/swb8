<x-section class="py-0">
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
                        {{ $scorers->sum('total_assists') }}
                    </span>
                    <span class="font-normal text-lg md:text-xl text-gray-500">
                        Assists
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center">
                    <span class="text-gray-700">
                         {{ $scorers->sum('total_goals') }}
                    </span>
                    <span class="font-normal text-lg md:text-xl text-gray-500">
                        Tore
                    </span>
                </div>
                <div class="flex flex-1 flex-col items-center">
                    <span class="text-gray-700">
                        {{ $scorers->sum('scorer_points') }}
                    </span>
                    <span class="font-normal text-lg md:text-xl text-gray-500">
                        &Sigma;
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center p-4 mb-4 bg-gray-100 space-x-4">
            <div class="">
                <i class="far fa-lightbulb fa-fw"></i>
            </div>
            <div class="">
                Vorlagen werden erst seit 2016 erfasst.
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
                    <x-table.heading class=""></x-table.heading>
                    <x-table.heading class="w-1/12 text-center" wire:click="sortBy('total_assists')" selectable direction="{{ $sortField == 'total_assists' ? $sortDirection : null }}">
                        <i class="fas fa-hands-helping"></i>
                    </x-table.heading>
                    <x-table.heading class="w-1/12 text-center" wire:click="sortBy('total_goals')" selectable direction="{{ $sortField == 'total_goals' ? $sortDirection : null }}">
                        <i class="far fa-futbol"></i>
                    </x-table.heading>
                    <x-table.heading class="w-1/12 text-center" wire:click="sortBy('scorer_points')" selectable direction="{{ $sortField == 'scorer_points' ? $sortDirection : null }}">
                        &Sigma;
                    </x-table.heading>
                </x-table.row>
            </x-slot>
            <x-slot name="body">
                @php
                    $scorer_place = 1;
                    ${"prev_$sortField"} = 0;
                    $prev_scorer_place = 0;
                    $scorer_place_color = "";
                @endphp
                @foreach($scorers as $scorer)
                    @php
                        if ($scorer->$sortField < ${"prev_$sortField"})
                        {
                            $scorer_place++;
                        }
                        if ($scorer_place == 1)
                        {
                            $scorer_place_color = "bg-yellow-300 ring-yellow-100";
                        } elseif ($scorer_place == 2) {
                            $scorer_place_color = "bg-gray-300 ring-gray-100";
                        } elseif ($scorer_place == 3) {
                           $scorer_place_color = "bg-yellow-600 ring-yellow-400";
                        } else {
                            $scorer_place_color = "bg-white ring-white";
                        }
                    @endphp
                    @php
                        $user_row_color = "";
                        if ($scorer->user && auth()->user())
                            if ($scorer->user->id === auth()->user()->id)
                                $user_row_color = "bg-yellow-100 bg-opacity-50";
                    @endphp
                    <x-table.row class="hover:bg-gray-100 {{ $user_row_color }} text-lg">
                        <x-table.cell class="text-center font-bold">
                            <div class="flex justify-center">
                                <div class="ring rounded-full {{ $scorer_place === 1 ? "h-10 w-10" : ($scorer_place === 2 ? "h-9 w-9" : "h-8 w-8") }} flex items-center justify-center {{ $sortDirection != 'asc' ? $scorer_place_color : null }} text-gray-900 text-xl font-bold" >
                                    @if (($scorer_place != $prev_scorer_place || $scorer_place < 4) && $sortDirection != 'asc')
                                        {{ $scorer_place }}
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
                                    <x-player-popup :player="$scorer" />
                                </div>
                            @endauth
                            <div @click="show = !show" class="relative">
                                {{ $scorer->name_short }}
                            </div>
                            <div class="flex">
                                <div class="h-1 bg-primary-300" style="width: {{ ceil( ($scorer->total_assists / $scorers->sum('scorer_points')) * 100 ) }}% "></div>
                                <div class="h-1 bg-primary-600" style="width: {{ ceil( ($scorer->total_goals / $scorers->sum('scorer_points')) * 100 ) }}% "></div>
                                <div class="h-1 bg-gray-200 flex-1"></div>
                            </div>
                        </x-table.cell>
                        <x-table.cell class="text-center">{{ $scorer->total_assists }}</x-table.cell>
                        <x-table.cell class="text-center">{{ $scorer->total_goals }}</x-table.cell>
                        <x-table.cell class="text-center font-bold text-primary-700">{{ $scorer->scorer_points }}</x-table.cell>
                    </x-table.row>
                    @php
                        ${"prev_$sortField"} = $scorer->$sortField;
                        $prev_scorer_place = $scorer_place;
                    @endphp
                @endforeach
                <!-- totals -->
                <x-table.row>
                    <x-table.cell></x-table.cell>
                    <x-table.cell></x-table.cell>
                    <x-table.cell class="text-xl text-center font-bold border-t border-gray-300">{{ $scorers->sum('total_assists') }}</x-table.cell>
                    <x-table.cell class="text-xl text-center font-bold border-t border-gray-300">{{ $scorers->sum('total_goals') }}</x-table.cell>
                    <x-table.cell class="text-xl text-center font-bold border-t border-gray-300">{{ $scorers->sum('scorer_points') }}</x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table.table>

    </div>
</x-section>
