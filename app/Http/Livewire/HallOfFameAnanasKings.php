<?php

namespace App\Http\Livewire;

use App\Models\Player;
use Livewire\Component;

class HallOfFameAnanasKings extends Component
{

    public $ananas_kings;
    public $sortField = "ananas_titles_count";
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
        $this->ananas_kings = Player::whereHas('ananasTitles')->with('ananasTitles')->withCount('ananasTitles')->get();

        $this->ananas_kings = $this->ananas_kings->map(function ($player) {
            $player->total_hlw_titles = $player->ananasTitles->where('is_ah_season', false)->count();
            $player->total_ah_titles = $player->ananasTitles->where('is_ah_season', true)->count();

            return $player;
        });

        // sort the collection
        if ($this->sortDirection === 'asc')
        {
            $this->ananas_kings = $this->ananas_kings->sortBy([
                [$this->sortField, 'asc'],
                ['full_name_short', 'asc']
            ]);
        } elseif ($this->sortDirection === 'desc') {
            $this->ananas_kings = $this->ananas_kings->sortBy([
                [$this->sortField, 'desc'],
                ['full_name_short', 'asc']
            ]);
        }

        return view('livewire.hall-of-fame-ananas-kings');
    }
}
