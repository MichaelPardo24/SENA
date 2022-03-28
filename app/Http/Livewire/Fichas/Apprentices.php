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
    
    public function mount($ficha)
    {
        $this->ficha = $ficha;

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

        return view('livewire.fichas.apprentices', ['users' => $users])->layout('admin.fichas.users.index', ['ficha' => Ficha::find($this->ficha)]);
    }

    public function detach($user)
    {
        $ficha = Ficha::find($this->ficha);
        $ficha->users()->detach($user);
        $this->render();
    }
}
