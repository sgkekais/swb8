<?php

namespace App\Http\Livewire;

use App\Models\Player;
use Livewire\Component;

class HallOfFameScorerKings extends Component
{

    public $scorer_kings;
    public $sortField = "scorer_titles_count";
    public $sortDirection = 'desc';

    public function mount()
    {

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
        $this->scorer_kings = Player::whereHas('scorerTitles')->with('scorerTitles')->withCount('scorerTitles')->get();

        $this->scorer_kings = $this->scorer_kings->map(function ($player) {
            $player->total_hlw_titles = $player->scorerTitles->where('is_ah_season', false)->count();
            $player->total_ah_titles = $player->scorerTitles->where('is_ah_season', true)->count();

            return $player;
        });

        // sort the collection
        if ($this->sortDirection === 'asc')
        {
            $this->scorer_kings = $this->scorer_kings->sortBy([
                [$this->sortField, 'asc'],
                ['full_name_short', 'asc']
            ]);
        } elseif ($this->sortDirection === 'desc') {
            $this->scorer_kings = $this->scorer_kings->sortBy([
                [$this->sortField, 'desc'],
                ['full_name_short', 'asc']
            ]);
        }

        return view('livewire.hall-of-fame-scorer-kings');
    }
}
