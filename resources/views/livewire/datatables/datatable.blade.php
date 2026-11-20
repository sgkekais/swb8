<div>
    @if($beforeTableSlot)
        <div class="mt-8">
            @include($beforeTableSlot)
        </div>
    @endif
    <div class="relative">
        <div class="flex justify-between items-center mb-1">
            <div class="flex-grow h-10 flex items-center">
                @if($this->searchableColumns()->count())
                    <div class="w-1/2 flex rounded-lg">
                        <div class="relative flex-grow focus-within:z-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="search" type="text" class="w-full pl-10 " placeholder="Suche in Spalte {{ $this->searchableColumns()->map->label->join(', ') }}" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button wire:click="$set('search', null)" class="text-gray-400 hover:text-red-500 focus:outline-none">
                                    <x-icons.x-circle class="h-5 w-5 stroke-current" />
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex items-center space-x-1">
                <x-icons.cog wire:loading class="h-9 w-9 animate-spin text-gray-400" />

                @if($this->activeFilters)
                    <button wire:click="clearAllFilters" class="flex items-center space-x-2 px-3 border border-red-400 rounded-md bg-white text-red-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-red-200 focus:outline-none">
                        <span>Filter zurücksetzen</span>
                        <x-icons.x-circle class="m-2" />
                    </button>
                @endif

                @if($exportable)
                    <div x-data="{ init() {
                        $wire.on('startDownload', link => window.open(link, '_blank'))
                    } }" x-init="init">
                        <button wire:click="export" class="flex items-center space-x-2 px-3 border border-green-400 rounded-md bg-white text-green-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-green-200 focus:outline-none"><span>Export</span>
                            <x-icons.excel class="m-2" /></button>
                    </div>
                @endif

                @if($hideable === 'select')
                    @include('datatables::hide-column-multiselect')
                @endif

                @includeIf($buttonsSlot)
            </div>
        </div>

        @if($hideable === 'buttons')
            <div class="p-2 grid grid-cols-8 gap-2">
                @foreach($this->columns as $index => $column)
                    @if ($column['hideable'])
                        <button wire:click="toggle('{{ $index }}')" class="px-3 py-2 rounded text-white text-xs focus:outline-none
                        {{ $column['hidden'] ? 'bg-blue-100 hover:bg-blue-300 text-blue-600' : 'bg-blue-500 hover:bg-blue-800' }}">
                            {{ $column['label'] }}
                        </button>
                    @endif
                @endforeach
            </div>
        @endif

        <div class="mt-4">
            <div class="border border-black @unless($this->hidePagination) border-b-0 @endif max-w-screen overflow-x-scroll bg-white">
                <div class="table align-middle min-w-full">
                    @unless($this->hideHeader)
                        <div class="table-row divide-x divide-gray-200">
                            @foreach($this->columns as $index => $column)
                                @if($hideable === 'inline')
                                    @include('datatables::header-inline-hide', ['column' => $column, 'sortIndex' => $sortIndex])
                                @elseif($column['type'] === 'checkbox')
                                    @unless($column['hidden'])
                                        <div class="relative table-cell h-12 w-48 overflow-hidden align-top px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none">
                                            <div class="px-3 py-1 rounded @if(count($selected)) bg-orange-400 @else bg-gray-200 @endif text-white text-center">
                                                {{ count($visibleSelected) }}
                                            </div>
                                        </div>
                                    @endunless
                                @else
                                    @include('datatables::header-no-hide', ['column' => $column, 'sortIndex' => $sortIndex])
                                @endif
                            @endforeach
                        </div>
                        <div class="table-row divide-x divide-blue-200 bg-blue-100">
                            @foreach($this->columns as $index => $column)
                                @if($column['hidden'])
                                    @if($hideable === 'inline')
                                        <div class="table-cell w-5 overflow-hidden align-top bg-blue-100"></div>
                                    @endif
                                @elseif($column['type'] === 'checkbox')
                                    @include('datatables::filters.checkbox')
                                @elseif($column['type'] === 'label')
                                    <div class="table-cell overflow-hidden align-top">
                                        {{ $column['label'] ?? '' }}
                                    </div>
                                @else
                                    <div class="table-cell overflow-hidden align-top">
                                        @if($column['filterable'])
                                            @if( is_iterable($column['filterable']) )
                                                <div wire:key="select-filter-{{ $index }}-{{ $this->filterInputGeneration }}-{{ count($this->activeSelectFilters[$index] ?? []) }}">
                                                    @include('datatables::filters.select', ['index' => $index, 'name' => $column['label'], 'options' => $column['filterable']])
                                                </div>
                                            @else
                                                <div wire:key="filter-{{ $index }}-{{ $this->filterInputGeneration }}">
                                                    @include('datatables::filters.' . ($column['filterView'] ?? $column['type']), ['index' => $index, 'name' => $column['label']])
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endunless
                    @foreach($this->results as $row)
                        <div class="table-row p-1 {{ $this->rowClasses($row, $loop) }}">
                            @foreach($this->columns as $column)
                                @if($column['hidden'])
                                    @if($hideable === 'inline')
                                        <div class="table-cell w-5 overflow-hidden align-top"></div>
                                    @endif
                                @elseif($column['type'] === 'checkbox')
                                    @include('datatables::checkbox', ['value' => $row->checkbox_attribute])
                                @elseif($column['type'] === 'label')
                                    @include('datatables::label')
                                @else
                                    <div class="table-cell @if($column['contentAlign'] === 'right') text-right @elseif($column['contentAlign'] === 'center') text-center @else text-left @endif {{ $this->cellClasses($row, $column) }}">
                                        @if($row->{$column['name']} instanceof \Illuminate\Contracts\Support\Htmlable)
                                            {!! $row->{$column['name']}->toHtml() !!}
                                        @else
                                            {{ $row->{$column['name']} }}
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            @unless($this->hidePagination)
                <div class="max-w-screen border border-black border-t-0 text-gray-600">
                    <div class="p-2 sm:flex items-center justify-between">
                        <div class="my-2 sm:my-0 flex items-center">
                            <div class="mr-2 font-bolder">Zeige</div>
                            <select name="perPage" class="mt-1 pl-3 pr-10 py-2 sm:text-sm sm:leading-5" wire:model.live="perPage">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="99999999">Alle</option>
                            </select>
                        </div>

                        <div class="my-4 sm:my-0">
                            <div class="lg:hidden">
                                <span class="space-x-2">{{ $this->results->links('datatables::tailwind-simple-pagination') }}</span>
                            </div>

                            <div class="hidden lg:flex justify-center">
                                <span>{{ $this->results->links('datatables::tailwind-pagination') }}</span>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            Ergebnis <span class="inline-block px-1 font-bold">{{ $this->results->firstItem() }}-{{ $this->results->lastItem() }}</span> von
                            <span class="inline-block px-1 font-bold">{{ $this->results->total() }}</span>
                        </div>
                    </div>
                </div>
            @endunless
        </div>
    </div>
    @if($afterTableSlot)
        <div class="mt-8">
            @include($afterTableSlot)
        </div>
    @endif
</div>
