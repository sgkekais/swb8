<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Player;
use Livewire\Component;

class Vs extends Component
{
    public ?Player $user_player = null;
    public $players = [];
    public $selected_player = null;
    public ?Player $vs_player = null;

    public function mount ()
    {
        $this->user_player = auth()->user()->player;
        $this->players = Player::isPublic(true)->orderBy('first_name')->orderBy('last_name')->get();
        $this->vs_player = $this->user_player;
    }

    public function render()
    {
        if ($this->selected_player)
        {
            $this->vs_player = Player::find($this->selected_player);
            $this->vs_player->load('goals', 'assists', 'cards');
        }

        return view('livewire.dashboard.vs');
    }
}
