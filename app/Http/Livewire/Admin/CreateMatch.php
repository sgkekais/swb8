<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use App\Models\Match;
use App\Models\MatchType;
use Livewire\Component;

class CreateMatch extends Component
{
    public $is_open = false;
    public ?Match $match = null;
    public $match_types = [];
    public $locations = [];
    public $clubs = [];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->match ??= new Match();
    }

    protected $rules = [
        'match.match_type_id' => 'required',
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
        $this->match = new Match();
    }

    public function store()
    {
        // validate
        $this->validate();

        $this->match->save();

        $this->closeModal();
        session()->flash('success', 'Spiel erfolgreich '.($this->match->id ? 'geändert' : 'angelegt.'));
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Match $match)
    {
        $this->match = $match;
        $this->openModal();
    }

    public function render()
    {
        $this->clubs = Club::orderBy('name')->get();
        $this->match_types = MatchType::orderBy('description')->get();
        return view('livewire.admin.create-match');
    }
}
