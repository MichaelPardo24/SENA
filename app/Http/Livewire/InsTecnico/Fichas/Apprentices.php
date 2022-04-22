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
     * Filtros que seran aplicados a la tabla.
     * @var Array
     * @property String search          Filtro para nombres, documento y correo
     * @property String selectedStatus  Filtro para estado de alumnos 
     */
    public $filters = ['search' => '', 'selectedStatus' => ''];

    public $n = 0;

    public $openModal = false;


    public function mount()
    {
        $this->ficha = request()->route('ficha');
        $this->fichaStatus = \App\Models\FichaUser::STATUS;
    }

    public function showModal($apprenticeIndex)
    {
        $this->openModal = true;
        $this->n = $apprenticeIndex;
    }

    public function updatedFilters()
    {
        $this->n = 0;
    }

    public function render()
    {
        $apprentices = $this->ficha->users()
                        ->role('Aprendiz')
                        ->with('profile')
                        ->where(function ($q) {
                            $q->where('document', 'LIKE', '%'. $this->filters['search'] .'%')
                              ->orWhere('email', 'LIKE', '%'. $this->filters['search'] .'%')
                              ->orWhereRelation('profile', 'names', 'LIKE', '%'. $this->filters['search'] .'%')
                              ->orWhereRelation('profile', 'surnames', 'LIKE', '%'. $this->filters['search'] .'%');
                        })
                        ->wherePivot('status', 'LIKE', '%'. $this->filters['selectedStatus']. '%')
                        ->get()
                        ->sortBy('profile.names');

        return view('livewire.ins-tecnico.fichas.apprentices',[
            'apprentices' => $apprentices, 
        ]);
    }
}
