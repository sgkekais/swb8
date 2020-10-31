@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold uppercase text-sm text-gray-400']) }}>
    {{ $value ?? $slot }}
</label>
