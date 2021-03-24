<select {{ $attributes->merge(['class' => 'focus:ring-primary-700 focus:border-primary-700']) }}>
    {{ $slot }}
</select>
