<?php

namespace App\Http\Livewire\Extra;

use App\Models\User;
use Livewire\Component;

class ShowFiles extends Component
{
    public $open = false;
    public $files;
    public $user;

    public function mount($user, $ficha)
    {
        $usu = User::find($user);

        $this->user = $usu->profile->names .' '.$usu->profile->surnames;

        $this->files = $usu->files()->where('ficha_id', $ficha)->get(); 
    }

    public function render()
    {
        return view('livewire.extra.show-files', ['userFiles' => $this->files, 'userName' => $this->user]);
    }
}
