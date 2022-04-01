<?php

namespace App\Http\Controllers\Fichas;

use App\Http\Controllers\Controller;
use App\Models\Ficha;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

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
    public function downloadAllFiles(?Ficha $ficha, User $user)
    {
        $zip = new ZipArchive;
        $zipName = 'archivos.zip';

        $files = $user->files();

        if ($ficha) {
            $files->where('ficha_id', $ficha->id);
        }

        if ($zip->open(Storage::path('zip/'. $zipName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {

            $downloadFiles = $files->get();

            foreach ($downloadFiles as $file) {    
                if (Storage::exists($file->url)) {
                    $extension = \Illuminate\Support\Facades\File::extension($file->url);
                    $zip->addFile(Storage::path($file->url), $file->name.'.'.$extension);
                }
            }

            $zip->close();
            return response()->download(Storage::path('zip/'. $zipName));
        }

        return redirect()->back()->with('fail', "Can't create a zip file :(");
    }
}
