<?php

namespace App\Http\Livewire;

use App\Models\Player;
use Carbon\Carbon;
use Livewire\Component;

class NextBirthday extends Component
{
    public $players;

    public function mount()
    {
        $this->players = Player::whereMonth('dob',Carbon::now()->format('m'))->get();
        $this->players = $this->players->sortBy(function ($player){
            return $player->dob->format('d');
        });
    }

    public function render()
    {
        return view('livewire.sidebar.next-birthday');
    }
}
