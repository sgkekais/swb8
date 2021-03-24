<div {{ $attributes->merge(['class' => '']) }}>

    <div class="px-2 max-w-7xl mx-auto {{ $attributes->get('slot-class') }}" >
        {{ $slot }}
    </div>

</div>
