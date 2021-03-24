<div class="w-full">
    Im {{ \Carbon\Carbon::now()->isoFormat('MMMM') }} haben Geburtstag:
    <div class="flex flex-col w-full">
        @foreach ($players as $player)
            <div class="flex w-full">
                <div class="w-1/5">
                    @if ($player->dob->isoFormat('D.M.') == \Carbon\Carbon::now()->isoFormat('D.M.'))
                        <span class="animate-ping absolute">&#127874;</span>
                        <span class="relative">&#127874;</span>
                    @else
                        {{ $player->dob->isoFormat('D.M.') }}
                    @endif
                </div>
                <div class="w-full">
                    {{ $player->name_short }}
                    ({{ $player->dob->isoFormat('D') > \Carbon\Carbon::today()->isoFormat('D') ? ("wird ".($player->dob->diffInYears() + 1)) : $player->dob->diffinYears() }})
                </div>
            </div>
        @endforeach
    </div>
</div>
