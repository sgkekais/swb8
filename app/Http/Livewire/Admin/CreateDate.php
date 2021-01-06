<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use App\Models\Date;
use App\Models\DateOption;
use App\Models\DateType;
use App\Models\Location;
use App\Models\Match;
use App\Models\MatchType;
use App\Models\Season;
use App\Models\Tournament;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateDate extends Component
{
    public $is_open = false;
    public $is_open_delete = false;
    public ?Date $date = null;
    public ?Match $match = null;
    public ?DateOption $date_option = null;
    public ?Tournament $tournament = null;
    public $date_types = [];
    public $match_types = [];
    public $locations = [];
    public $clubs = [];
    public Collection $date_options;
    public $assigned_clubs = [];
    public $owned_clubs = [];
    public $seasons = [];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->date ??= new Date();
        $this->match ??= new Match();
        $this->tournament ??= new Tournament();
        $this->date_option ??= new DateOption();
        $this->date_options = $this->date->dateOptions;
        $this->owned_clubs = Club::owner(true)->get();
        $this->seasons = Season::orderBy('number', 'desc')->get();
    }

    protected $rules = [
        'date.date_type_id' => 'required',
        'date.location_id' => 'nullable',
        'date.datetime' => 'nullable',
        'date.title' => 'nullable',
        'date.description' => 'nullable',
        'date.note' => 'nullable',
        'date.published' => 'boolean',
        'date.cancelled' => 'boolean',
        'date.poll_begins' => 'nullable',
        'date.poll_ends' => 'nullable',
        'date.poll_is_open' => 'boolean',
        'date_option.description' => 'nullable',
        'date_options.*.description' => 'nullable',
        'match.match_type_id' => '',
        'match.season_id' => '',
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
        'tournament.title' => 'nullable',
        'tournament.description' => 'nullable',
        'tournament.place' => 'nullable',
    ];

    public function openModal()
    {
        $this->is_open = true;
    }

    public function openDeleteModal()
    {
        $this->is_open_delete = true;
    }

    public function closeModal()
    {
        $this->is_open = false;
        $this->resetInputFields();
    }

    public function closeDeleteModal()
    {
        $this->is_open_delete = false;
    }

    public function create()
    {
        $this->openModal();
    }

    public function resetInputFields()
    {
        $this->date = new Date();
        $this->match = new Match();
        $this->tournament = new Tournament();
        $this->date_option = new DateOption();
        $this->date_options = $this->date->dateOptions;
        $this->assigned_clubs = [];
    }

    public function addDateOption()
    {
        $this->date_options->push($this->date_option);
    }

    public  function removeDateOption($key)
    {
        $this->date_options->pull($key);
    }

    public function store()
    {
        // validate
        $this->validate();

        // store date, match, tournament, date_options depending on date->date_type_id
        // general poll (1) or party (4) -> save date with multiple date_options
        if ($this->date->date_type_id == 1 || $this->date->date_type_id == 4) {
            $this->date->save();
            // only create new dateoptions if the date doesn't have any yet
            if (!$this->date->dateOptions()->count() > 0) {
                foreach ($this->date_options as $key => $value) {
                    $new_date_option = new DateOption(['description' => $value['description']]);
                    $this->date->dateOptions()->save($new_date_option);
                }
            } else {
                // we have to  a) check if options were removed and delete these, and b) save any new options

            }
            // sync the clubs
            $this->date->clubs()->sync($this->assigned_clubs);

        } elseif ($this->date->date_type_id == 2) {
            // match -> save date with poll = date->datetime (begins -14 days, ends = datetime) and match
            $this->date->save();
            $this->date->match()->save($this->match);

        } elseif ($this->date->date_type_id == 3)  {
            // tournament -> save date with tournament
            $this->date->save();
            $this->date->tournament()->save($this->tournament);
        }

        $this->closeModal();
        session()->flash('success', 'Termin erfolgreich '.($this->date->id ? 'geändert' : 'angelegt.'));
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Date $date)
    {
        $this->date = $date;
        $this->match = $date->match;
        $this->date_options = $date->dateOptions;
        $this->tournament = $date->tournament;
        $this->assigned_clubs = $this->date->clubs()->get()->pluck('id')->toArray();
        $this->assigned_clubs = array_map('strval', $this->assigned_clubs);
        $this->openModal();
    }

    public function delete(Date $date)
    {
        $this->date = $date;
        $this->match = $date->match;
        $this->date_options = $date->dateOptions;
        $this->tournament = $date->tournament;
        $this->openDeleteModal();
    }

    public function destroy(Date $date)
    {
        $date->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Standort '.$this->date->id.' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        $this->date_types = DateType::all();
        $this->locations = Location::orderBy('name')->get();
        $this->clubs = Club::orderBy('name')->get();
        $this->match_types = MatchType::all();
        return view('livewire.admin.create-date');
    }
}
