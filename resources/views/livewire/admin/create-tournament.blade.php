<div>
    @include('admin.includes.alert')

    {{-- delete confirmation --}}
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            Turnier {{ $tournament->id }} löschen
        </x-slot>
        <x-slot name="content">
            Möchtest du das Turnier wirklich löschen?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy({{ $tournament->id }})">
                Löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- create or maintain modal --}}
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Turnier {{ $tournament->id ? $tournament->id." ändern" : "anlegen" }}
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="mb-6">
                    <x-jet-label for="tournament.title" class="flex justify-between">
                        Titel
                    </x-jet-label>
                    <x-jet-input class="w-full" type="text" id="tournament.title" wire:model.defer="tournament.title" placeholder="" />
                    <x-jet-input-error for="tournament.title" />
                </div>
                <!-- tournament description -->
                <div class="mb-6">
                    <x-jet-label for="tournament.description" class="flex justify-between">
                        Beschreibung
                    </x-jet-label>
                    <textarea id="tournament.description" wire:model.defer="tournament.description" class="w-full" rows="5">

                    </textarea>
                    <x-jet-input-error for="tournament.description" />
                </div>
                <!-- place -->
                <div class="mb-6">
                    <x-jet-label for="tournament.place" class="flex justify-between">
                        Platz
                    </x-jet-label>
                    <textarea id="tournament.place" wire:model.defer="tournament.place" class="w-full" rows="5">

                    </textarea>
                    <x-jet-input-error for="tournament.place" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" >
                            {{ $tournament->id ? "Übernehmen" : "Anlegen" }}
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
    {{-- create a new tournament, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <x-confirmation-button wire:click="create()">
            Anlegen
        </x-confirmation-button>
    </div>
</div>
