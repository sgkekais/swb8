<?php

namespace App\Http\Livewire\Frontpage;

use App\Models\Date;
use Carbon\Carbon;
use Livewire\Component;

class NextGame extends Component
{
    public $next_match;
    public $today;

    public function mount()
    {
        $this->today = Carbon::today();
        $this->next_match = Date::where('date_type_id',2)->where('datetime','>=', Carbon::now())->orderBy('datetime')->with('match', 'match.teamHome', 'match.teamAway')->first();
    }

    public function render()
    {
        return view('livewire.frontpage.next-game');
    }
}
