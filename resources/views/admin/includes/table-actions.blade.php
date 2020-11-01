<div>
    <div class="flex justify-center space-x-2">
        <span class="block ml-2 shadow rounded-md">
            <button wire:click="$emit('editTableEntry', {{ $id }})" class="btn btn-blue p-2 sm:px-4 sm:py-2">
                <i class="far fa-edit fa-fw" title="Bearbeiten"></i>
            </button>
        </span>
        <span class="block shadow rounded-md">
            <button wire:click="$emit('deleteTableEntry', {{ $id }})" class="btn btn-red p-2 sm:px-4 sm:py-2">
                <i class="far fa-trash-alt fa-fw" title="Löschen"></i>
            </button>
        </span>
    </div>
</div>
