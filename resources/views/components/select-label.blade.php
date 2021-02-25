@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-sans font-extrabold text-xl tracking-tighter text-primary-600']) }}>
    {{ $value ?? $slot }}
</label>
