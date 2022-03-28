<?php

namespace App\Http\Livewire;

// use App\Models\File;
use App\Models\User;
use Livewire\Component;

class UserFiles extends Component
{
    public $search;

    public function render()
    {
        $files = auth()->user()->files()
                    ->where('name', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('name', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('name', 'LIKE', '%'.$this->search.'%')
                    ->paginate(10);

        return view('livewire.user-files', compact('files'));
    }
}
