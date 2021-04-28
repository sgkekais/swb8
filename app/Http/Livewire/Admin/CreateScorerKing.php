<?php

namespace App\Http\Livewire\Admin;

use App\Models\Player;
use App\Models\Season;
use Livewire\Component;

class CreateScorerKing extends Component
{
    public $is_open = false;
    public $is_open_delete = false;
    public $player_id;
    public $players;
    public $season_id;
    public $seasons;

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];
    protected $rules = [
        'player_id' => 'required',
        'season_id' => 'required',
    ];

    public function mount()
    {
        $this->player_id = null;
        $this->season_id = null;
        $this->players = Player::all()->sortBy('full_name');
        $this->seasons = Season::orderBy('number', 'desc')->get();
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
        $this->player_id = null;
        $this->season_id = null;
    }

    public function create()
    {
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $player = Player::find($this->player_id);
        $season = Season::find($this->season_id);

        $season->scorerKings()->attach($player);

        session()->flash('success', 'Torschützenkönig erfolgreich angelegt.');
        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function delete($season_id, $player_id)
    {
        $this->season_id = $season_id;
        $this->player_id = $player_id;
        $this->openDeleteModal();
    }

    public function destroy()
    {
        $player = Player::find($this->player_id);
        $season = Season::find($this->season_id);

        $season->scorerKings()->detach($player);

        session()->flash('success', 'Torschützenkönig erfolgreich gelöscht.');
        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-scorer-king');
    }
}
