<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class Users extends Component
{
    use WithPagination;

    //los datos obtenidos en el get
    protected $queryString = ['search' => ['except' => ''], 'perPage'];

    //busqueda
    public $search;

    //cantidad de datos por pagina
    public $perPage = '10';

    public function render()
    {

        $users = User::WhereHas('profile', function($q){
                        $q->where('names', 'LIKE', "%$this->search%");
                        $q->orWhere('surnames', 'LIKE', "%$this->search%");
                        $q->orWhere('document_type', 'LIKE', "%$this->search%");
                        $q->orWhere('id', 'LIKE', "%$this->search%");
                    })
                    ->orWhere('document', 'LIKE', "%$this->search%")
                    ->orWhere('email', 'LIKE', "%$this->search%")
                    ->paginate($this->perPage);

        return view('livewire.users', compact('users'));
    }
}
