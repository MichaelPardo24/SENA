<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ficha;
use Livewire\WithPagination;

class Fichas extends Component
{
    use WithPagination;
  
    protected $queryString = ['search' => ['except' => ''], 'perPage'];
  
    public $search, $item;
    public $showSoftDeletes = false;
    public $perPage = '10';
    public $open_destroy = false;
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
        if ($this->showSoftDeletes == True) {
            $fichas = Ficha::onlyTrashed()
                        ->Where('code', 'LIKE', '%'.$this->search.'%')
                        ->orderBy('id', 'desc')
                        ->paginate($this->perPage);
        } else {
            $fichas = Ficha::join('programs', 'fichas.program_id', '=', 'programs.id')
                        ->select('fichas.*', 'programs.name as program_name')        
                        ->where('programs.name', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('code', 'LIKE', '%'.$this->search.'%')
                        ->orderBy('programs.name', 'desc')
                        ->paginate($this->perPage);
        }
        return view('livewire.fichas')->with(['fichas' => $fichas, 'message' => $this->message]);
    }

    public function restore($id)
    {
        $this->item = Ficha::onlyTrashed()->find($id);
        $this->item->restore();
        $this->message = 'La ficha ' . $this->item->code . ' se ha desarchivado satisfactoriamente';
    }

    public function destroy($id)
    {
        $this->item = Ficha::onlyTrashed()->find($id);
        $this->open_destroy = true;
        $this->message = 'La ficha ' . $this->item->code . ' se ha eliminado satisfactoriamente';
    }

    public function confirmDestroy()
    {
        $this->item->forceDelete();
        $this->reset(['open_destroy']);
    }
}
