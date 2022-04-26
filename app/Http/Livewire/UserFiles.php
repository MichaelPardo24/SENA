<?php

namespace App\Http\Livewire;

// use App\Models\File;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserFiles extends Component
{
    use WithPagination;

    public $user;

    protected $queryString = ['search' => ['except' => ''], 'perPage'];

    public $search;

    public $perPage = '10';


    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $files = User::find($this->user)->first()->files()
                        ->where('name', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('name', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('name', 'LIKE', '%'.$this->search.'%')
                        ->paginate($this->perPage);

        return view('livewire.user-files', compact('files'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
