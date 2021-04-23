<div>
    @if (isset($header))
        <div class="px-2 pb-2 font-sans font-extrabold text-2xl tracking-tighter">
            {{ $header }}
        </div>
    @endif
    <div class="relative">
        <div class="absolute {{ $attributes->get('shadow-color') }} top-0.5 -right-0.5 -bottom-0.5 left-0.5" style="transform-origin: 50% 50% 0px;border-radius: 0%;"></div>
        <div {{ $attributes->merge(['class' => 'relative w-full bg-white border border-black']) }}>
            {{ $slot }}
        </div>
    </div>
</div>
