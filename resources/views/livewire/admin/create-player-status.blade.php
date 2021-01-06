<div>
    @include('admin.includes.alert')

    {{-- delete confirmation --}}
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            Spieler-Status {{ $player_status->id }} löschen
        </x-slot>
        <x-slot name="content">
            Möchten Sie den Spieler-Status wirklich löschen?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy({{ $player_status->id }})">
                Löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- create or maintain modal --}}
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Spieler-Status {{ $player_status->id ? $player_status->id." ändern" : "anlegen" }}
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="mb-6">
                    <x-jet-label for="player_status.description" class="flex justify-between">
                        Beschreibung <i class="fas fa-fw fa-asterisk text-xs text-red-400"></i>
                    </x-jet-label>
                    <x-jet-input class="w-full" type="text" id="player_status.description" wire:model.defer="player_status.description" placeholder="" required />
                    <x-jet-input-error for="player_status.description" />
                </div>
                <!-- can play? -->
                <div class="mb-6 flex items-center space-x-2">
                    <x-input-checkbox wire:model="player_status.can_play" id="can_play" />
                    <x-input-checkbox-label for="can_play">
                        Kann spielen?
                    </x-input-checkbox-label>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" >
                            {{ $player_status->id ? "Übernehmen" : "Anlegen" }}
                        </x-confirmation-button>
                    </span>
                    <span class="flex w-full sm:w-auto">
                        <x-button wire:click="closeModal()" wire:loading.attr="disabled">
                            Abbrechen
                        </x-button>
                    </span>
                </div>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
    {{-- create a new player status, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <span class="block shadow-xl rounded-md">
            <x-confirmation-button wire:click="create()">
                Anlegen
            </x-confirmation-button>
        </span>
    </div>


</div>
