<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Livewire\Component;

class Programs extends Component
{
    public $search;

    public function render()
    {

        $programs = Program::where('name', 'LIKE', '%'. $this->search .'%')
                            ->orWhere('type', 'LIKE', '%'. $this->search .'%')
                            ->withCount('fichas')
                            ->paginate(10);

        return view('livewire.programs', compact('programs'));
    }
}
