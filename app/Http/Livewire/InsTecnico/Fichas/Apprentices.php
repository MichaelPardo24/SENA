<?php

namespace App\Http\Livewire\InsTecnico\Fichas;

use App\Models\User;
use Livewire\Component;

class Apprentices extends Component
{
    /**
     * Ficha 
     */
    public $ficha;

    /**
     * Posibles estados de cada usuario por ficha.
     * @var Array
     */
    public $fichaStatus;
    
    /**
     * Filtro de busqueda por nombre, apellido, correo o documento
     * @var String
     */
    public $search;

    /**
     * Filtro de estados según la ficha
     * 
     * @var String
     */
    public $selectedStatus;

    public function mount()
    {
        $this->ficha = request()->route('ficha');
        $this->fichaStatus = \App\Models\FichaUser::STATUS;
    }

    public function render()
    {
        $apprentices = $this->ficha->users()
                        ->role('Aprendiz')
                        ->with('profile')
                        ->where(function ($q) {
                            $q->where('document', 'LIKE', '%'. $this->search .'%')
                              ->orWhere('email', 'LIKE', '%'. $this->search .'%')
                              ->orWhereRelation('profile', 'names', 'LIKE', '%'. $this->search .'%')
                              ->orWhereRelation('profile', 'surnames', 'LIKE', '%'. $this->search .'%');
                        })
                        ->wherePivot('status', 'LIKE', '%'. $this->selectedStatus. '%')
                        ->get()
                        ->sortBy('profile.names');

        return view('livewire.ins-tecnico.fichas.apprentices',[
            'apprentices' => $apprentices, 
        ]);
    }
}
