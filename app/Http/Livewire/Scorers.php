<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Season;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Scorers extends Component
{
    public $header = "Tore & Assists";
    public ?Club $club = null;
    public $seasons = [];
    public $selected_season = "";
    public $scorers = [];

    public function mount(Club $club)
    {
        $this->club = $club;
        $this->seasons = Season::AHSeason($this->club->ah)->orderBy('number', 'desc')->get();
        if ($this->seasons->count() > 0)
        {
            $this->selected_season = $this->seasons->first()->id;
        }
    }

    protected $rules =  [
        'selected_season' => 'string'
    ];

    public function render()
    {
        $this->scorers = DB::table('goals')
                            ->select('player_id', DB::raw('COUNT(*) as goals_count'))
                            ->join('matches','goals.match_id', '=', 'matches.id')
                            ->where('matches.season_id','=', $this->selected_season)
                            ->groupBy('player_id')
                            ->get();

        return view('livewire.scorers')->layout('layouts.app', ['header' => $this->header]);
    }
}
