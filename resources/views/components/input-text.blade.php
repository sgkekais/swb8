@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mt-1 focus:ring-primary-500 focus:border-primary-600 block sm:text-sm border-gray-500']) !!}>
