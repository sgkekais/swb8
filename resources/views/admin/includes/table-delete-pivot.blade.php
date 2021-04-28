<div>
    <x-button wire:click="$emit('deleteTableEntry', {{ $season_id }}, {{ $player_id }})">
        <i class="far fa-trash-alt fa-fw text-red-500" title="Löschen"></i>
    </x-button>
</div>
