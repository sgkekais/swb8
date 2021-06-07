<?php

namespace App\Http\Livewire;

use App\Models\Club;
use Livewire\Component;

class Squad extends Component
{
    public $header = 'Kader';
    public ?Club $club = null;

    public function mount(Club $club)
    {
        $this->club = $club;
        $this->club->load('players.clubs');
    }

    public function render()
    {
        return view('livewire.squad')->layout('layouts.app', ['header' => $this->header]);
    }
}
