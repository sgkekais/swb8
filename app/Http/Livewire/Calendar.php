<?php

namespace App\Http\Livewire;

use App\Models\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Calendar extends Component
{
    public $header = "Kalender";
    public $selectable_years = [];
    public $selected_year = "";
    public $dates = [];

    public function mount()
    {
        $this->selected_year = Carbon::now()->format('Y');
    }

    public function render()
    {
        $this->selectable_years = collect(DB::table('dates')->selectRaw("DISTINCT(DATE_FORMAT(datetime,'%Y')) AS date")->get());
        $this->selectable_years = $this->selectable_years->whereNotNull('date');

        $selected_year_to_date = Carbon::createFromDate($this->selected_year);
        $start_of_selected_year = $selected_year_to_date->copy()->startOfYear();
        $end_of_selected_year = $selected_year_to_date->copy()->endOfYear();
        $this->dates = Date::published()->where('datetime','>=',$start_of_selected_year)->where('datetime','<=',$end_of_selected_year)->orderBy('datetime')->get();
        $this->dates->load('dateType', 'match', 'tournament', 'match.matchtype');

        return view('livewire.calendar')->layout('layouts.app', ['header' => $this->header]);
    }
}
