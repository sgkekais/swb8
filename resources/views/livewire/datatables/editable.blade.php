@assets
    <script src="{{ route('livewire-datatables.editable-script') }}" defer></script>
@endassets

<div x-data="livewireDatatableEditable"
    data-row-id="{{ $rowId }}"
    data-column="{{ $column }}"
    wire:key="{{ $rowId }}_{{ $column }}">
    <button class="w-full text-left hover:bg-blue-200 px-2 py-1 rounded focus:outline-none"
        x-bind:class="editedClass"
        x-show="notEditing"
        x-on:click="startEditing">{!! filled($value) ? htmlspecialchars($value) : '&nbsp;' !!}</button>
    <span x-cloak x-show="edit" style="display: none">
        <input class="w-full border border-blue-400 px-2 py-1 rounded focus:outline-none focus:border" x-ref="input" value="{!! htmlspecialchars($value) !!}"
            wire:change="edited($event.target.value, '{{ $columnIndex }}', '{{ $rowId }}')"
            x-on:click.away="stopEditing" x-on:blur="stopEditing" x-on:keydown.enter="stopEditing" />
    </span>
    @error("editable.{$rowId}.{$column}")
        <span class="mt-1 block text-xs text-red-600" role="alert">{{ $message }}</span>
    @enderror
</div>
