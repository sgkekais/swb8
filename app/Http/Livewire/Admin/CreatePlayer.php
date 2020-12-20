<?php

namespace App\Http\Livewire\Admin;

use App\Models\Player;
use App\Models\PlayerStatus;
use App\Models\User;
use Livewire\Component;

class CreatePlayer extends Component
{
    public ?Player $player = null;
    public $is_open = false;
    public $is_open_delete = false;
    public $player_statuses = [];
    public $users = [];

    protected $rules = [
        'player.player_status_id' => 'required',
        'player.user_id' => 'nullable',
        'player.first_name' => 'required|string|max:20',
        'player.last_name' => 'nullable|string|max:20',
        'player.nickname' => 'nullable|string|max:20',
        'player.dob' => 'date|nullable',
        'player.joined' => 'date|nullable',
        'player.left' => 'date|nullable',
        'player.public_note' => 'nullable',
        'player.internal_note' => 'nullable',
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->player ??= new Player();
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
        $this->player = new Player();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $this->player->save();

        session()->flash('success', 'Spieler erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Player $player)
    {
        $this->player = $player;
        $this->openModal();
    }

    public function delete(Player $player)
    {
        $this->player = $player;
        $this->openDeleteModal();
    }

    public function destroy(Player $player)
    {
        $this->player = $player;

        $player->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Spieler '.$this->player->id.' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        $this->player_statuses = PlayerStatus::all();
        $this->users = User::orderBy('email')->get();
        return view('livewire.admin.create-player');
    }
}
