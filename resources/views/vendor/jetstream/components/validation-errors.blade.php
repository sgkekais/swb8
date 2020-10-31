@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-500">{{ __('Ups! Etwas ist schief gelaufen.') }}</div>

        <ul class="mt-3 list-inside text-sm text-red-500">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
