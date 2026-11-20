@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-2 font-bold uppercase tracking-wide text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
