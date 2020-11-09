<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use Livewire\Component;

class CreateClub extends Component
{
    public ?Club $club = null;
    public $is_open = false;
    public $is_open_delete = false;

    protected $rules = [
        'club.name' => 'required',
        'club.name_short' => 'nullable|string|max:15',
        'club.name_code' => 'nullable|string|max:4',
        'club.logo_url' => 'url|nullable',
        'club.owner' => 'boolean',
        'club.ah' => 'boolean'
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->club ??= new Club();
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
        $this->club = new Club();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $this->club->save();

        session()->flash('success', 'Mannschaft erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Club $club)
    {
        $this->club = $club;
        $this->openModal();
    }

    public function delete(Club $club)
    {
        $this->club = $club;
        $this->openDeleteModal();
    }

    public function destroy(Club $club)
    {
        $this->club = $club;

        $club->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Mannschaft '.$this->club->id.' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-club');
    }
}
