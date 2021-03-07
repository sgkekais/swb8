<div>
    Im {{ \Carbon\Carbon::now()->isoFormat('MMMM') }} haben Geburtstag:
    <div class="flex flex-col">
        @foreach ($players as $player)
            <div class="flex space-x-2">
                <div class="w-1/5">
                    @if ($player->dob->isoFormat('D.M.') == \Carbon\Carbon::now()->isoFormat('D.M.'))
                        <span class="animate-ping absolute">&#127874;</span>
                        <span class="relative">&#127874;</span>
                    @else
                        {{ $player->dob->isoFormat('D.M.') }}
                    @endif
                </div>
                <div>
                    {{ $player->full_name_short }} {{ $player->nickname ? '('.$player->nickname.')' : null }}
                    <br />
                    <small>({{ $player->dob->isoFormat('D') > \Carbon\Carbon::today()->isoFormat('D') ? ("wird ".($player->dob->diffInYears() + 1)) : $player->dob->diffinYears() }})</small>
                </div>
            </div>
        @endforeach
    </div>
</div>
