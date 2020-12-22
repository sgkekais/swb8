<div>
    <div class="flex justify-center space-x-2">
        <span class="block ml-2 shadow rounded-md">
            <x-button wire:click="$emit('editTableEntry', {{ $id }})">
                <i class="far fa-edit fa-fw" title="Bearbeiten"></i>
            </x-button>
        </span>
        <span class="block shadow rounded-md">
            <x-button wire:click="$emit('deleteTableEntry', {{ $id }})">
                <i class="far fa-trash-alt fa-fw text-red-500" title="Löschen"></i>
            </x-button>
        </span>
    </div>
</div>
