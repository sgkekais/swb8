@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-primary-700 text-sm md:text-base font-bold leading-5 uppercase text-white focus:outline-none focus:border-black transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-4 text-sm md:text-base font-bold leading-5 uppercase text-gray-100 hover:text-gray-200 hover:border-black focus:outline-none focus:text-gray-200 focus:border-black transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
