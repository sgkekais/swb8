<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use App\Models\Player;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateClub extends Component
{
    use WithFileUploads;

    public ?Club $club = null;
    public $is_open = false;
    public $is_open_delete = false;
    public $all_players = null;
    public $selected_players = [];
    public $club_logo;

    protected $rules = [
        'club.name' => 'required',
        'club.name_short' => 'nullable|string|max:15',
        'club.name_code' => 'nullable|string|max:4',
        'club.logo_url' => 'nullable',
        'club.owner' => 'boolean',
        'club.ah' => 'boolean',
        'club_logo' => 'image|max:1024'
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->club ??= new Club();
        $this->all_players = Player::orderBy('first_name')->with('PlayerStatus')->get();
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
        $this->club = new Club();
        $this->selected_players = [];
        $this->club_logo = null;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        // logo
        $filename = $this->club_logo->store('/', 'club-logos');
        $this->club->logo_url = $filename;

        $this->club->save();
        $this->club->players()->sync($this->selected_players);

        session()->flash('success', 'Mannschaft erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Club $club)
    {
        $this->club = $club;
        $this->selected_players = Club::find($this->club->id)->players()->pluck('id')->toArray();

        //dd($this->selected_players);
        $this->selected_players = array_map('strval',$this->selected_players);
        $this->openModal();
    }

    public function delete(Club $club)
    {
        $this->club = $club;
        $this->openDeleteModal();
    }

    public function destroy(Club $club)
    {
        $this->club = $club;

        $club->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Mannschaft '.$this->club->id.' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-club');
    }
}
