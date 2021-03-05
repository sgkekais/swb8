<div>
    <div class="p-2 font-sans font-extrabold text-2xl tracking-tighter">
        {{ $header }}
    </div>
    <div {{ $attributes->merge(['class' => 'relative']) }}>
        <div class="absolute bg-gray-600 top-0.5 -right-0.5 -bottom-0.5 left-0.5" style="transform-origin: 50% 50% 0px;border-radius: 0%;"></div>
        <div class="relative w-full inline-flex items-center px-4 py-2 bg-white border border-black">
            {{ $slot }}
        </div>
    </div>
</div>
