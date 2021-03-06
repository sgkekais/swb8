<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Date;
use App\Models\Player;
use App\Models\Season;
use Livewire\Component;

class Scorers extends Component
{
    public $header = 'Tore & Assists';
    public ?Club $club = null;
    public $selectable_seasons = [];
    public ?Season $season = null;
    public $selected_season = "";
    public $scorers = [];
    public $sortField = "scorer_points";
    public $sortDirection = 'desc';
    public $first_assist;
    public $first_goal;

    public function mount(Club $club)
    {
        $this->first_goal = Date::whereHas('match.goals')->orderBy('datetime')->first()->datetime;
        $this->first_assist = Date::whereHas('match.goals.assist')->orderBy('datetime')->first()->datetime;

        $this->club = $club;
        $this->selectable_seasons = $this->club->seasons()->orderBy('number', 'desc')->get();
        if (!$this->selectable_seasons->isEmpty())
        {
            $this->selected_season = $this->selectable_seasons->first()->id;
        }
    }

    protected $rules =  [
        'selected_season' => 'string'
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'desc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        $this->season = Season::find($this->selected_season);

        $this->scorers = $this->season->scorers();

        // sort the collection
        if ($this->sortDirection === 'asc')
        {
            $this->scorers = $this->scorers->sortBy([
                [$this->sortField, 'asc'],
                ['full_name_short', 'asc']
            ]);
        } elseif ($this->sortDirection === 'desc') {
            $this->scorers = $this->scorers->sortBy([
                [$this->sortField, 'desc'],
                ['full_name_short', 'asc']
            ]);
        }

        return view('livewire.scorers')->layout('layouts.app', ['header' => $this->header]);
    }
}
