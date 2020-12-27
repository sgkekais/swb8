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
                    <x-jet-label for="club.logo_url" value="Logo-URL" />
                    <x-jet-input class="w-full" type="text" id="club.logo_url" wire:model.defer="club.logo_url" required />
                    <x-jet-input-error for="club.logo_url" />
                </div>
                <div class="mb-6 flex justify-start">
                    <div class="flex items-center mr-3">
                        <input wire:model="club.owner" id="owner" type="checkbox" class="">
                        <label for="owner" class="ml-2 block leading-5 text-gray-900">
                            Besitzer?
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input wire:model="club.ah" id="ah" type="checkbox" class="">
                        <label for="ah" class="ml-2 block leading-5 text-gray-900">
                            Altherren-Team?
                        </label>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="">Spieler zuordnen</div>
                    @foreach($all_players as $player)
                        <div class="flex items-center">
                            <input
                                wire:key="{{ $player->id }}"
                                wire:model="selected_players"
                                name="player_{{ $player->id }}"
                                class="text-primary-300 border border-black"
                                type="checkbox"
                                value="{{ $player->id }}" />
                            <label for="player_{{ $player->id }}" class="ml-2 block leading-5 text-gray-900 w-1/3">
                                {{ $player->first_name.", ".$player->last_name }}
                            </label>
                            <div class="">
                                {{ $player->playerStatus->description }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" class="" >
                            {{ $club->id ? "Übernehmen" : "Anlegen" }}
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
    {{-- create a new club, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <span class="block shadow-xl rounded-md">
            <x-confirmation-button wire:click="create()">
                Anlegen
            </x-confirmation-button>
        </span>
    </div>


</div>
