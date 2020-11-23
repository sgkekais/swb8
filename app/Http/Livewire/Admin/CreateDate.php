<?php

namespace App\Http\Livewire\Admin;

use App\Models\Date;
use App\Models\DateType;
use App\Models\Location;
use Livewire\Component;

class CreateDate extends Component
{
    public ?Date $date = null;
    public $is_open = false;
    public $date_type_id = 0;
    public $date_types = [];
    public $date_type = 'Bitte Terminart auswählen';
    public $locations = [];
    public $location = 'Bitte Standort auswählen';

    public function mount()
    {
        $this->date_types = DateType::all();
        $this->locations = Location::orderBy('name')->get();
        $this->date ??= new Date();
    }

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
        $this->resetInputFields();
        $this->openModal();
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->date = new Date();
    }

    public function render()
    {
        return view('livewire.admin.create-date');
    }
}
