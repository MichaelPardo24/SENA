<?php

namespace App\Http\Livewire\FollowUps;

use App\Models\Ficha;
use Livewire\Component;

/**
 * Este componente está encargado de mostrar todas las 
 * fichas asociadas al instructor de seguimiento que esté en 
 * sesión.
 * 
 * @access public 
 */
class Index extends Component
{
    /**
     * Filtro de busqueda para las fichas
     * 
     * @var String
     */
    public $search;

    public function render()
    {
        $fichas = Ficha::withTrashed()->withCount('users')->whereHas('users.roles', function ($q) {
                            $q->where('roles.name', 'Instructor Seguimiento')
                              ->where('users.id', auth()->id());
                        })->where(function ($q) {
                            $q->whereRelation('program', 'name','like', '%'. $this->search .'%')
                              ->orWhere('code', 'like', '%'. $this->search .'%');
                        })->orderBy('deleted_at', 'asc')->get();

        return view('livewire.follow-ups.index', ['fichas' => $fichas]);
    }
}
