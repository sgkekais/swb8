<?php

namespace App\Http\Livewire;

use App\Models\Date;
use Livewire\Component;

class Poll extends Component
{
    public ?Date $date = null;
    // public $users_already_synced_options;
    public $checked_options = [];
    public $saved = 0;
    public $header = "Rückmeldung zu Termin";

    public function mount(Date $date)
    {
        $this->date = $date;
        $this->date->load('dateOptions');
        $this->checked_options = auth()->user()->dateOptions()->with('date')->get()->where('date.id', $this->date->id)->where('pivot.attend',1)->pluck('id')->toArray();
        // convert integer vals to strings to avoid problems with pre-checked boxes
        $this->checked_options = array_map('strval', $this->checked_options);
    }

    public function attend()
    {
        // dd($this->checked_options);
        // convert checked_options array into collection, so we can use 'contains()'
        $this->checked_options = collect($this->checked_options);

        // pluck all ids from the date's dateoptions, so we can compare these to the checked_options
        $date_option_ids_of_date = $this->date->dateOptions()->pluck('id');

        // create a new array for the data to be synced with the pivot attribute
        $date_options_to_be_synced = [];

        // fill the new array
        foreach ($date_option_ids_of_date as $key => $value)
        {
            // if the checked_options collection contains the date's dateoption id, attend = 1, else attend = 0 (user did not select this option)
            $date_options_to_be_synced[$value] = ['attend' => $this->checked_options->contains($value) ? 1 : 0];
        }
        // dd($date_options_to_be_synced);

        // sync the data
        auth()->user()->dateOptions()->sync($date_options_to_be_synced);

        $this->saved = 1;
    }

    public function render()
    {
        return view('livewire.poll')->layout('layouts.app', ['header' => $this->header]);;
    }
}
