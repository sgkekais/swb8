<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('admin.includes._alert')

        <!-- delete club modal -->
        @if($isOpenDelete)
            @include('admin.clubs.delete')
        @endif

        <!-- create a new club, opens modal -->
        <div class="mb-2 flex justify-center sm:justify-start">
            <span class="block shadow rounded-md">
                <button wire:click="create()" class="btn btn-blue px-4 py-2">
                    Anlegen
                </button>
                @if($isOpenMaintain)
                    @include('admin.clubs.maintain')
                @endif
            </span>
        </div>

        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="flex items-center">
                <span class="inline-block px-2 text-gray-500"><i class="fa fa-fw fa-search" title="Suchen"></i></span>
                <input type="text" placeholder="Zum Suchen hier tippen" wire:model="searchTerm" class="appearance-none block w-full bg-gray-50 p-2 text-gray-900 border-b rounded leading-tight focus:outline-none focus:bg-white" />
            </div>
            <div class="text-sm p-2">
                {{ $clubs->links('livewire.admin.pagination') }}
            </div>
            <table class="min-w-full divide-y divide-gray-200 border-t border-b border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="cursor-pointer p-1 sm:p-2 text-left text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('id')">@include('admin.includes._sort-icon', ['field' => 'id']) ID</th>
                        <th class="hidden sm:block cursor-pointer p-1 sm:p-2 text-left text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('name')">@include('admin.includes._sort-icon', ['field' => 'name']) Name</th>
                        <th class="cursor-pointer p-1 sm:p-2 text-left text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('name_short')">@include('admin.includes._sort-icon', ['field' => 'name_short']) -Kurz</th>
                        <th class="hidden sm:block cursor-pointer p-1 sm:p-2 text-center text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('name_code')">@include('admin.includes._sort-icon', ['field' => 'name_code']) -Code</th>
                        <th class="cursor-pointer p-1 sm:p-2 text-center text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('ah')">@include('admin.includes._sort-icon', ['field' => 'ah']) AH</th>
                        <th class="cursor-pointer p-1 sm:p-2 text-center text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('owner')">@include('admin.includes._sort-icon', ['field' => 'owner']) Unser</th>
                        <th class="p-1 sm:p-2 text-cebter text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-wider">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($clubs as $club)
                        <tr class="{{ $loop->even ? "bg-gray-50" : null}} hover:bg-gray-100">
                            <td class="p-1 sm:p-2 text-left text-xs sm:text-sm">{{ $club->id }}</td>
                            <td class="hidden sm:table-cell p-1 sm:p-2 text-left text-xs sm:text-sm">{{ $club->name }}</td>
                            <td class="p-1 sm:p-2 text-left text-xs sm:text-sm">{{ $club->name_short }}</td>
                            <td class="hidden sm:table-cell p-1 sm:p-2 text-center text-xs sm:text-sm">{{ $club->name_code }}</td>
                            <td class="p-1 sm:p-2 text-center text-xs sm:text-sm">{{ $club->ah }}</td>
                            <td class="p-1 sm:p-2 text-center text-xs sm:text-sm">{{ $club->owner }}</td>
                            <td class="p-1 sm:p-2 text-right">
                                <div class="flex justify-center">
                                    <span class="block shadow rounded-md">
                                        <button wire:click="delete({{ $club->id }})" class="btn btn-red p-2 sm:px-4 sm:py-2">
                                            <i class="far fa-trash-alt fa-fw" title="Löschen"></i>
                                        </button>
                                    </span>
                                    <span class="block ml-2 shadow rounded-md">
                                        <button wire:click="edit({{ $club->id }})" class="btn btn-blue p-2 sm:px-4 sm:py-2">
                                            <i class="far fa-edit fa-fw" title="Bearbeiten"></i>
                                        </button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
