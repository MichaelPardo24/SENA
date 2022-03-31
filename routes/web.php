<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
});

Route::delete('ficha/{ficha:code}', [\App\Http\Controllers\FichaController::class, 'softDelete'])->name('fichas.soft-delete');
Route::resource('fichas', \App\Http\Controllers\FichaController::class)->scoped(['ficha' => 'code']);
Route::resource('programs', \App\Http\Controllers\ProgramsController::class);
Route::resource('file-types', \App\Http\Controllers\FileTypeController::class);

// Archivos de aprendices
Route::resource('fichas.apprentices-files', \App\Http\Controllers\Apprentice\FilesController::class)
        ->parameters(['apprentices-files' => 'file'])
        ->scoped(['ficha' => 'code'])
        ->except('index')
        ->shallow();

Route::get('fichas/{ficha:code}/apprentices-files', \App\Http\Livewire\Apprentices\Files::class)->name('fichas.apprentices-files.index');


Route::resource('users.files', \App\Http\Controllers\UserFileController::class)->shallow();
Route::resource('user', UserController::class);

Route::get('fichas/{ficha}/users', \App\Http\Livewire\Fichas\Apprentices::class)->name('fichas.users.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');