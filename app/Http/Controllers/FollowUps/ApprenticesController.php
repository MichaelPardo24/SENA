<?php

namespace App\Http\Controllers\FollowUps;

use App\Models\User;
use App\Models\Ficha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApprenticesController extends Controller
{
    /**
     * Muestra las fichas las cuales han sido asignadas 
     * al instructor de seguimiento en sesión.
     */
    public function index()
    {
        return view('follow-ups.index');
    }

    /**
     * Muestra los aprendices (con estado 'preparado') 
     * relacionados a la ficha dada.
     * 
     * @param \app\Models\Ficha $ficha
     */
    public function showApprenticesByFicha(Ficha $ficha)
    {
        return view('follow-ups.apprentices.by-ficha', ['ficha' => $ficha]);
    }

    /**
     * Muestra el seguimiento de un aprendiz asociado
     * mediante una ficha.
     * 
     * @param \app\Models\Ficha $ficha
     * @param \app\Models\User $user 
     */
    public function showFollowByFicha(Ficha $ficha, User $user)
    {
        $followUp =  $ficha->followUps()->where('apprentice_id', $user->id)->first();
        $user->load('profile');

        return view('follow-ups.follow-up', ['ficha' => $ficha, 'followUp' => $followUp, 'apprentice' => $user]);
    }
}
