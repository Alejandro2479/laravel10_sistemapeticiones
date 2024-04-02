<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeticionController;
use App\Http\Controllers\UserController;
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

Route::get('/home', [HomeController::class, 'home'])->middleware('auth')->name('home');

Route::get("/", fn () => redirect()->route('home'));

Route::get('/peticions/crear', [PeticionController::class, 'crearPeticion'])->name('peticions.crear');

Route::get('/peticions/{peticion}', [PeticionController::class, 'mostrarPeticion'])->name('peticions.mostrar');

Route::get('/tasks/{peticion}/peticion', [PeticionController::class, 'editarPeticion'])->name('peticions.editar');

Route::post('/peticions', [PeticionController::class, 'guardarPeticion'])->name('peticions.guardar');

Route::put('/peticions/{peticion}', [PeticionController::class, 'actualizarPeticion'])->name('peticions.actualizar');

Route::delete('/peticions/{peticion}', [PeticionController::class, 'eliminarPeticion'])->name('peticions.eliminar');

Route::put('/peticions/{peticion}/alternar-estatus', [PeticionController::class, 'alternarEstatusPeticion'])->name('peticions.alternar-estatus');

Route::get('/usuarios/crear', [UserController::class, 'crearUsuario'])->name('users.crear');

Route::post('/usuarios', [UserController::class, 'guardarUsuario'])->name('users.guardar');

Route::get('/login', [SesionController::class, 'create'])->middleware('guest')->name('login.index');

Route::post('/login', [SesionController::class, 'store'])->name('login.store');

Route::get('/logout', [SesionController::class, 'destroy'])->middleware('auth')->name('login.destroy');

Route::fallback(fn () => abort(404));
