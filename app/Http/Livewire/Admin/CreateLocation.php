<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Location;

class CreateLocation extends Component
{
    public Location $location;

    protected $rules = [
        'location.name' => 'required'
    ];

    public function create()
    {

    }

    public function store()
    {

    }

    public function render()
    {
        return view('livewire.admin.create-location');
    }
}
