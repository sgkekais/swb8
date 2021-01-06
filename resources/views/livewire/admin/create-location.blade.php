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
                        <x-input-checkbox wire:model="location.is_stadium" id="is_stadium" />
                        <x-input-checkbox-label for="is_stadium">
                            Ist Stadion?
                        </x-input-checkbox-label>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" >
                            {{ $location->id ? "Übernehmen" : "Anlegen" }}
                        </x-confirmation-button>
                    </span>
                    <span class="flex w-full sm:w-auto">
                        <x-button wire:click="closeModal()" wire:loading.attr="disabled" >
                            Abbrechen
                        </x-button>
                    </span>
                </div>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
    {{-- create a new location, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <x-confirmation-button wire:click="create()" >
            Anlegen
        </x-confirmation-button>
    </div>


</div>
