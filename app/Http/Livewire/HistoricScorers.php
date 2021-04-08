<?php

namespace App\Http\Livewire;

use App\Models\Date;
use App\Models\Player;
use Livewire\Component;

class HistoricScorers extends Component
{
    public $header = 'Ewige Scorer';
    public $scorers;
    public $sortField = "scorer_points";
    public $sortDirection = 'desc';
    public $first_assist;
    public $first_goal;

    public function mount()
    {
        $this->first_goal = Date::whereHas('match.goals')->orderBy('datetime')->first()->datetime;
        $this->first_assist = Date::whereHas('match.goals.assist')->orderBy('datetime')->first()->datetime;
    }

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
        // get all players with at least one goal or one assist, add counts
        $this->scorers = Player::whereHas('goals')->orWhereHas('assists')->withCount(['goals', 'assists'])->get();

        // sum counts for sorting
        $this->scorers = $this->scorers->map(function ($player) {
            $player->scorer_points = $player->goals_count + $player->assists_count;

            return $player;
        });

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

        return view('livewire.historic-scorers')->layout('layouts.app', ['header' => $this->header]);
    }
}
