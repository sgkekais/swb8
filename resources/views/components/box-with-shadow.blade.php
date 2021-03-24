<div>
    @if (isset($header))
        <div class="px-2 pb-2 font-sans font-extrabold text-2xl tracking-tighter">
            {{ $header }}
        </div>
    @endif
    <div {{ $attributes->merge(['class' => 'relative']) }}>
        <div class="absolute bg-gray-600 top-0.5 -right-0.5 -bottom-0.5 left-0.5" style="transform-origin: 50% 50% 0px;border-radius: 0%;"></div>
        <div class="relative w-full p-2 bg-white border border-black">
            {{ $slot }}
        </div>
    </div>
</div>
