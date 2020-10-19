<div x-data="{
    edit: false,
    edited: false,
    init() {
        window.livewire.on('fieldEdited', (id) => {
            if (id === '{{ $rowId }}') {
                this.edited = true
                setTimeout(() => {
                    this.edited = false
                }, 5000)
            }
        })
    }
}" x-init="init()" :key="{{ $rowId }}">
    <button class="w-full text-left hover:bg-blue-200 px-2 py-1 rounded focus:outline-none" x-bind:class="{ 'bg-green-100 font-bold text-green-600': edited }" x-show="!edit"
        x-on:click="edit = true; $nextTick(() => { $refs.input.focus() })">{!! $value ?? '&nbsp' !!}
    </button>
    <span x-cloak x-show="edit">
        <input class="w-full border border-blue-400 px-2 py-1 rounded focus:outline-none focus:border" x-ref="input" value="{!! strip_tags($value) !!}"
            wire:change="edited($event.target.value, '{{ $table }}', '{{ $column }}', '{{ $rowId }}')"
            x-on:click.away="edit = false" x-on:blur="edit = false" x-on:keydown.enter="edit = false" />
    </span>
</div>
