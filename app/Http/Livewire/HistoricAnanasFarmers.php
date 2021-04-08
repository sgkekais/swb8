<?php

namespace App\Http\Livewire;

use App\Models\Date;
use App\Models\Player;
use Livewire\Component;

class HistoricAnanasFarmers extends Component
{
    public $header = 'Ewige Ananasbauern';
    public $sinners;
    public $sortField = "sinner_points";
    public $sortDirection = 'desc';
    public $first_card;

    public function mount()
    {
        $this->first_card = Date::whereHas('match.cards')->orderBy('datetime')->first()->datetime;
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
        $this->sinners = Player::whereHas('cards')->withCount(['cards'])->get();

        $this->sinners = $this->sinners->map(function ($player) {
            $player->total_yellow_cards = $player->cards->where('color', 'gelb')->count();
            $player->total_red_cards = $player->cards->where('color', 'rot')->count();
            $player->total_yellow_red_cards = $player->cards->where('color', 'gelb-rot')->count();
            $player->total_time_penalties = $player->cards->where('color', '10min')->count();
            $player->sinner_points = $player->total_yellow_cards
                + $player->total_time_penalties
                + $player->total_yellow_red_cards * 3
                + $player->total_red_cards * 5;

            return $player;
        });

        // sort the collection
        if ($this->sortDirection === 'asc')
        {
            $this->sinners = $this->sinners->sortBy([
                [$this->sortField, 'asc'],
                ['full_name_short', 'asc']
            ]);
        } elseif ($this->sortDirection === 'desc') {
            $this->sinners = $this->sinners->sortBy([
                [$this->sortField, 'desc'],
                ['full_name_short', 'asc']
            ]);
        }

        return view('livewire.historic-ananas-farmers')->layout('layouts.app', ['header' => $this->header]);
    }
}
