<div>
    @include('admin.includes.alert')

    {{-- delete confirmation --}}
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            User {{ $user->id }} löschen
        </x-slot>
        <x-slot name="content">
            Möchten Sie den User wirklich löschen?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy({{ $user->id }})">
                Löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- create or maintain modal --}}
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                User {{ $user->id ? $user->id." ändern" : "anlegen" }}
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="mb-6">
                    <x-jet-label for="name" class="flex justify-between">
                        Name <i class="fas fa-fw fa-asterisk text-xs text-red-400"></i>
                    </x-jet-label>
                    <x-input-text class="w-full" type="text" id="name" wire:model.defer="user.name" placeholder="" required />
                    <x-jet-input-error for="user.name" />
                </div>
                <div class="mb-6">
                    <x-jet-label for="email" class="flex justify-between">
                        E-Mail <i class="fas fa-fw fa-asterisk text-xs text-red-400"></i>
                    </x-jet-label>
                    <x-input-text class="w-full" type="text" id="email" wire:model.defer="user.email" placeholder=""/>
                    <x-jet-input-error for="user.email" />
                </div>
                <div class="mb-6">
                    <x-jet-label for="password" class="flex justify-between">
                        Passwort <i class="fas fa-fw fa-asterisk text-xs text-red-400"></i>
                    </x-jet-label>
                    <x-input-text class="w-full" type="text" id="password" wire:model.defer="user.password" placeholder=""/>
                    <x-jet-input-error for="user.password" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-confirmation-button wire:click.prevent="store()" >
                            {{ $user->id ? "Übernehmen" : "Anlegen" }}
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
    {{-- create a new user, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <x-confirmation-button wire:click="create()">
            Anlegen
        </x-confirmation-button>
    </div>

</div>
