<?php

namespace App\Http\Livewire;

use App\Models\Assist;
use App\Models\Club;
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
        if ($this->selectable_seasons->count() > 0)
        {
            $this->selected_season = $this->selectable_seasons->first()->id;
        }
    }

    protected $rules =  [
        'selected_season' => 'string'
    ];

    public function render()
    {
        $this->season = Season::find($this->selected_season)->load('goals.player')->loadCount('goals');
        $this->goals = $this->season->goals->load('match.matchType');

        // TODO: neue scrorer tabelle

        // fill scorers
        $this->scorers = collect();
        foreach ($this->goals->groupBy('player.id') as $player_id => $player_goals)
        {
            $player = Player::find($player_id);
            $player->goals_total = $player_goals->count();
            $player->player_goals = $player_goals;
            $this->scorers->push($player);
        }
        $this->scorers = $this->scorers->sortByDesc([['goals_total', 'desc'],['nickname', 'asc']]);

        // fill assists
        $this->assists = Assist::with('goal.match.season', 'player')->get()->where('goal.match.season.id', $this->selected_season);
        $this->season->assists_count = $this->assists->count();
        $this->assist_players = collect();
        foreach ($this->assists->groupBy('player.id') as $player_id => $player_assists)
        {
            $player = Player::find($player_id);
            $player->assists_total = $player_assists->count();
            $player->player_assists = $player_assists;
            $this->assist_players->push($player);
        }
        $this->assist_players = $this->assist_players->sortByDesc([['assists_total', 'desc'],['nickname', 'asc']]);

        return view('livewire.scorers')->layout('layouts.app', ['header' => $this->header]);
    }
}
