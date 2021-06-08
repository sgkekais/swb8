<?php

namespace App\Http\Livewire\Frontpage;

use App\Models\Date;
use Carbon\Carbon;
use Livewire\Component;

class NextDates extends Component
{
    public $next_dates;
    public $today;

    public function mount()
    {
        $this->today = Carbon::now();
        $this->next_dates = Date::published()
            ->whereIn('date_type_id',[2,3,4])
            ->where('datetime','>=', $this->today)
            ->orderBy('datetime')
            ->take(2)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontpage.next-dates');
    }
}
