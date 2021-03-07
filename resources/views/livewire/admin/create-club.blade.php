<div>
    @include('admin.includes.alert')

    {{-- delete confirmation --}}
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
    {{-- create or maintain modal --}}
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Mannschaft {{ $club->id ? $club->id." ändern" : "anlegen" }}
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="mb-6">
                    <x-jet-label for="club.name" class="flex justify-between">
                        Name <i class="fas fa-fw fa-asterisk text-xs text-red-400"></i>
                    </x-jet-label>
                    <x-jet-input class="w-full" type="text" id="club.name" wire:model.defer="club.name" placeholder="Schwarz-Weiß Bilk '79" required />
                    <x-jet-input-error for="club.name" />
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-jet-label for="club.name_short" value="Name - kurz" />
                        <x-jet-input class="w-full" type="text" id="club.name_short" wire:model.defer="club.name_short" placeholder="SW Bilk" maxlength="15" />
                        <x-jet-input-error for="club.name_short" />
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <x-jet-label for="club.name_code" value="Name - kurz" />
                        <x-jet-input class="w-full" type="text" id="club.name_code" wire:model.defer="club.name_code" placeholder="SWB" maxlength="4" />
                        <x-jet-input-error for="club.name_code" />
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex">
                        <div>
                            @if ($club_logo)
                                <img src="{{ $club_logo->temporaryUrl() }}" />
                            @elseif ($club->logo_url)
                                <img src="{{ $club->logo() }}" />
                            @endif
                        </div>
                        <div>
                            <x-jet-label for="club_logo" value="Logo-URL" />
                            <input type="file" wire:model="club_logo">

                            <x-jet-input-error for="club_logo" />
                        </div>
                    </div>

                </div>
                <div class="mb-6 flex justify-start space-x-2">
                    <div class="flex items-center space-x-2">
                        <x-input-checkbox wire:model="club.owner" id="owner" />
                        <x-input-checkbox-label for="owner">
                            Besitzer?
                        </x-input-checkbox-label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-input-checkbox wire:model="club.ah" id="ah" />
                        <x-input-checkbox-label for="ah">
                            Altherren-Team?
                        </x-input-checkbox-label>
                    </div>
                </div>
                @if ($club->owner)
                    <div class="mb-6">
                        <div class="">Spieler zuordnen</div>
                        @foreach($all_players as $player)
                            <div class="flex items-center space-x-3">
                                <x-input-checkbox
                                    wire:key="{{ $player->id }}"
                                    wire:model="selected_players"
                                    name="player_{{ $player->id }}"
                                    value="{{ $player->id }}" />
                                <x-input-checkbox-label for="player_{{ $player->id }}" class="w-1/3">
                                    {{ $player->first_name.", ".$player->last_name }}
                                </x-input-checkbox-label>
                                <div class="">
                                    {{ $player->playerStatus->description }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" class="" >
                            {{ $club->id ? "Übernehmen" : "Anlegen" }}
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
    {{-- create a new club, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <x-confirmation-button wire:click="create()">
            Anlegen
        </x-confirmation-button>
    </div>


</div>
