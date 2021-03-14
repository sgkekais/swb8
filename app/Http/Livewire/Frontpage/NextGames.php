<?php

namespace App\Http\Livewire\Frontpage;

use App\Models\Club;
use App\Models\Date;
use Carbon\Carbon;
use Livewire\Component;

class NextGames extends Component
{
    public $next_matches;
    public $today;

    public function mount()
    {
        $this->today = Carbon::now();
        $this->owned_teams = Club::owner(true)->get();
        $this->next_matches = collect();
        foreach ($this->owned_teams as $owned_team)
        {
           $this->next_matches->push(Date::with('match', 'match.teamHome', 'match.teamAway')
                ->where('date_type_id',2)
                ->where('datetime','>=', $this->today)
                ->whereHas('match', function ($query) use ($owned_team) {
                    $query->where('team_home', $owned_team->id,)->orWhere('team_away', $owned_team->id);
                })
                ->orderBy('datetime')
                ->first());
        }
        // $this->next_hlw_match = Date::where('date_type_id',2)->where('datetime','>=', Carbon::now())->orderBy('datetime')->with('match', 'match.teamHome', 'match.teamAway')->take(2)->get();
    }

    public function render()
    {
        return view('livewire.frontpage.next-games');
    }
}
