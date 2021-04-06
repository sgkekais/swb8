<?php

namespace App\Http\Livewire\Frontpage;

use App\Models\Date;
use Carbon\Carbon;
use Livewire\Component;

class LastGames extends Component
{
    public $last_dates;
    public $today;

    public function mount()
    {
        $this->today = Carbon::today();
        $this->last_dates = Date::where('date_type_id',2)
            ->where('datetime','<', Carbon::now())
            ->whereHas('match', function ($q) {
                $q->playedOrRated();
            })
            ->orderByDesc('datetime')
            ->with('location', 'match', 'match.matchType', 'match.teamHome', 'match.teamAway', 'match.goals.player', 'match.goals.assist.player', 'match.cards.player')
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontpage.last-games');
    }
}
