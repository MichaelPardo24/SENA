<?php

namespace App\Http\Livewire\Fichas;

use App\Models\User;
use App\Models\Ficha;
use Livewire\Component;
use Livewire\WithPagination;

class Apprentices extends Component
{
    use WithPagination;

    public $search;
    public $role = "Aprendiz";
    public $ficha;

    protected $listeners = ['render' => 'render'];
    
    public function mount(Ficha $ficha)
    {
        $this->ficha = $ficha->id;
    }

    public function render()
    {
        $users = User::with('profile')
                    ->whereHas('roles', function ($q) {
                        $q->where('roles.name', $this->role);
                    })

                    ->whereHas('fichas', function ($query) {
                        $query->where('ficha_id', $this->ficha);
                    })

                    ->where('document', 'LIKE', '%'.$this->search.'%')
                    ->paginate(10);
        
        $ficha = Ficha::find($this->ficha);

        return view('livewire.fichas.apprentices', [
            'users' => $users,
            'fichaUser' => $ficha
            ])->layout('admin.fichas.users.index', ['ficha' => $ficha]);
    }

    public function detach($user)
    {
        $ficha = Ficha::find($this->ficha);
        $ficha->users()->detach($user);
        $this->render();
    }
}
