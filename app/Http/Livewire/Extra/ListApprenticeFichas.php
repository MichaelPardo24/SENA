<?php

namespace App\Http\Livewire\Extra;

use Livewire\Component;

class ListApprenticeFichas extends Component
{
    public function render()
    {
        $fichas = auth()->user()->fichas()->withTrashed()->get();
        return view('livewire.extra.list-apprentice-fichas', compact('fichas'));
    }
}
