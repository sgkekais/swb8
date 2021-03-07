@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-sans font-extrabold text-xl tracking-tighter ']) }}>
    {{ $value ?? $slot }}
</label>
