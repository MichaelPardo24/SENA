<?php

namespace App\Http\Livewire\Extra;

use Livewire\Component;

class ListUserFichas extends Component
{
    public $selectedFicha;

    public function render()
    {
        $fichas = auth()->user()->fichas()->withTrashed()->get();
        return view('livewire.extra.list-user-fichas', compact('fichas'));
    }
}
