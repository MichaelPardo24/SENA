<?php

namespace App\Http\Livewire\InsTecnico;

use App\Models\Ficha;
use Livewire\Component;

class Fichas extends Component
{
    public $search;

    public function render()
    {
        $fichas = Ficha::withTrashed()->withCount('users')->whereHas('users.roles', function ($q) {
            $q->where('roles.name', 'Instructor Tecnico');
            $q->where('users.id', auth()->id());
        })->where(function ($q) {
            $q->whereHas('program', function ($q2) {
                $q2->where('programs.name', 'like', '%'. $this->search .'%');
            })->orWhere('code', 'like', '%'. $this->search .'%');
        })->orderBy('deleted_at', 'asc')->get();

        return view('livewire.ins-tecnico.fichas', [
            'fichas' => $fichas
        ]);
    }
}
