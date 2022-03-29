<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ficha;
use Livewire\WithPagination;

class Fichas extends Component
{
    use WithPagination;
  
    protected $queryString = ['search' => ['except' => ''], 'perPage'];
  
    public $search;
    public $perPage = '10';

    public function render()
    {

        $fichas = Ficha::join('programs', 'fichas.program_id', '=', 'programs.id')
                        ->select('fichas.*', 'programs.name as program_name')              
                        ->where('programs.name', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('code', 'LIKE', '%'.$this->search.'%')
                        ->orderBy('programs.name', 'asc')
                        ->paginate($this->perPage);
                        
        return view('livewire.fichas', compact('fichas'));
    }
}
