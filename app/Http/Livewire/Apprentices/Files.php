<?php

namespace App\Http\Livewire\Apprentices;

use App\Models\Ficha;
use Livewire\Component;
use Livewire\WithPagination;

class Files extends Component
{
    use WithPagination;

    public $ficha;
    public $search;
    public $is_trashed;
    public $ficha_id;
    public $perPage = '10';
    
    protected $queryString = ['search' => ['except' => ''], 'perPage'];

    public function mount($ficha)
    {
        $fi = Ficha::withTrashed()->where('code', $ficha)->first();

        $this->is_trashed = $fi->trashed();
        $this->ficha = $fi->code;
        $this->ficha_id = $fi->id;
    }

    public function render()
    {
        $files = auth()->user()->files()
                        ->where('ficha_id', $this->ficha_id)
                        ->where('name', 'LIKE', '%'.$this->search.'%')
                        ->paginate($this->perPage);

        return view('livewire.apprentices.files', compact('files'))->layout('apprentices.files.index');
    }
}
