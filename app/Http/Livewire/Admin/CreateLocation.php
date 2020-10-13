<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Location;

class CreateLocation extends Component
{
    public $name, $name_short, $note, $is_stadium = 0, $url;
    public $isOpen = 0;

    protected $rules = [
        'name' => 'required',
        'url' => 'url|nullable'
    ];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
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
        $this->validate();

        Location::create([
            'name' => $this->name,
            'name_short' => $this->name_short,
            'note' => $this->note,
            'is_stadium' => $this->is_stadium,
            'url' => $this->url
        ]);

        session()->flash('success', 'Standort erfolgreich angelegt.');

        return redirect()->to('admin/locations');

        // $this->closeModal();
        // $this->resetInputFields();
        // $this->emit('refreshLivewireDatatable');

    }

    public function render()
    {
        return view('livewire.admin.create-location');
    }
}
