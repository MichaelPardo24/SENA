<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('fichas', \App\Http\Controllers\FichaController::class);
Route::resource('programs', \App\Http\Controllers\ProgramsController::class);


Route::resource('file-types', \App\Http\Controllers\FileTypeController::class);

Route::resource('users.files', \App\Http\Controllers\UserFileController::class)->shallow();

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
