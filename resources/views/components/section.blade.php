<div {{ $attributes->merge(['class' => 'py-4']) }}>

    <div class="px-2 max-w-7xl mx-auto {{ $attributes->get('slot-class') }}" >
        {{ $slot }}
    </div>

</div>
