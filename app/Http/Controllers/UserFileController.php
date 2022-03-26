<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserFileController extends Controller
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('admin.files.user.index', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('admin.files.user.create', [
            'types' => $this->types,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'file' => ['required', 'mimes:pdf,docx,xls,xlsx'],
            'type_id' => ['required', 'exists:file_types,id']
        ]);

        $url = Storage::putFile('users/docs', $request->file('file'));
        $name = Str::slug($this->types[$request->type_id]);

        $user->files()->create([
            'name' => $name,
            'url' => $url,
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
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('admin.files.user.edit', [
            'types' => $this->types,
            'file' => $file,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $request->validate([
            'type_id' => ['required', 'exists:file_types,id']
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
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->delete();

        if (Storage::exists($file->url)) {
            Storage::delete($file->url);
        }

        return redirect()->route('users.files.index', auth()->user())->with('success', 'Archivo eliminado correctamente :)');
    }
}
