<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use Livewire\Component;

class CreateClub extends Component
{
    public $name, $name_short, $name_code, $logo_url, $owner = 0, $ah = 0;
    public $isOpen = 0;

    protected $rules = [
        'name' => 'required',
        'logo_url' => 'url|nullable'
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

        Club::create([
            'name' => $this->name,
            'name_short' => $this->name_short,
            'name_code' => $this->name_code,
            'ah' => $this->ah,
            'owner' => $this->owner
        ]);

        session()->flash('success', 'Mannschaft erfolgreich angelegt.');

        // return redirect()->to('admin/locations');

        $this->closeModal();
        $this->resetInputFields();
        $this->emit('refreshLivewireDatatable');

    }

    public function render()
    {
        return view('livewire.admin.create-club');
    }
}
