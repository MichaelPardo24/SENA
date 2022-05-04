<?php

namespace App\Http\Livewire\Coordinador;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Accepted extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::whereHas('roles', function ($q) {
                $q->where('roles.name', 'Aprendiz');

            })
            ->whereHas('fichas', function ($q) {
                $q->where('status', 'Preparado');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('livewire.coordinador.accepted')->with(['users' => $users]);
    }
}
