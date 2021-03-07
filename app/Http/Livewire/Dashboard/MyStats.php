<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyStats extends Component
{
    public $my_goals;
    public $my_assists;
    public $my_cards;

    public function mount()
    {
        if (Auth::user()->player)
        {
            $this->my_goals = Auth::user()->player->goals->load('match.date', 'match.season');
            $this->my_assists = Auth::user()->player->assists->load('goal.match.date', 'goal.match.season');
            $this->my_cards = Auth::user()->player->cards->load('match.date', 'match.season');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.my-stats');
    }
}