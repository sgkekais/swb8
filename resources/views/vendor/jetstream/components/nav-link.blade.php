@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-400 text-sm md:text-base font-bold leading-5 uppercase text-white focus:outline-none focus:border-primary-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 text-sm md:text-base font-bold leading-5 uppercase text-gray-100 hover:text-white hover:border-primary-300 focus:outline-none focus:text-gray-100 focus:border-primary-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
