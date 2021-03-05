<div>
    Im {{ \Carbon\Carbon::now()->isoFormat('MMMM') }} haben Geburtstag:
    <div class="flex flex-col">
        @foreach ($players as $player)
            <div class="flex space-x-2">
                <div class="">
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
                     (wird {{ $player->dob->diffInYears() + 1 }})
                </div>
            </div>
        @endforeach
    </div>
</div>
