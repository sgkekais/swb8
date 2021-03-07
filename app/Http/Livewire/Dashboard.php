<?php

namespace App\Http\Livewire;

use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $future_dates;
    public $past_dates;
    public $today;

    public function mount ()
    {
        $this->today = Carbon::now();
        $this->future_dates = Auth::user()->dateOptions->where('date.datetime','>=', $this->today)->pluck('date')->unique()->sortBy('datetime');
        $this->past_dates = Auth::user()->dateOptions->where('date.datetime','<=', $this->today)->pluck('date')->unique()->sortByDesc('datetime');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
