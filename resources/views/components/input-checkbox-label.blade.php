@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold uppercase tracking-wide text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
