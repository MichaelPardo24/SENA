<?php

namespace App\Http\Livewire\Extra;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class ChangeUserStatus extends Component
{
    public $user;
    public $status;
    public $fichaId;
    public $userStatus;
    public $selectedStatus;

    public function mount($user = null, $ficha = null)
    {
        $this->user = $user ?? Route::current()->parameter('user');

        $this->status = [
            'Certificado',
            'Finalizado',
            'Pendiente',
            'Preparado'
        ];

        $this->fichaId = $ficha ?? Route::current()->parameter('ficha')->id;

        $this->userStatus = $this->user->fichas()
                ->withTrashed()
                ->where('ficha_id', $this->fichaId)
                ->first()
                ->pivot->status;

        $this->selectedStatus = $this->userStatus;
    }

    public function render()
    {
        return view('livewire.extra.change-user-status', ['status' => $this->status, 'userStatus' => $this->userStatus]);
    }

    public function updatedSelectedStatus()
    {
        try {
            $this->user->fichas()->updateExistingPivot($this->fichaId, [
                'status' => $this->selectedStatus,
            ]);

            $this->emit('status-changed');
        } catch (\Throwable $th) {
            $this->emit('status-failed');
        }
    }
}
