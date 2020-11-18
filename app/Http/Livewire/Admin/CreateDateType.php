<?php

namespace App\Http\Livewire\Admin;

use App\Models\DateType;
use Livewire\Component;

class CreateDateType extends Component
{
    public ?DateType $date_type = null;
    public $is_open = false;
    public $is_open_delete = false;

    protected $rules = [
        'date_type.description' => 'required'
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->date_type ??= new DateType ();
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
        $this->date_type = new DateType ();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $this->date_type->save();

        session()->flash('success', 'Terminart erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(DateType $date_type)
    {
        $this->date_type = $date_type;
        $this->openModal();
    }

    public function delete(DateType $date_type)
    {
        $this->date_type = $date_type;
        $this->openDeleteModal();
    }

    public function destroy(DateType $date_type)
    {
        $this->date_type = $date_type;

        $date_type->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Terminart ' . $this->date_type->id . ' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }
    public function render()
    {
        return view('livewire.admin.create-date-type');
    }
}
