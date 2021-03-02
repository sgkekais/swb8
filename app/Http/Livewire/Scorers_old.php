<?php

namespace App\Http\Livewire;

use App\Models\Assist;
use App\Models\Club;
use App\Models\Goal;
use App\Models\Player;
use App\Models\Season;
use Livewire\Component;

class Scorers extends Component
{
    public $header = "Tore & Assists";
    public ?Club $club = null;
    public $selectable_seasons = [];
    public ?Season $season = null;
    public $selected_season = "";
    public $goals = [];
    public $scorers = [];
    public $assists = [];
    public $assist_players = [];

    public function mount(Club $club)
    {
        $this->club = $club;
        // $this->selectable_seasons = Season::AHSeason($this->club->ah)->orderBy('number', 'desc')->get();
        $this->selectable_seasons = $this->club->seasons()->orderBy('number', 'desc')->get();
        if (!$this->selectable_seasons->isEmpty())
        {
            $this->selected_season = $this->selectable_seasons->first()->id;
        }
    }

    protected $rules =  [
        'selected_season' => 'string'
    ];

    public function render()
    {
        $this->season = Season::find($this->selected_season);
        // $this->goals = Goal::with('match.season')->has('match.season',$this->season->id)->get() ;
        // $this->goals = $this->season->goals->load('player', 'assist', 'match.MatchType');
        // $this->assists = Assist::with('goal.match.season', 'player')->get()->where('goal.match.season.id', $this->selected_season);
        // $this->assists = $this->goals->pluck('assist')->filter()->flatten();

        /**
         * $scorers of a season
         * $scorers = Player::whereHas('goals.match.season', function ($query) { $query->where('id',11) }->get();
         * $player->goals->where('match.season.id',11)
         */

        $this->scorers = Player::whereHas('goals.match.season', function ($query) {
            return $query->where('id', $this->selected_season);
        })->orWhereHas('assists.goal.match.season', function ($query) {
            return $query->where('id', $this->selected_season);
        })->with('goals.match.season', 'assists.goal.match.season')->get();

        // fill scorers with goals, assists and respective totals for sorting
        foreach ($this->scorers as $scorer)
        {
            $scorer->total_goals = $scorer->goals->where('match.season.id', $this->selected_season)->count();
            $scorer->goals = $scorer->goals->where('match.season.id', $this->selected_season);
            $scorer->total_assists = $scorer->assists->where('goal.match.season.id', $this->selected_season)->count();
            $scorer->assists = $scorer->assists->where('goal.match.season.id', $this->selected_season);
        }

        // dd($this->scorers->sum('total_goals'));

       /*
        // fill scorers
        $this->scorers = collect();
        if (!$this->assists->isEmpty()) {
            foreach ($this->goals->groupBy('player.id') as $player_id => $player_goals) {
                $player = Player::find($player_id);
                $player->goals_total = $player_goals->count();
                $player->player_goals = $player_goals;
                $this->scorers->push($player);
            }
        }
        $this->scorers = $this->scorers->sortByDesc([['goals_total', 'desc'],['nickname', 'asc']]);

        // fill assists
        $this->season->assists_count = $this->assists->count();
        $this->assist_players = collect();
        if (!$this->assists->isEmpty())
        {
            foreach ($this->assists->groupBy('player.id') as $player_id => $player_assists)
            {
                $player = Player::find($player_id);
                $player->assists_total = $player_assists->count();
                $player->player_assists = $player_assists;
                $this->assist_players->push($player);
            }
        }
        $this->assist_players = $this->assist_players->sortByDesc([['assists_total', 'desc'],['nickname', 'asc']]);*/
        return view('livewire.scorers')->layout('layouts.app', ['header' => $this->header]);
    }
}
