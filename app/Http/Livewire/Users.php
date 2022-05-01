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
    public $message = null;

    public function mount($message)
    {
        $this->message = $message;
    }

    public function closeAlert(){
        $this->message = Null;
    }

    public function render()
    {
        if (auth()->user()->hasrole("Manager|Coordinador")) {
            $users = User::WhereHas('profile', function($q){
                            $q->where('names', 'LIKE', "%$this->search%");
                            $q->orWhere('surnames', 'LIKE', "%$this->search%");
                            $q->orWhere('document_type', 'LIKE', "%$this->search%");
                            $q->orWhere('id', 'LIKE', "%$this->search%");
                        })
                        ->orWhere('document', 'LIKE', "%$this->search%")
                        ->orWhere('email', 'LIKE', "%$this->search%")
                        ->orderBy('id', 'desc')
                        ->paginate($this->perPage);
        } else {
            $users = User::WhereHas('profile', function($q){
                            $q->where('names', 'LIKE', "%$this->search%");
                            $q->orWhere('surnames', 'LIKE', "%$this->search%");
                            $q->orWhere('document_type', 'LIKE', "%$this->search%");
                            $q->orWhere('id', 'LIKE', "%$this->search%");
                        })
                        ->orWhere('document', 'LIKE', "%$this->search%")
                        ->orWhere('email', 'LIKE', "%$this->search%")
                        ->orderBy('id', 'desc')
                        ->role('Aprendiz')
                        ->paginate($this->perPage);
        }
        return view('livewire.users')->with(['users' => $users, 'message' => $this->message]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
