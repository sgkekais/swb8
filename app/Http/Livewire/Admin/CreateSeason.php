<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use App\Models\Season;
use Livewire\Component;

class CreateSeason extends Component
{
    public ?Season $season = null;
    public $is_open = false;
    public $is_open_delete = false;
    public $clubs = [];
    public $assigned_clubs = [];
    public $owned_clubs = [];

    protected $rules = [
        'season.number' => 'nullable|integer',
        'season.title' => 'nullable',
        'season.description' => 'nullable',
        'season.final_position' => 'nullable|integer',
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->season ??= new Season();
        $this->season->number = Season::max('number') + 1;
        $this->owned_clubs = Club::owner(true)->get();
    }

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

    public function resetInputFields()
    {
        $this->season = new Season();
    }

    public function create()
    {
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $this->season->save();

        $this->season->clubs()->sync($this->assigned_clubs);

        session()->flash('success', 'Saison erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Season $season)
    {
        $this->season = $season;
        $this->assigned_clubs = $this->season->clubs()->get()->pluck('id')->toArray();
        $this->assigned_clubs = array_map('strval', $this->assigned_clubs);
        $this->openModal();
    }

    public function delete(Season $season)
    {
        $this->season = $season;
        $this->openDeleteModal();
    }

    public function destroy(Season $season)
    {
        $this->season = $season;

        $season->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Saison ' . $this->season->id . ' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-season');
    }
}
