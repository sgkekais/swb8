@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block px-4 py-2 text-sm leading-5 tracking-tight text-primary-900 font-bold bg-primary-200 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
                : 'block px-4 py-2 text-sm leading-5 tracking-tight text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
