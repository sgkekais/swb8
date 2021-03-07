<div class="relative">
    <div class="absolute bg-black top-0.5 -right-0.5 -bottom-0.5 left-0.5"></div>
    <button {{ $attributes->merge(['class' => 'relative inline-flex items-center px-4 py-2 bg-primary-600 border border-primary-900 text-sm font-bold text-white uppercase tracking-widest hover:bg-primary-700 disabled:opacity-25 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
</div>
