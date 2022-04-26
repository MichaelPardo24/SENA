<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Mail\test;
use App\Models\Ficha;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//programas
Route::resource('programs', \App\Http\Controllers\ProgramsController::class)
        ->except('show');
        
Route::resource('file-types', \App\Http\Controllers\FileTypeController::class);

// Fichas
Route::delete('ficha/{ficha:code}', [\App\Http\Controllers\FichaController::class, 'softDelete'])
        ->name('fichas.soft-delete');

// crud
Route::resource('fichas', \App\Http\Controllers\FichaController::class)
        ->except('show')
        ->scoped(['ficha' => 'code']);

// Archivos de usuarios por fichas
Route::get('fichas/{ficha:code}/apprentices-files', \App\Http\Livewire\Apprentices\Files::class)
        ->name('fichas.apprentices-files.index'); // Index controlado mediante livewire 

Route::resource('fichas.apprentices-files', \App\Http\Controllers\Apprentice\FilesController::class)
        ->parameters(['apprentices-files' => 'file'])
        ->scoped(['ficha' => 'code'])
        ->except('index')
        ->shallow();

Route::get('fichas/{ficha}/user/{user}', [\App\Http\Controllers\Fichas\ApprenticeController::class, 'downloadAllFiles'])
        ->withTrashed()
        ->name('fichas.apprentice-all-files.download');
// --------- Fin archivos de usuario por fichas

// Informacion del aprendiz por ficha
Route::get('fichas/{ficha:code}/apprentices/{user:document}', [\App\Http\Controllers\Fichas\ApprenticeController::class, 'show'])
        ->name('fichas.users.show');

Route::get('fichas/{ficha:code}/users', \App\Http\Livewire\Fichas\Apprentices::class)
        ->name('fichas.users.index');

// Route::resource('users.files', \App\Http\Controllers\UserFileController::class)->shallow();
Route::resource('user', UserController::class)
        ->except('show');

// Rutas de instructor tecnico
Route::get('instructor-tecnico/fichas/{ficha:code}/apprentices', [\App\Http\Controllers\InsTecnico\ApprenticesController::class, 'index'])
        ->withTrashed()
        ->name('ins-tecnico.fichas.apprentices');
// -------- Fin  rutas de instructor tecnico 


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
