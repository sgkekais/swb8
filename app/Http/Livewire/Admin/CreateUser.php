<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\TrimAndNullEmptyStrings;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    use TrimAndNullEmptyStrings;

    public ?User $user = null;
    public $is_open = false;
    public $is_open_delete = false;

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email'
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->user ??= new User();
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
        $this->user = new User();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        $this->user->password = Hash::make($this->user->password);
        $this->user->save();

        session()->flash('success', 'User erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    public function edit(User $user)
    {
        $this->user = $user;
        $this->openModal();
    }

    public function delete(User $user)
    {
        $this->user = $user;
        $this->openDeleteModal();
    }

    public function destroy(User $user)
    {
        $this->user = $user;

        $user->delete();

        $this->closeDeleteModal();

        session()->flash('success', 'User '.$this->user->id.' erfolgreich gelöscht.');
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return view('livewire.admin.create-user');
    }
}
