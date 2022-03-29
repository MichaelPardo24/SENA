<?php

namespace App\Http\Livewire\Fichas;

use App\Models\User;
use App\Models\Ficha;
use Livewire\Component;

class AddUser extends Component
{
    public $open = false;
    public $role = "";
    public $selectedUser;

    public $ficha;

    public function mount($ficha)
    {
        $this->ficha = $ficha;
    }

    public function render()
    {
        return view('livewire.fichas.add-user', [
            'users' => $this->getUsers()
        ]);
    }

    public function updatedRole()
    {
        $this->reset('selectedUser');
    }

    public function getUsers()
    {
        if ($this->role == "") {
            return null;
        } 

        if ($this->role == "Instructor Tecnico") {
            return User::role('Instructor Tecnico')->whereDoesntHave('fichas')
                ->select(['users.id', 'users.document','names', 'surnames'])
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->orderBy('surnames', 'asc')
                ->get();
        }

        if ($this->role == "Aprendiz") {
            return User::role('Aprendiz')->whereDoesntHave('fichas')
                ->select(['users.id', 'users.document','names', 'surnames'])
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->orderBy('surnames', 'asc')
                ->get();
        }

        $a = Ficha::whereHas('users.roles', function ($q) {
            $q->where('roles.name', 'Instructor Seguimiento');
        })->where('id', $this->ficha)->count();

        if ($a == 0) {
            return User::role($this->role)
                ->select(['users.id', 'users.document','names', 'surnames'])
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->orderBy('surnames', 'asc')
                ->get();
        } 

        return null;
    }

    public function close()
    {
        $this->reset(['open', 'role', 'selectedUser']);
    }

    public function add()
    {
        $ficha = Ficha::find($this->ficha);
        $ficha->users()->attach($this->selectedUser);
        $this->reset(['role', 'selectedUser', 'open']);
        $this->emit('render');
    }
}
