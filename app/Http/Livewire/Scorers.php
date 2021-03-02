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
    public $header = 'Tore & Assists';
    public ?Club $club = null;
    public $selectable_seasons = [];
    public ?Season $season = null;
    public $selected_season = "";
    public $scorers = [];
    public $sortField = "scorer_points";
    public $sortDirection = 'desc';

    public function mount(Club $club)
    {
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
            $scorer->scorer_points = $scorer->total_goals + $scorer->total_assists;
        }
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
