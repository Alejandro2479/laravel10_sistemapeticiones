<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PeticionController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SesionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('peticions.home');
});
*/

Route::get('/peticions', [PeticionController::class, 'homePeticion'])->name('peticions.home');

Route::get("/", fn () => redirect()->route('peticions.home'));

Route::get('/peticions/crear', [PeticionController::class, 'crearPeticion'])->name('peticions.crear');

Route::get('/peticions/{peticion}', [PeticionController::class, 'mostrarPeticion'])->name('peticions.mostrar');

Route::get('/tasks/{peticion}/peticion', [PeticionController::class, 'editarPeticion'])->name('peticions.editar');

Route::post('/peticions', [PeticionController::class, 'guardarPeticion'])->name('peticions.guardar');

Route::put('/peticions/{peticion}', [PeticionController::class, 'actualizarPeticion'])->name('peticions.actualizar');

Route::delete('/peticions/{peticion}', [PeticionController::class, 'eliminarPeticion'])->name('peticions.eliminar');

Route::put('/peticions/{peticion}/alternar-estatus', [PeticionController::class, 'alternarEstatusPeticion'])->name('peticions.alternar-estatus');

Route::get('/registro', [RegistroController::class, 'create'])->name('register.index');

Route::post('/registro', [RegistroController::class, 'store'])->name('register.store');

Route::get('/login', [SesionController::class, 'create'])->name('login.index');

Route::fallback(fn () => abort(404));
