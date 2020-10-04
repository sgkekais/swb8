<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class Log extends Component
{
    use WithPagination;
    
    public $sortField;

    public function render()
    {
        $log_entries = Activity::latest()->paginate(15);

        return view('livewire.admin.log', compact('log_entries'));
    }
}
