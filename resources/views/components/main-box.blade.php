<div>
    @if (isset($header))
        <div>
            {{ $header }}
        </div>
    @endif
    <div {{ $attributes->merge(['class' => '']) }}>
        {{ $slot }}
    </div>
</div>
