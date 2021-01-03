<div>
    @include('admin.includes.alert')

    {{-- delete confirmation --}}
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            Saison {{ $season->id }} löschen
        </x-slot>
        <x-slot name="content">
            Möchten Sie die Saison wirklich löschen?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy({{ $season->id }})">
                Löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- create or maintain modal --}}
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Saison {{ $season->id ? $season->id." ändern" : "anlegen" }}
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="mb-6 flex items-center space-x-2">
                    <div>
                        <x-jet-label for="season.number" class="flex justify-between">
                            Nummer
                        </x-jet-label>
                        <x-jet-input class="w-full" type="number" id="season.number" wire:model.defer="season.number" placeholder="" />
                        <x-jet-input-error for="season.number" />
                    </div>
                    <div>
                        <x-jet-label for="season.title" class="flex justify-between">
                            Titel
                        </x-jet-label>
                        <x-jet-input class="w-full" type="text" id="season.title" wire:model.defer="season.title" placeholder="" />
                        <x-jet-input-error for="season.title" />
                    </div>
                </div>
                <!-- match description -->
                <div class="mb-6">
                    <x-jet-label for="season.description" class="flex justify-between">
                        Beschreibung
                    </x-jet-label>
                    <textarea id="season.description" wire:model.defer="season.description" class="w-full" rows="5">

                    </textarea>
                    <x-jet-input-error for="season.description" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" >
                            {{ $season->id ? "Übernehmen" : "Anlegen" }}
                        </x-confirmation-button>
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
    {{-- create a new match type, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <x-confirmation-button wire:click="create()">
            Anlegen
        </x-confirmation-button>
    </div>


</div>
