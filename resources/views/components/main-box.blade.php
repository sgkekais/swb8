<div>
    <div>
        {{ $header }}
    </div>
    <div {{ $attributes->merge(['class' => '']) }}>
        {{ $slot }}
    </div>
</div>
