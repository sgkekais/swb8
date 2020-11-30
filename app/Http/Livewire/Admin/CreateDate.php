<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use App\Models\Date;
use App\Models\DateOption;
use App\Models\DateType;
use App\Models\Location;
use App\Models\Match;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateDate extends Component
{
    public $is_open = false;
    public ?Date $date = null;
    public ?Match $match = null;
    public ?DateOption $date_option = null;
    public $date_types = [];
    public $locations = [];
    public $clubs = [];
    public Collection $date_options;

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->date ??= new Date();
        $this->date_option ??= new DateOption();
        $this->match ??= new Match();
        $this->date_options = collect();
    }

    protected $rules = [
        'date.date_type_id' => 'required',
        'date.location_id' => 'nullable',
        'date.datetime' => 'nullable',
        'date.title' => 'string|nullable',
        'date.description' => 'nullable',
        'date.note' => 'nullable',
        'date.published' => 'boolean',
        'date.cancelled' => 'boolean',
        'date.poll_begins' => 'nullable',
        'date.poll_ends' => 'nullable',
        'date.poll_is_open' => 'boolean',
        'date_option.description' => 'required',
        'match.team_home' => 'nullable',
        'match.team_away' => 'nullable',
        'match.goals_home' => 'nullable|numeric|min:0',
        'match.goals_home_ht' => 'nullable|numeric|min:0',
        'match.goals_home_pen' => 'nullable|numeric|min:0',
        'match.goals_home_rated' => 'nullable|numeric|min:0',
        'match.goals_away' => 'nullable|numeric|min:0',
        'match.goals_away_ht' => 'nullable|numeric|min:0',
        'match.goals_away_pen' => 'nullable|numeric|min:0',
        'match.goals_away_rated' => 'nullable|numeric|min:0',
        'match.match_details' => 'nullable',
        'match.published' => 'boolean',
        'match.cancelled' => 'boolean',
    ];

    public function openModal()
    {
        $this->is_open = true;
    }

    public function closeModal()
    {
        $this->is_open = false;
        $this->resetInputFields();
    }

    public function create()
    {
        $this->openModal();
    }

    public function resetInputFields()
    {
        $this->date = new Date();
        $this->match = new Match();
        $this->date_option = new DateOption();
        $this->date_options = collect();
    }

    public function addDateOption()
    {
        $this->date_options->push($this->date_option);
    }

    public  function removeDateOption($key)
    {
        $this->date_options->pull($key);
    }

    public function store(Date $date)
    {
        // validate

        // store date, match, tournament, date_options depending on date->date_type_id

        switch ($date->date_type_id) {

            case (1 | 4):
                // general poll (1) or party (4) -> save date with multiple date_options
                break;

            case (2):
                // match -> save date with poll = date->datetime (begins -14 days, ends = datetime) and match
                break;

            case (3):
                // tournament -> save date with tournament
                break;
        }



        $this->resetInputFields();
    }

    public function edit(Date $date)
    {
        $this->date = $date;
        $this->match = $date->match;
        $this->date_options = $date->dateOptions;
        $this->openModal();
    }

    public function render()
    {
        $this->date_types = DateType::all();
        $this->locations = Location::orderBy('name')->get();
        $this->clubs = Club::orderBy('name')->get();
        return view('livewire.admin.create-date');
    }
}
