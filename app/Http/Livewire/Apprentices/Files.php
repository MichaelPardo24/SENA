<?php

namespace App\Http\Livewire\Apprentices;

use App\Models\Ficha;
use Livewire\Component;
use Livewire\WithPagination;

class Files extends Component
{
    use WithPagination;

    public $ficha;
    public $fichaComplete;
    public $search;
    public $is_trashed;
    public $ficha_id;
    public $perPage = '10';
    
    protected $queryString = ['search' => ['except' => ''], 'perPage'];

    public function mount($ficha)
    { 
        $fi = Ficha::withTrashed()
            ->where('code', $ficha)
            ->first();

        $this->is_trashed = $fi->trashed();
        $this->ficha = $fi->code;
        $this->ficha_id = $fi->id;

        //Guardo el resultado de la consulta en la propiedad $fichaComplete
        $this->fichaComplete = $fi;
    }

    public function render()
    {
        //hago un llamado a los usuarios inscritos a esa ficha, uno por uno para verificar
        //si el usuario vericado se encuentra en la ficha y si su estado es "Aceptado" para poder
        //continuar
        foreach ($this->fichaComplete->users as $user) {
            if ($user->pivot->status == "Aceptado" && $user->id == auth()->user()->id){
                $files = auth()->user()->files()
                            ->where('ficha_id', $this->ficha_id)
                            ->where('name', 'LIKE', '%'.$this->search.'%')
                            ->paginate($this->perPage);
    
                return view('livewire.apprentices.files', compact('files'))->layout('apprentices.files.index');
            }
        }

        //Si despues de realizar la busqueda en toda la ficha no se cumplio la condicion anterior
        //se retorna un error 404
        return abort(404);
    }
}
