<div>
    <x-load-indicator />

    <x-table.table wire:loading.remove class="w-full">
        <x-slot name="header">
            <x-table.row>
                <x-table.heading class="w-1/12 text-center">#</x-table.heading>
                <x-table.heading></x-table.heading>
                <x-table.heading class="w-1/12 text-center" wire:click="sortBy('total_hlw_titles')" selectable direction="{{ $sortField == 'total_hlw_titles' ? $sortDirection : null }}">
                    HLW
                </x-table.heading>
                <x-table.heading class="w-1/12 text-center" wire:click="sortBy('total_ah_titles')" selectable direction="{{ $sortField == 'total_ah_titles' ? $sortDirection : null }}">
                    AH
                </x-table.heading>
                <x-table.heading class="w-1/12 text-center" wire:click="sortBy('ananas_titles_count')" selectable direction="{{ $sortField == 'ananas_titles_count' ? $sortDirection : null }}">
                    &#127821;
                </x-table.heading>
            </x-table.row>
        </x-slot>
        <x-slot name="body">
            @php
                $ananas_king_place = 1;
                ${"prev_$sortField"} = 0;
                $prev_ananas_king_place = 0;
                $ananas_king_place_color = "";
            @endphp
            @foreach($ananas_kings as $ananas_king)
                @php
                    if ($ananas_king->$sortField < ${"prev_$sortField"})
                    {
                        $ananas_king_place++;
                    }
                    if ($ananas_king_place == 1)
                    {
                        $ananas_king_place_color = "bg-yellow-200 ring-yellow-400";
                    } elseif ($ananas_king_place == 2) {
                        $ananas_king_place_color = "bg-gray-200 ring-gray-400";
                    } elseif ($ananas_king_place == 3) {
                       $ananas_king_place_color = "bg-yellow-500 ring-yellow-600";
                    } else {
                        $ananas_king_place_color = "bg-white ring-white";
                    }
                @endphp
                @php
                    $user_row_color = "";
                    if ($ananas_king->user && auth()->user())
                        if ($ananas_king->user->id === auth()->user()->id)
                            $user_row_color = "bg-yellow-100 bg-opacity-50";
                @endphp
                <x-table.row class="hover:bg-gray-100 {{ $user_row_color }}">
                    <x-table.cell class="text-center font-bold">
                        <div class="flex justify-center">
                            <div class="{{ $sortDirection != 'asc' ? "ring" : null }} rounded-full h-8 w-8 flex items-center justify-center {{ $sortDirection != 'asc' ? $ananas_king_place_color : null }} text-gray-900 text-lg font-bold" >
                                @if (($ananas_king_place != $prev_ananas_king_place || $ananas_king_place < 4) && $sortDirection != 'asc')
                                    {{ $ananas_king_place }}
                                @else
                                    <span class="text-gray-500">&bull;</span>
                                @endif
                            </div>
                        </div>
                    </x-table.cell>
                    <x-table.cell class="py-2 pl-4 md:pl-0 flex-col ">
                        <div class="flex items-center space-x-2">
                            <div>
                                {{ $ananas_king->name_short }}
                            </div>
                            <div class="text-sm">
                                (<i class="far fa-copy text-gray-700"></i> {{ $ananas_king->cards()->count() }})
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="h-1 bg-gray-700" style="width: {{ round( $ananas_king->total_hlw_titles / $ananas_kings->sum('ananas_titles_count'), 4 ) * 100 }}% "></div>
                            <div class="h-1 bg-gray-400" style="width: {{ round( $ananas_king->total_ah_titles / $ananas_kings->sum('ananas_titles_count'), 4 ) * 100 }}% "></div>
                            <div class="h-1 bg-gray-200 flex-1"></div>
                            <div class="text-xs pl-2">{{ round( $ananas_king->ananas_titles_count / $ananas_kings->sum('ananas_titles_count'), 4 ) * 100 }}%</div>
                        </div>
                        <div class="flex flex-col text-xs text-gray-700">
                            @if ($ananas_king->total_hlw_titles > 0)
                                <div>
                                    HLW:
                                    @foreach($ananas_king->ananasTitles->where('is_ah_season', false) as $hlw_title)
                                        <span class="inline-block tracking-tighter">
                                            {{ $hlw_title->year }}@unless($loop->last),@endunless
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                            @if ($ananas_king->total_ah_titles > 0)
                                <div>
                                    AH:
                                    @foreach($ananas_king->ananasTitles->where('is_ah_season', true) as $ah_title)
                                        <span class="inline-block tracking-tighter">
                                            {{ $ah_title->year }}@unless($loop->last),@endunless
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </x-table.cell>
                    <x-table.cell class="text-lg text-center">{{ $ananas_king->total_hlw_titles }}</x-table.cell>
                    <x-table.cell class="text-lg text-center">{{ $ananas_king->total_ah_titles }}</x-table.cell>
                    <x-table.cell class="text-lg text-center font-bold text-primary-700">{{ $ananas_king->ananas_titles_count }}</x-table.cell>
                </x-table.row>
            @php
                ${"prev_$sortField"} = $ananas_king->$sortField;
                $prev_ananas_king_place = $ananas_king_place;
            @endphp
        @endforeach
        <!-- totals -->
            <x-table.row>
                <x-table.cell></x-table.cell>
                <x-table.cell></x-table.cell>
                <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $ananas_kings->sum('total_hlw_titles') }}</x-table.cell>
                <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $ananas_kings->sum('total_ah_titles') }}</x-table.cell>
                <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $ananas_kings->sum('ananas_titles_count') }}</x-table.cell>
            </x-table.row>
        </x-slot>
    </x-table.table>

</div>
