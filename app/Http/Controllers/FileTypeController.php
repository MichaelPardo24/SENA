<?php

namespace App\Http\Controllers;

use App\Models\FileType;
use Illuminate\Http\Request;

class FileTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.file-type.index', [
            'fileTypes' => FileType::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.file-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required']
        ]);

        FileType::create($validated);

        return redirect()->back()->with('success', 'FileType creado correctamente :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType)
    {
        return view('admin.file-type.show', [
            'fileType' => $fileType
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType)
    {
        return view('admin.file-type.edit', [
            'fileType' => $fileType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileType $fileType)
    {
        $validated = $request->validate([
            'name' => ['required']
        ]);

        $fileType->update($validated);

        return redirect()->back()->with('success', 'FileType actualizado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType)
    {
        $fileType->delete();

        return redirect()->route('file-types.index')->with('success', 'FileType eliminado correctamente :)');
    }
}
