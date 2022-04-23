<?php

namespace App\Http\Livewire\InsTecnico\Fichas;

use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    /**
     * Select de estado para aplicar a todos los alumnos
     * @var String
     */
    public $selectedFullStatus;

    public $n = 0;

    public $openModal = false;


    public function mount($ficha)
    {
        $this->ficha = $ficha;
        $this->fichaStatus = \App\Models\FichaUser::STATUS;
    }

    /**
     * Prepara los datos para que el modal muestre la info correcta.
     * 
     * @param Int $apprenticeIndex Representa el index del aprendiz en 
     * la coleccion de aprendices.
     */
    public function showModal($apprenticeIndex)
    {
        $this->openModal = true;
        $this->n = $apprenticeIndex;
    }

    /**
     * Cuando se actulizan los filtros necesitamos que el indice
     * usado para mostrar la info del aprendiz en el modal vuelva 
     * a 0 para evitar errores
     */
    public function updatedFilters()
    {
        $this->n = 0;
    }

    /**
     * Actualiza el estado de TODOS los aprendices
     * según la ficha.
     * @return Void 
     */
    public function updateAllApprenticesStatus()
    {
        try {
            DB::beginTransaction();
            foreach ($this->ficha->users()->role('Aprendiz')->get() as $apprentice) {
                    $apprentice->fichas()->updateExistingPivot($this->ficha, [
                        'status' => $this->selectedFullStatus
                ]);
            }
            usleep(500);
            DB::commit();
            $this->emit('full-status-changed');

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('full-status-failed');
        }

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
