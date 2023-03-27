<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\TrimAndNullEmptyStrings;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    use TrimAndNullEmptyStrings;

    public $name;
    public $email;
    public $password;
    public $is_open = false;
    public $is_open_delete = false;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required'
    ];

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

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
        $this->name = null;
        $this->email = null;
        $this->password = null;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        session()->flash('success', 'User erfolgreich angelegt.');

        $this->closeModal();
        $this->emit('refreshLivewireDatatable');
    }

    /*public function edit(User $user)
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
    }*/

    public function render()
    {
        return view('livewire.admin.create-user');
    }
}
