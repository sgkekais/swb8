<div>
    @include('admin.includes.alert')

    {{-- delete confirmation --}}
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            Standort {{ $location->id }} löschen
        </x-slot>
        <x-slot name="content">
            Möchten Sie den Standort wirklich löschen?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy({{ $location->id }})">
                Löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- create or maintain modal --}}
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Standort {{ $location->id ? $location->id." ändern" : "anlegen" }}
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="mb-6">
                    <x-jet-label for="location.name" class="flex justify-between">
                        Name <i class="fas fa-fw fa-asterisk text-xs text-red-400"></i>
                    </x-jet-label>
                    <x-jet-input class="w-full" type="text" id="location.name" wire:model.defer="location.name" placeholder="Schwarz-Weiß Bilk '79" required />
                    <x-jet-input-error for="location.name" />
                </div>
                <div class="mb-6">
                    <x-jet-label for="location.name_short" value="Name - kurz" />
                    <x-jet-input class="w-full" type="text" id="location.name_short" wire:model.defer="location.name_short" placeholder="SW Bilk" maxlength="15" />
                    <x-jet-input-error for="location.name_short" />
                </div>
                <div class="mb-6">
                    <x-jet-label for="location.url" value="URL" />
                    <x-jet-input class="w-full" type="text" id="location.url" wire:model.defer="location.url" />
                    <x-jet-input-error for="location.url" />
                </div>
                <div class="mb-6">
                    <x-jet-label for="location.note" value="Notiz" />
                    <textarea class="w-full form-textarea rounded-md shadow-sm" id="location.note" wire:model.defer="location.note" rows="3">

                    </textarea>
                </div>
                <div class="mb-6 flex justify-start">
                    <div class="flex items-center mr-3">
                        <input wire:model="location.is_stadium" id="is_stadium" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                        <label for="is_stadium" class="ml-2 block leading-5 text-gray-900">
                            Ist Stadion?
                        </label>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-jet-button wire:click.prevent="store()" class="w-full justify-center" >
                            {{ $location->id ? "Übernehmen" : "Anlegen" }}
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
    {{-- create a new location, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <span class="block shadow-xl rounded-md">
            <button wire:click="create()" class="btn btn-blue px-4 py-2">
                Anlegen
            </button>
        </span>
    </div>


</div>
