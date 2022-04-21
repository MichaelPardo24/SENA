<?php

namespace App\Http\Livewire\InsTecnico\Fichas;

use Livewire\Component;

class Apprentices extends Component
{
    /**
     * Ficha 
     */
    protected $ficha;
    
    /**
     * Filtro de busqueda
     */
    public $search;

    public function mount()
    {
        $this->ficha = request()->route('ficha');
    }

    public function render()
    {

        $apprentices = $this->ficha->users()->role('Aprendiz')->with('profile')->get();

        return view('livewire.ins-tecnico.fichas.apprentices',[
            'apprentices' => $apprentices
        ]);
    }
}
