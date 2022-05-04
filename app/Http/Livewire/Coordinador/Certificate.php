<?php

namespace App\Http\Livewire\Coordinador;

use Livewire\Component;
use App\Models\User;
use livewire\withPagination;

class Certificate extends Component
{
    use withPagination;

    public function render()
    {
        $users = User::whereHas('roles', function ($q) {
                $q->where('roles.name', 'Aprendiz');

            })
            ->whereHas('fichas', function ($q) {
                $q->where('status', 'Finalizado');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
            
        return view('livewire.coordinador.certificate')->with(['users' => $users]);
    }
}
