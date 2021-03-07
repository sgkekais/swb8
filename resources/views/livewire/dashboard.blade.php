<div>
    Termine, an deren Umfragen du teilgenommen hast
    <x-main-box>
        <x-slot name="header">
            Anstehend
        </x-slot>
        <ul class="list-disc">
        @foreach ($future_dates as $future_date)
            <li>{{ $future_date }}</li>
        @endforeach
        </ul>
    </x-main-box>
    <x-main-box>
        <x-slot name="header">
            Zurückliegend
        </x-slot>
        <ul class="list-disc">
            @foreach ($past_dates as $past_date)
                <li>{{ $past_date }}</li>
            @endforeach
        </ul>
    </x-main-box>
</div>
