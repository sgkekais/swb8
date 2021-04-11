<?php

namespace App\Http\Livewire\Frontpage;

use App\Models\Club;
use App\Models\Date;
use Carbon\Carbon;
use Livewire\Component;

class FeverCurve extends Component
{
    public $club;
    public $today;
    public $last_dates;
    public $x_labels;

    public function mount(Club $club)
    {
        $this->club = $club;
        $this->today = Carbon::today();
        $this->last_dates = Date::where('date_type_id',2)
            ->where('datetime','<', Carbon::now())
            ->whereHas('match', function ($q) {
                $q->cancelled(false)->playedOrRated()->where( function ($query) {
                   $query->where('team_home', $this->club->id)->orWhere('team_away', $this->club->id);
                });
            })
            ->orderByDesc('datetime')
            ->with('match', 'match.teamHome', 'match.teamAway')
            ->take(10)
            ->get()
            ->sortBy('datetime');

        $this->last_dates->map(function ($date){
            $date->fever_value = ($date->match->isWon() ? 2 : ($date->match->isDraw() ? 1 : 0));
        });

        $this->x_labels = $this->last_dates->pluck('datetime')->map(function ($date){
            $date = $date->isoFormat('DD.MM.YY');
            return $date;
        });

    }

    // Match::where('match_type_id',2)->whereHas('season',11)->pluck('matchweek')

    public function render()
    {
        return view('livewire.frontpage.fever-curve');
    }
}
