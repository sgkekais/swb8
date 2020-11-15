<?php

namespace App\Http\Livewire\Admin;

use App\Models\Location;
use Livewire\Component;

class CreateLocation extends Component
{
    public ?Location $location = null;
    public $is_open = false;
    public $is_open_delete = false;

    protected $rules = [
        'location.name' => 'required',
        'location.name_short' => 'nullable|string|max:15',
        'location.note' => 'nullable',
        'location.url' => 'url|nullable',
        'location.is_stadium' => 'boolean'
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->location ??= new Location();
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
        $this->location = new Location();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $this->location->save();

        session()->flash('success', 'Standort erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Location $location)
    {
        $this->location = $location;
        $this->openModal();
    }

    public function delete(Location $location)
    {
        $this->location = $location;
        $this->openDeleteModal();
    }

    public function destroy(Location $location)
    {
        $this->location = $location;

        $location->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Standort '.$this->location->id.' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-location');
    }
}
