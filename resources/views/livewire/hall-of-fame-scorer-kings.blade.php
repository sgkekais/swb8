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
                    <x-table.heading class="w-1/12 text-center" wire:click="sortBy('scorer_titles_count')" selectable direction="{{ $sortField == 'scorer_titles_count' ? $sortDirection : null }}">
                        <x-cannon class="inline-block w-6 h-auto fill-current text-yellow-500" />
                    </x-table.heading>
                </x-table.row>
            </x-slot>
            <x-slot name="body">
                @php
                    $scorer_king_place = 1;
                    ${"prev_$sortField"} = 0;
                    $prev_scorer_king_place = 0;
                    $scorer_king_place_color = "";
                @endphp
                @foreach($scorer_kings as $scorer_king)
                    @php
                        if ($scorer_king->$sortField < ${"prev_$sortField"})
                        {
                            $scorer_king_place++;
                        }
                        if ($scorer_king_place == 1)
                        {
                            $scorer_king_place_color = "bg-yellow-200 ring-yellow-400";
                        } elseif ($scorer_king_place == 2) {
                            $scorer_king_place_color = "bg-gray-200 ring-gray-400";
                        } elseif ($scorer_king_place == 3) {
                           $scorer_king_place_color = "bg-yellow-500 ring-yellow-600";
                        } else {
                            $scorer_king_place_color = "bg-white ring-white";
                        }
                    @endphp
                    @php
                        $user_row_color = "";
                        if ($scorer_king->user && auth()->user())
                            if ($scorer_king->user->id === auth()->user()->id)
                                $user_row_color = "bg-yellow-100 bg-opacity-50";
                    @endphp
                    <x-table.row class="hover:bg-gray-100 {{ $user_row_color }}">
                        <x-table.cell class="text-center font-bold">
                            <div class="flex justify-center">
                                <div class="{{ $sortDirection != 'asc' ? "ring" : null }} rounded-full h-8 w-8 flex items-center justify-center {{ $sortDirection != 'asc' ? $scorer_king_place_color : null }} text-gray-900 text-lg font-bold" >
                                    @if (($scorer_king_place != $prev_scorer_king_place || $scorer_king_place < 4) && $sortDirection != 'asc')
                                        {{ $scorer_king_place }}
                                    @else
                                        <span class="text-gray-500">&bull;</span>
                                    @endif
                                </div>
                            </div>
                        </x-table.cell>
                        <x-table.cell class="py-2 pl-4 md:pl-0 flex-col ">
                            <div class="flex space-x-2">
                                <div>
                                    {{ $scorer_king->name_short }}
                                </div>
                                <div class="text-sm">
                                    (<i class="far fa-futbol text-gray-700"></i> {{ $scorer_king->goals()->count() }})
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="h-1 bg-gray-700" style="width: {{ round( $scorer_king->total_hlw_titles / $scorer_kings->sum('scorer_titles_count'), 4 ) * 100 }}% "></div>
                                <div class="h-1 bg-gray-400" style="width: {{ round( $scorer_king->total_ah_titles / $scorer_kings->sum('scorer_titles_count'), 4 ) * 100 }}% "></div>
                                <div class="h-1 bg-gray-200 flex-1"></div>
                                <div class="text-xs pl-2">{{ round( $scorer_king->scorer_titles_count / $scorer_kings->sum('scorer_titles_count'), 4 ) * 100 }}%</div>
                            </div>
                            <div class="flex flex-col text-xs text-gray-700">
                                @if ($scorer_king->total_hlw_titles > 0)
                                    <div>
                                        HLW:
                                        @foreach($scorer_king->scorerTitles->sortByDesc('year')->where('is_ah_season', false) as $hlw_title)
                                            <span class="inline-block tracking-tighter">
                                            {{ $hlw_title->year }}@unless($loop->last),@endunless
                                        </span>
                                        @endforeach
                                    </div>
                                @endif
                                @if ($scorer_king->total_ah_titles > 0)
                                    <div>
                                        AH:
                                        @foreach($scorer_king->scorerTitles->sortByDesc('year')->where('is_ah_season', true) as $ah_title)
                                            <span class="inline-block tracking-tighter">
                                            {{ $ah_title->year }}@unless($loop->last),@endunless
                                        </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </x-table.cell>
                        <x-table.cell class="text-lg text-center">{{ $scorer_king->total_hlw_titles }}</x-table.cell>
                        <x-table.cell class="text-lg text-center">{{ $scorer_king->total_ah_titles }}</x-table.cell>
                        <x-table.cell class="text-lg text-center font-bold text-primary-700">{{ $scorer_king->scorer_titles_count }}</x-table.cell>
                    </x-table.row>
                @php
                    ${"prev_$sortField"} = $scorer_king->$sortField;
                    $prev_scorer_king_place = $scorer_king_place;
                @endphp
            @endforeach
            <!-- totals -->
                <x-table.row>
                    <x-table.cell></x-table.cell>
                    <x-table.cell></x-table.cell>
                    <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $scorer_kings->sum('total_hlw_titles') }}</x-table.cell>
                    <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $scorer_kings->sum('total_ah_titles') }}</x-table.cell>
                    <x-table.cell class="text-lg sm:text-xl text-center font-bold">{{ $scorer_kings->sum('scorer_titles_count') }}</x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table.table>

    </div>
