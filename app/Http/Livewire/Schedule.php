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
        $this->matches->load('date','teamHome', 'teamAway')->sortBy('date.datetime');

        return view('livewire.schedule')->layout('layouts.app', ['header' => $this->header]);
    }
}
