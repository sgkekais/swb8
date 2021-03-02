@props([
    'direction' => null,
    'selectable' => false,
])

@php
    $clickable = $selectable ? "cursor-pointer" : null;
@endphp

<div {{ $attributes->merge(['class' => 'table-cell font-bold '.$clickable.'']) }}>
    {{ $slot }}
    @if ($selectable)
        @if ($direction == 'asc')
            <i class="fa fa-caret-up text-primary-600"></i>
        @elseif ($direction == 'desc')
            <i class="fa fa-caret-down text-primary-600"></i>
        @endif
    @endif
</div>
