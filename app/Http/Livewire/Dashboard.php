<?php

namespace App\Http\Livewire;

use App\Models\Player;
use Livewire\Component;

class Dashboard extends Component
{
    public ?Player $user_player = null;
    public $players = [];
    public $selected_player = null;
    public ?Player $vs_player = null;

    public function mount ()
    {
        $this->user_player = auth()->user()->player;
        // $this->user_player = Player::find('2');
        $this->players = Player::isPublic(true)->orderBy('nickname')->get();
        $this->vs_player = $this->user_player;
    }

    public function render()
    {
        if ($this->selected_player)
        {
            $this->vs_player = Player::find($this->selected_player);
        }

        return view('livewire.dashboard');
    }
}
