<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFichaRequest;
use App\Http\Requests\UpdateFichaRequest;
use App\Models\Ficha;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    public $fichaTypes = [
        'Auxiliar',
        'Espc. Tecnologica',
        'Operario',
        'Profundizacion Tecnica',
        'Tecnologo',
        'Tecnico'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.fichas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = \App\Models\Program::pluck('name', 'id')->toArray();

        return view('admin.fichas.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFichaRequest $request)
    {
        $validated = $request->validated();
        Ficha::create($validated);

        return redirect()->back()->with('success', 'Ficha creada correctamente :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function show(Ficha $ficha)
    {
        // $users = $ficha->users();
        return view('admin.fichas.show', compact('ficha'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function edit(Ficha $ficha)
    {
        return view('admin.fichas.edit', [
            'ficha' => $ficha,
            'programs' => \App\Models\Program::pluck('name', 'id')->toArray(),
            'types' => $this->fichaTypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFichaRequest $request, Ficha $ficha)
    {
        $validated = $request->validated();
        $ficha->update($validated);

        return redirect()->back()->with('success', 'Ficha Actualizada correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ficha $ficha)
    {
        $ficha->delete();

        return redirect()->route('fichas.index')->with('success', 'Ficha Actualizada correctamente :)');
    }
}