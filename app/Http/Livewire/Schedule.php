<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Season;
use Carbon\Carbon;
use Livewire\Component;

class Schedule extends Component
{
    public $header = "Spielplan";

    public ?Club $club = null;
    public $seasons = [];
    public $selected_season = "";
    public $matches = [];
    public $today = null;
    public $stat_count_wins = 0;
    public $stat_count_losses = 0;
    public $stat_count_draws = 0;
    public $stat_count_goals = 0;
    public $stat_count_cards = 0;

    public function mount(Club $club)
    {
        $this->club = $club;
        $this->seasons = Season::AHSeason($this->club->ah)->orderBy('number', 'desc')->get();
        if ($this->seasons->count() > 0)
        {
            $this->selected_season = $this->seasons->first()->id;
        }
        $this->today = Carbon::now();
    }

    protected $rules =  [
        'selected_season' => 'string'
    ];

    public function render()
    {
        $this->matches = $this->club->matches()->where('season_id',$this->selected_season);
        $this->matches->load('date', 'date.location', 'matchType', 'teamHome', 'teamAway', 'goals.player', 'goals.assist.player', 'cards.player')
            ->sortBy('date.datetime');

        // calculate stats
        foreach ($this->matches as $match)
        {
            if ($match->isWon())
            {
                $this->stat_count_wins++;
            }
            if ($match->isLost())
            {
                $this->stat_count_losses++;
            }
            if ($match->isDraw())
            {
                $this->stat_count_draws++;
            }
            $this->stat_count_goals += $match->goals()->count();
            $this->stat_count_cards += $match->cards()->count();
        }

        return view('livewire.schedule')->layout('layouts.app', ['header' => $this->header]);
    }
}
