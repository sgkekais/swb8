<div>
    @include('admin.includes.alert')

    {{-- delete confirmation --}}
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            Spieler {{ $player->id }} löschen
        </x-slot>
        <x-slot name="content">
            Möchten Sie den Spieler wirklich löschen?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy({{ $player->id }})">
                Löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- create or maintain modal --}}
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Spieler {{ $player->id ? $player->id." ändern" : "anlegen" }}
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="flex mb-6 space-x-2">
                    <div class="">
                        <x-jet-label class="" for="player_status">
                            Spieler-Status
                        </x-jet-label>
                        <select id="player_status" wire:model="player.player_status_id" class="shadow-sm" autocomplete="off">
                            <option selected="selected" value="">Bitte auswählen</option>
                            @foreach($player_statuses as $player_status)
                                <option value="{{ $player_status->id }}">({{ $player_status->id }}) - {{ $player_status->description }}</option>
                            @endforeach
                        </select>
                        @if ($player->player_status_id)
                            @if ($player->playerStatus->can_play)
                                <span class="text-green-700">Kann spielen.</span>
                            @else
                                <span class="text-yellow-700">Kann nicht spielen.</span>
                            @endif
                        @endif
                    </div>
                    <div class="">
                        <x-jet-label class="" for="user_id">
                            User
                        </x-jet-label>
                        <select id="user_id" wire:model="player.user_id" class="shadow-sm" autocomplete="off">
                            <option selected="selected" value="">Mit User verknüpfen?</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">({{ $user->id }}) - {{ $user->email }} - {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-6">
                    <x-jet-label for="first_name" class="flex justify-between">
                        Vorname <i class="fas fa-fw fa-asterisk text-xs text-red-400"></i>
                    </x-jet-label>
                    <x-jet-input class="w-full" type="text" id="first_name" wire:model.defer="player.first_name" placeholder="" required />
                    <x-jet-input-error for="player.first_name" />
                </div>
                <div class="mb-6">
                    <x-jet-label for="last_name" class="flex justify-between">
                        Nachname
                    </x-jet-label>
                    <x-jet-input class="w-full" type="text" id="last_name" wire:model.defer="player.last_name" placeholder=""/>
                    <x-jet-input-error for="player.last_name" />
                </div>
                <div class="mb-6">
                    <x-jet-label for="nickname" class="flex justify-between">
                        Spitzname
                    </x-jet-label>
                    <x-jet-input class="w-full" type="text" id="nickname" wire:model.defer="player.nickname" placeholder=""/>
                    <x-jet-input-error for="player.nickname" />
                </div>
                <div class="mb-6 flex">
                    <div>
                        <x-jet-label for="dob" class="flex justify-between">
                            Geburtsdatum
                        </x-jet-label>
                        <x-jet-input class="w-full" type="date" id="dob" wire:model.defer="player.dob" placeholder=""/>
                        <x-jet-input-error for="player.dob" />
                    </div>
                </div>
                <div class="mb-6 flex space-x-2">
                    <div>
                        <x-jet-label for="joined" class="flex justify-between">
                            Eintritt
                        </x-jet-label>
                        <x-jet-input class="w-full" type="date" id="joined" wire:model.defer="player.joined" placeholder=""/>
                        <x-jet-input-error for="player.joined" />
                    </div>
                    <div>
                        <x-jet-label for="left" class="flex justify-between">
                            Austritt
                        </x-jet-label>
                        <x-jet-input class="w-full" type="date" id="left" wire:model.defer="player.left" placeholder=""/>
                        <x-jet-input-error for="player.left" />
                    </div>
                </div>
                <div class="mb-6 flex space-x-2">
                    <div class="w-1/2">
                        <x-jet-label for="public_note" class="flex justify-between">
                            Öffentl. Notiz (für alle sichtbar)
                        </x-jet-label>
                        <textarea id="public_note" class="form-textarea w-full shadow-sm" wire:model.defer="player.public_note">

                        </textarea>
                        <x-jet-input-error for="player.public_note" />
                    </div>
                    <div class="w-1/2">
                        <x-jet-label for="internal_note" class="flex justify-between">
                            Interne Notiz (nur Admins)
                        </x-jet-label>
                        <textarea id="internal_note" class="form-textarea w-full shadow-sm" wire:model.defer="player.internal_note">

                        </textarea>
                        <x-jet-input-error for="player.internal_note" />
                    </div>
                </div>
                <div class="mb-6 flex items-center space-x-2">
                    <x-input-checkbox name="is_public" id="is_public" wire:model="player.is_public" />
                    <x-input-checkbox-label for="is_public">
                        Öffentlich sichtbar?
                    </x-input-checkbox-label>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" >
                            {{ $player->id ? "Übernehmen" : "Anlegen" }}
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
    {{-- create a new player, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <x-confirmation-button wire:click="create()">
            Anlegen
        </x-confirmation-button>
    </div>


</div>
