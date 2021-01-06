<div>
    @include('admin.includes.alert')

    {{-- delete confirmation --}}
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            Spielart {{ $match_type->id }} löschen
        </x-slot>
        <x-slot name="content">
            Möchten Sie die Spielart wirklich löschen?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy({{ $match_type->id }})">
                Löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- create or maintain modal --}}
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Spielart {{ $match_type->id ? $match_type->id." ändern" : "anlegen" }}
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="mb-6">
                    <x-jet-label for="match_type.description" class="flex justify-between">
                        Beschreibung <i class="fas fa-fw fa-asterisk text-xs text-red-400"></i>
                    </x-jet-label>
                    <x-jet-input class="w-full" type="text" id="match_type.description" wire:model.defer="match_type.description" placeholder="Schwarz-Weiß Bilk '79" required />
                    <x-jet-input-error for="match_type.description" />
                </div>
                <div class="mb-6">
                    <x-jet-label for="match_type.description_short" class="flex justify-between">
                        Abkürzung <i class="fas fa-fw fa-asterisk text-xs text-red-400"></i>
                    </x-jet-label>
                    <x-jet-input class="w-full" type="text" id="match_type.description_short" wire:model.defer="match_type.description_short" placeholder="Schwarz-Weiß Bilk '79" required />
                    <x-jet-input-error for="match_type.description_short" />
                </div>
                <!-- match published / cancelled -->
                <div class="mb-6 flex items-center space-x-4">
                    <div class="flex space-x-2">
                        <x-input-checkbox wire:model="match_type.is_point_match" id="point_match" />
                        <x-input-checkbox-label for="point_match">
                            Punktspiel?
                        </x-input-checkbox-label>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" >
                            {{ $match_type->id ? "Übernehmen" : "Anlegen" }}
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
    {{-- create a new match type, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <x-confirmation-button wire:click="create()" >
            Anlegen
        </x-confirmation-button>
    </div>


</div>
