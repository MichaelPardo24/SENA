<?php

namespace App\Http\Controllers\InsTecnico;

use App\Http\Controllers\Controller;
use App\Models\Ficha;
use Illuminate\Http\Request;

class ApprenticesController extends Controller
{
    public function index(Ficha $ficha)
    {
        return view('ins-tecnico.apprentices.index', [
            'ficha' => $ficha
        ]);
    }
}
