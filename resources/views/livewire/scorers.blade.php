<div>
    <div class="mb-3 flex items-center space-x-2">
        <x-select-label for="selected_season">Saison: </x-select-label>
        <select name="selected_season" wire:model="selected_season">
            @foreach ($selectable_seasons as $selected_season)
                <option value="{{ $selected_season->id }}">{{ $selected_season->title }}</option>
            @endforeach
        </select>
    </div>
    <div wire:loading>
        <i class="far fa-futbol fa-spin" ></i>
    </div>

    <x-table.table wire:loading.remove>
        <x-slot name="header">
            <x-table.row>
                <x-table.heading class="text-center">#</x-table.heading>
                <x-table.heading></x-table.heading>
                <x-table.heading class="text-center" wire:click="sortBy('total_goals')" selectable direction="{{ $sortField == 'total_goals' ? $sortDirection : null }}">
                    <i class="far fa-futbol"></i>
                </x-table.heading>
                <x-table.heading class="text-center" wire:click="sortBy('total_assists')" selectable direction="{{ $sortField == 'total_assists' ? $sortDirection : null }}">
                    <i class="far fa-handshake"></i>
                </x-table.heading>
                <x-table.heading class="text-center" wire:click="sortBy('scorer_points')" selectable direction="{{ $sortField == 'scorer_points' ? $sortDirection : null }}">
                    &Sigma;
                </x-table.heading>
            </x-table.row>
        </x-slot>
        <x-slot name="body">
            @php
                $scorer_place = 1;
                ${"prev_$sortField"} = 0;
                $prev_scorer_place = 0;
            @endphp
            @foreach($scorers as $scorer)
                @php
                    if ($scorer->$sortField < ${"prev_$sortField"})
                    {
                        $scorer_place++;
                    }
                @endphp
                <x-table.row>
                    <x-table.cell class="text-center font-bold">
                        @if (($scorer_place != $prev_scorer_place || $scorer_place < 4) && $sortDirection != 'asc')
                            {{ $scorer_place }}
                        @endif
                    </x-table.cell>
                    <x-table.cell class="py-2 flex-col">
                        <div class="">
                            {{ $scorer->fulL_name_short }}
                        </div>
                        <div class="flex">
                            <div class="h-2 bg-primary-600" style="width: {{ ceil(($scorer->total_goals / ($scorers->sum('scorer_points')))*100) }}% "></div>
                            <div class="h-2 bg-primary-300" style="width: {{ ceil(($scorer->total_assists / ($scorers->sum('scorer_points')))*100) }}% "></div>
                        </div>
                    </x-table.cell>
                    <x-table.cell class="text-center">{{ $scorer->total_goals }}</x-table.cell>
                    <x-table.cell class="text-center">{{ $scorer->total_assists }}</x-table.cell>
                    <x-table.cell class="text-center font-bold text-primary-700">{{ $scorer->scorer_points }}</x-table.cell>
                </x-table.row>
                @php
                    ${"prev_$sortField"} = $scorer->$sortField;
                    $prev_scorer_place = $scorer_place;
                @endphp
            @endforeach
        </x-slot>
    </x-table.table>

</div>
