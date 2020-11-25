<div>
    @include('admin.includes.alert')

    {{-- delete confirmation
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            Mannschaft {{ $club->id }} löschen
        </x-slot>
        <x-slot name="content">
            Möchten Sie die Mannschaft wirklich löschen?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy({{ $club->id }})">
                Löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
     create or maintain modal --}}
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Termin {{ $date->id ? $date->id." ändern" : "anlegen" }}
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="mb-6">
                    <x-jet-label for="location">
                        Standort
                    </x-jet-label>
                    <select id="location" wire:model="date.location_id" class="form-select w-full">
                        <option selected="selected">Nicht festgelegt</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <x-jet-label for="date_type">
                        Terminart
                    </x-jet-label>
                    <div class="flex">
                        <select id="date_type" wire:model="date.date_type_id" class="form-select">
                            <option selected="selected">Nicht festgelegt</option>
                            @foreach($date_types as $date_type)
                                <option value="{{ $date_type->id }}">{{ $date_type->description }}</option>
                            @endforeach
                        </select>
                        <div class="ml-2 text-green-500">
                            @isset($date->date_type_id)
                                {{ \App\Models\DateType::find($date->date_type_id)->description }} ausgewählt
                            @endisset
                         </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-jet-button {{-- wire:click.prevent="store()" --}} class="w-full justify-center" >

                        </x-jet-button>
                    </span>
                    <span class="flex w-full sm:w-auto">
                        <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="w-full justify-center">
                            Abbrechen
                        </x-jet-secondary-button>
                    </span>
                </div>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
    {{-- create a new date, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <span class="block shadow-xl rounded-md">
            <button wire:click="create()" class="btn btn-blue px-4 py-2">
                Anlegen
            </button>
        </span>
    </div>


</div>
