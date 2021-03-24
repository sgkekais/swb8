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
            ->orderByDesc('datetime')
            ->with('match', 'match.teamHome', 'match.teamAway', 'match.goals', 'match.cards')
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontpage.last-games');
    }
}
