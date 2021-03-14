<div>
    <div class="p-2 font-sans font-extrabold text-2xl tracking-tighter">
        {{ $header }}
    </div>
    <div {{ $attributes->merge(['class' => '']) }}>
        {{ $slot }}
    </div>
</div>
