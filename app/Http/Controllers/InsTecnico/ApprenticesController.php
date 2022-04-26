<?php

namespace App\Http\Controllers\InsTecnico;

use App\Http\Controllers\Controller;
use App\Models\Ficha;
use Illuminate\Http\Request;

class ApprenticesController extends Controller
{
    public function index(Ficha $ficha)
    {
        $fichas = Ficha::withTrashed()->withCount('users')->whereHas('users.roles', function ($q) {
            $q->where('roles.name', 'Instructor Tecnico');
            $q->where('users.id', auth()->id());
        })
        ->get();

        foreach ($fichas as $authenticatedUserFicha) {
            if ($authenticatedUserFicha->code == $ficha->code) {
                return view('ins-tecnico.apprentices.index', [
                    'ficha' => $ficha
                ]);
            }
        }
        abort(404);
    }
}
