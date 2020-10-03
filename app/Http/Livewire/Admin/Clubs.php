<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use Livewire\Component;
use Livewire\WithPagination;

class Clubs extends Component
{
    use WithPagination;

    public $club_id, $name, $name_short, $name_code, $ah = 0, $owner = 0;
    public $isOpenMaintain = 0;
    public $isOpenDelete = 0;
    public $sortField = 'id';
    public $sortAsc = true;
    public $searchTerm;

    protected $rules = [
        'name' => 'required'
    ];

    public function updated($field)
    {
        $this->validateOnly($field, [
            'name' => 'required'
        ]);
    }

    public function openModal()
    {
        $this->isOpenMaintain = true;
    }

    public function closeModal()
    {
        $this->isOpenMaintain = false;
    }

    public function resetInputFields()
    {
        $this->reset([
            'club_id',
            'name',
            'name_short',
            'name_code',
            'ah',
            'owner'
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        Club::updateOrCreate(['id' => $this->club_id], [
            'name' => $this->name,
            'name_short' => $this->name_short,
            'name_code' => $this->name_code,
            'ah' => $this->ah,
            'owner' => $this->owner
        ]);

        session()->flash('success', $this->club_id ? 'Mannschaft '.$this->club_id.' geändert.' : 'Mannschaft angelegt.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit(Club $club)
    {
        $this->club_id = $club->id;
        $this->name = $club->name;
        $this->name_short = $club->name_short;
        $this->name_code = $club->name_code;
        $this->ah = $club->ah;
        $this->owner = $club->owner;

        $this->openModal();
    }

    public function openDeleteModal() 
    {
        $this->isOpenDelete = true;
    }

    public function closeDeleteModal()
    {
        $this->isOpenDelete = false;
    }

    public function delete(Club $club) 
    {
        $this->club_id = $club->id;
        $this->openDeleteModal();     
    }

    public function destroy(Club $club)
    {
        $this->club_id = $club->id;
        $this->name = $club->name;

        $club->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Mannschaft ('.$this->club_id.') '.$this->name.' gelöscht.');

        $this->reset([
            'club_id', 'name'
        ]);        
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';

        $clubs = Club::where('name', 'like', $searchTerm)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate(10);

        return view('livewire.admin.clubs', compact('clubs'));
    }



}
