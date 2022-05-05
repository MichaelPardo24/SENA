<?php

namespace App\Http\Controllers;

use App\Models\FileType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:file-types_index')->only('index');
        $this->middleware('can:file-types_create')->only('create', 'store');
        $this->middleware('can:file-types_show')->only('show');
        $this->middleware('can:file-types_edit')->only('edit', 'update');
        $this->middleware('can:file-types_destroy')->only('destroy');
    }

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
        $request->validate([
            'name' => ['required'],
            'file' => ['required', 'mimes:pdf,docx,xls,xlsx', 'max:2000'],
        ]);

        $url = Storage::putFile('docs', $request->file('file'));

        //obtenemos la extension del archivo
        $ext = $request->file('file')->getClientOriginalExtension();

        FileType::create([
            //nombramos la columna name con el nombre, mas la extensión
            'name' => $request->name . "." . $ext,
            'url'  => $url
        ]);

        return redirect()->back()->with('success', 'El archivo ha sido subido correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType)
    {
        return Storage::download($fileType->url, $fileType->name);

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

        return redirect()->back()->with('success', 'El archivo ha sido modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType)
    {
        if (Storage::exists($fileType->url)) {
            Storage::delete($fileType->url);
        }

        $fileType->delete();

        return redirect()->route('file-types.index')->with('success', 'El archivo ha sido eliminado correctamente');
    }
}