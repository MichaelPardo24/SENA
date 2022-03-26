<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ficha;

class Fichas extends Component
{
    public $search;

    public function render()
    {

        $fichas = Ficha::join('programs', 'fichas.program_id', '=', 'programs.id')
                        ->select('fichas.*', 'programs.name as program_name')              
                        ->where('programs.name', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('code', 'LIKE', '%'.$this->search.'%')
                        ->paginate(10);
        return view('livewire.fichas', compact('fichas'));
    }
}
