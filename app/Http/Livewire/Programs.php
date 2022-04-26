<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Livewire\Component;
use Livewire\WithPagination;

class Programs extends Component
{
    use WithPagination;

    protected $queryString = ['search' => ['except' => ''], 'perPage'];

    public $search;

    public $perPage = '10';
    public $message = null;

    public function mount($message)
    {
        $this->message = $message;
    }

    public function closeAlert(){
        $this->message = Null;
    }

    public function render()
    {

        $programs = Program::where('name', 'LIKE', '%'. $this->search .'%')
                            ->orWhere('type', 'LIKE', '%'. $this->search .'%')
                            ->withCount('fichas')
                            ->paginate($this->perPage);

        return view('livewire.programs')->with(['programs' => $programs, 'message' => $this->message]);
    }
}
