<div>
@include('admin.includes.alert')

<!-- delete confirmation -->
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            Torschützenkönig löschen
        </x-slot>
        <x-slot name="content">
            Möchten Sie diesen Torschützenkönig wirklich löschen?
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-button>
            <x-delete-button wire:click="destroy()">
                Löschen
            </x-delete-button>
        </x-slot>
    </x-jet-confirmation-modal>
    <!-- create or maintain modal -->
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Torschützenkönig
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="mb-6 flex items-center space-x-4">
                    <div>
                        <x-jet-label class="" for="season_id">
                            Saison
                        </x-jet-label>
                        <x-select id="season_id" wire:model="season_id" class="" autocomplete="off">
                            <option selected="selected" value="" disabled>Bitte auswählen</option>
                            @foreach($seasons as $season)
                                <option value="{{ $season->id }}">{{ $season->is_ah_season ? "(AH)" : "(HLW)" }}{{ $season->title }}</option>
                            @endforeach
                        </x-select>
                        <x-jet-input-error for="season_id" />
                    </div>
                    <div>
                        <x-jet-label class="" for="player_id">
                            Spieler
                        </x-jet-label>
                        <x-select id="player_id" wire:model="player_id" class="" autocomplete="off">
                            <option selected="selected" value="" disabled>Bitte auswählen</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">({{ $player->id }}) {{ $player->full_name }}</option>
                            @endforeach
                        </x-select>
                        <x-jet-input-error for="match.player_id" />
                    </div>
                </div>

            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <x-jet-validation-errors />
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" class="w-full justify-center" >
                            Speichern
                        </x-confirmation-button>
                    </span>
                    <span class="flex w-full sm:w-auto">
                        <x-button wire:click="closeModal()" wire:loading.attr="disabled" class="w-full justify-center">
                            Abbrechen
                        </x-button>
                    </span>
                </div>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
    {{-- create a new date, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <x-confirmation-button wire:click="create()">
            Anlegen
        </x-confirmation-button>
    </div>
</div>
