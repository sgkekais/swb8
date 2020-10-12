<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Location;

class CreateLocation extends Component
{
    public $name, $name_short, $note, $is_stadium, $url;
    public $isOpen = 0;

    protected $rules = [
        'location.name' => 'required'
    ];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetInputFields()
    {
        $this->reset();
    }

    public function create()
    {
        $this->openModal();
    }

    public function store()
    {
        $this->closeModal();
        $this->resetInputFields();
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-location');
    }
}
