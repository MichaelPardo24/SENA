<?php

namespace App\Http\Controllers\Apprentice;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    protected $types;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->types = \App\Models\FileType::pluck('name', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apprentices.files.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', File::class);
        
        return view('apprentices.files.create', [
            'types' => $this->types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:pdf,docx,xls,xlsx', 'max:2000'],
            'type_id' => ['required', 'exists:file_types,id']
        ]);

        $url  = Storage::putFile('apprentices/docs/'.auth()->id(), $request->file('file'));
        $name = Str::slug($this->types[$request->type_id]);

        $request->user()->files()->create([
            'name'    => $name,
            'url'     => $url,
            'type_id' => $request->type_id
        ]);

        return redirect()->back()->with('success', 'Archivo subido correctamente :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return Storage::download($file->url, $file->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('apprentices.files.edit', [
            'types' => $this->types,
            'file' => $file,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $request->validate([
            'type_id' => ['required', 'exists:file_types,id', 'max:2000']
        ]);

        $name = Str::slug($this->types[$request->type_id]);

        $file->update([
            'name' => $name,
            'type_id' => $request->type_id
        ]);

        return redirect()->back()->with('success', 'Archivo actualizado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        if (Storage::exists($file->url)) {
            Storage::delete($file->url);
        }

        $file->delete();

        return redirect()->route('apprentices-files.index')->with('success', 'Archivo eliminado correctamente :)');
    }
}
