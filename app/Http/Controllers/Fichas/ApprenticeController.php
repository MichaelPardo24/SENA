<?php

namespace App\Http\Controllers\Fichas;

use App\Http\Controllers\Controller;
use App\Models\Ficha;
use App\Models\User;
use Illuminate\Http\Request;

class ApprenticeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ficha  $ficha
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Ficha $ficha, User $user)
    {
        return view('admin.fichas.users.show', [
            'user'  => $user,
            'ficha' => $ficha
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ficha  $ficha
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Ficha $ficha, User $user)
    {
        //
    }
}
