<div class="flex justify-center space-x-2">
    <x-button wire:click="$dispatch('editTableEntry', [{{ $id }}])">
        <i class="far fa-edit fa-fw" title="Bearbeiten"></i>
    </x-button>
    <x-button wire:click="$dispatch('deleteTableEntry', [{{ $id }}])">
        <i class="far fa-trash-alt fa-fw text-red-500" title="Löschen"></i>
    </x-button>
</div>
