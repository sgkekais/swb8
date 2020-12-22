@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-400 text-sm font-bold leading-5 uppercase text-gray-800 focus:outline-none focus:border-lime-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 uppercase text-gray-500 hover:text-gray-900 hover:border-lime-300 focus:outline-none focus:text-gray-900 focus:border-lime-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
