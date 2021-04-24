@props(
    ['initialValue' => '']
)

<div
    wire:ignore
    {{ $attributes }}
    x-data
    @trix-blur = "$dispatch('change', $event.target.value)"
>
    <input id="x" value="{{ $initialValue }}" type="hidden">
    <trix-editor input="x" class=""></trix-editor>
</div>


