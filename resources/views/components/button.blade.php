<div class="relative">
    <div class="absolute bg-primary-600 top-0.5 -right-0.5 -bottom-0.5 left-0.5" style="transform-origin: 50% 50% 0px;border-radius: 0%;"></div>
    <button {{ $attributes->merge(['class' => 'relative inline-flex items-center px-4 py-2 bg-white border border-black text-sm font-bold text-black uppercase tracking-widest hover:bg-gray-100 disabled:opacity-25 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
</div>
