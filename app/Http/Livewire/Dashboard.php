<?php

namespace App\Http\Livewire;

use App\Models\Player;
use Livewire\Component;

class Dashboard extends Component
{
    public ?Player $player = null;

    public function mount ()
    {
        $this->player = auth()->user()->player;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
