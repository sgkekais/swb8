<?php

namespace App\Http\Livewire\Frontpage;

use App\Models\Date;
use Carbon\Carbon;
use Livewire\Component;

class ActiveGeneralPolls extends Component
{
    public $active_polls;
    public $today;

    public function mount()
    {
        $this->today = Carbon::today();

        $this->active_polls = Date::published(true)->cancelled(false)
            ->where('date_type_id', 1)
            ->where('poll_begins','<=',$this->today)
            ->where('poll_ends','>=',$this->today)
            ->where('poll_is_open',1)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontpage.active-general-polls');
    }
}
