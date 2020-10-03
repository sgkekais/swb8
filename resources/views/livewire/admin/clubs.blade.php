<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session()->has('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-xl sm:rounded-lg" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- delete club modal -->
        @if($isOpenDelete)
            @include('admin.clubs.delete')
        @endif

        <!-- create a new club, opens modal -->
        <div class="mb-2 flex">
            <span class="block shadow sm:rounded-md">
                <button wire:click="create()" class="btn btn-blue">
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
                        <th class="cursor-pointer p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('id')">@include('includes._sort-icon', ['field' => 'id']) ID</th>
                        <th class="cursor-pointer p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('name')">@include('includes._sort-icon', ['field' => 'name']) Name</th>
                        <th class="cursor-pointer p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('name_short')">@include('includes._sort-icon', ['field' => 'name_short']) Name - kurz</th>
                        <th class="cursor-pointer p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('name_code')">@include('includes._sort-icon', ['field' => 'name_code']) Name - Code</th>
                        <th class="cursor-pointer p-2 text-center text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('ah')">@include('includes._sort-icon', ['field' => 'ah']) AH</th>
                        <th class="cursor-pointer p-2 text-center text-sm font-bold text-gray-500 uppercase tracking-wider" wire:click.prevent="sortBy('owner')">@include('includes._sort-icon', ['field' => 'owner']) Unser</th>
                        <th class="cursor-pointer p-2 text-cebter text-sm font-bold text-gray-500 uppercase tracking-wider">Aktionen</th>
                    </tr>
                </thead>                                              
                <tbody class="divide-y divide-gray-200">
                    @foreach ($clubs as $club)
                        <tr class="{{ $loop->even ? "bg-gray-50" : null}} hover:bg-gray-100">
                            <td class="p-2 text-left text-sm">{{ $club->id }}</td>
                            <td class="p-2 text-left text-sm">{{ $club->name }}</td>
                            <td class="p-2 text-left text-sm">{{ $club->name_short }}</td>
                            <td class="p-2 text-left text-sm">{{ $club->name_code }}</td>
                            <td class="p-2 text-center text-sm">{{ $club->ah }}</td>
                            <td class="p-2 text-center text-sm">{{ $club->owner }}</td>
                            <td class="p-2 text-right">
                                <div class="flex justify-center">
                                    <span class="block shadow rounded-md">
                                        <button wire:click="delete({{ $club->id }})" class="btn btn-red">
                                            <i class="far fa-trash-alt fa-fw" title="Löschen"></i>
                                        </button>
                                    </span>
                                    <span class="block ml-2 shadow rounded-md">
                                        <button wire:click="edit({{ $club->id }})" class="btn btn-blue">
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
