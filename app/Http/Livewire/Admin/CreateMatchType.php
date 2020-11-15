<?php

namespace App\Http\Livewire\Admin;

use App\Models\MatchType;
use Livewire\Component;

class CreateMatchType extends Component
{
    public ?MatchType $match_type = null;
    public $is_open = false;
    public $is_open_delete = false;

    protected $rules = [
        'match_type.description' => 'required',
        'match_type.description_short' => 'required'
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->match_type ??= new MatchType ();
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
        $this->match_type = new MatchType ();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $this->match_type->save();

        session()->flash('success', 'Spielart erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(MatchType $match_type)
    {
        $this->match_type = $match_type;
        $this->openModal();
    }

    public function delete(MatchType $match_type)
    {
        $this->match_type = $match_type;
        $this->openDeleteModal();
    }

    public function destroy(MatchType $match_type)
    {
        $this->match_type = $match_type;

        $match_type->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Spielart ' . $this->match_type->id . ' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-match-type');
    }
}
