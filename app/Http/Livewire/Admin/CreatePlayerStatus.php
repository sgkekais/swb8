<?php

namespace App\Http\Livewire\Admin;

use App\Models\PlayerStatus;
use Livewire\Component;

class CreatePlayerStatus extends Component
{
    public ?PlayerStatus $player_status = null;
    public $is_open = false;
    public $is_open_delete = false;

    protected $rules = [
        'player_status.description' => 'required',
        'player_status.can_play' => 'boolean',
        'player_status.display_in_polls' => 'boolean',
        'player_status.display_in_squad' => 'boolean',
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->player_status ??= new PlayerStatus ();
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
        $this->player_status = new PlayerStatus ();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $this->player_status->save();

        session()->flash('success', 'Spieler-Status erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(PlayerStatus $player_status)
    {
        $this->player_status = $player_status;
        $this->openModal();
    }

    public function delete(PlayerStatus $player_status)
    {
        $this->player_status = $player_status;
        $this->openDeleteModal();
    }

    public function destroy(PlayerStatus $player_status)
    {
        $this->player_status = $player_status;

        $player_status->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'Spieler-Status ' . $this->player_status->id . ' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-player-status');
    }
}
