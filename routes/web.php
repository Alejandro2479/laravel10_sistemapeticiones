<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
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

// RUTAS ADMNISTRADOR
Route::get('/index', [IndexController::class, 'index'])->middleware('auth.admin')->name('index');
Route::get("/", fn () => redirect()->route('index'));
Route::get('/peticions/crear', [PeticionController::class, 'crearPeticion'])->middleware('auth.admin')->name('peticions.crear');
Route::get('/peticions/{peticion}', [PeticionController::class, 'mostrarPeticion'])->middleware('auth.admin')->name('peticions.mostrar');
Route::get('/tasks/{peticion}/peticion', [PeticionController::class, 'editarPeticion'])->middleware('auth.admin')->name('peticions.editar');
Route::post('/peticions', [PeticionController::class, 'guardarPeticion'])->middleware('auth.admin')->name('peticions.guardar');
Route::put('/peticions/{peticion}', [PeticionController::class, 'actualizarPeticion'])->middleware('auth.admin')->name('peticions.actualizar');
Route::delete('/peticions/{peticion}', [PeticionController::class, 'eliminarPeticion'])->middleware('auth.admin')->name('peticions.eliminar');
Route::get('/users', [UserController::class, 'indexUsuario'])->middleware('auth.admin')->name('users.index');
Route::get('/users/crear', [UserController::class, 'crearUsuario'])->middleware('auth.admin')->name('users.crear');
Route::post('/users', [UserController::class, 'guardarUsuario'])->middleware('auth.admin')->name('users.guardar');

// RUTAS USUARIO


// RUTAS ADMINISTRADOR Y USUARIO
Route::get('/login', [SesionController::class, 'create'])->name('login.index');
Route::post('/login', [SesionController::class, 'store'])->name('login.store');
Route::get('/logout', [SesionController::class, 'destroy'])->middleware('auth')->name('login.destroy');
Route::put('/peticions/{peticion}/alternar-estatus', [PeticionController::class, 'alternarEstatusPeticion'])->middleware('auth')->name('peticions.alternar-estatus');

Route::fallback(fn () => abort(404));
