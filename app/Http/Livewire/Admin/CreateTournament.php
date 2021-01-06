<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tournament;
use Livewire\Component;

class CreateTournament extends Component
{
    public ?Tournament $tournament = null;
    public $is_open = false;
    public $is_open_delete = false;

    protected $rules = [
        'tournament.title' => 'nullable',
        'tournament.description' => 'nullable',
        'tournament.place' => 'nullable'
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->tournament ??= new Tournament ();
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
        $this->tournament = new Tournament ();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $this->tournament->save();

        session()->flash('success', 'Turnier erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->openModal();
    }

    public function delete(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->openDeleteModal();
    }

    public function destroy(Tournament $tournament)
    {
        $this->tournament = $tournament;

        $tournament->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Turnier ' . $this->tournament->id . ' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-tournament');
    }
}
