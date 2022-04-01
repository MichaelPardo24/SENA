<?php

namespace App\Http\Livewire\Extra;

use App\Models\User;
use Livewire\Component;

class ShowFiles extends Component
{
    public $open = false;
    public $files;
    public $user;
    public $ficha;
    public $userNmae;

    public function mount($user, $ficha)
    {
        $this->user = User::find($user);
        $this->ficha = $ficha;
        $this->userName = $this->user->profile->names .' '.$this->user->profile->surnames;

        $this->files = $this->user->files()->where('ficha_id', $ficha)->get(); 
    }

    public function render()
    {
        return view('livewire.extra.show-files', [
            'userFiles' => $this->files,
            'userName'  => $this->userName, 
            'user'      => $this->user, 
            'ficha'     => $this->ficha]);
    }
}
