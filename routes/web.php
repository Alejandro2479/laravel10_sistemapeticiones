<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
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
Route::get('/admin/peticion/index', [AdminController::class, 'indexPeticion'])->middleware('auth.admin')->name('admin.peticion-index');
Route::get('/admin/peticion/crear', [AdminController::class, 'crearPeticion'])->middleware('auth.admin')->name('admin.peticion-crear');
Route::get('/admin/peticion/{peticion}/mostrar', [AdminController::class, 'mostrarPeticion'])->middleware('auth.admin')->name('admin.peticion-mostrar');
Route::get('/admin/peticion/{peticion}/editar', [AdminController::class, 'editarPeticion'])->middleware('auth.admin')->name('admin.peticion-editar');
Route::post('/admin/peticion/crear/guardar', [AdminController::class, 'guardarPeticion'])->middleware('auth.admin')->name('admin.peticion-guardar');
Route::put('/admin/peticion/{peticion}/editar/actualizar', [AdminController::class, 'actualizarPeticion'])->middleware('auth.admin')->name('admin.peticion-actualizar');
Route::delete('/admin/peticion/{peticion}/editar/eliminar', [AdminController::class, 'eliminarPeticion'])->middleware('auth.admin')->name('admin.peticion-eliminar');
Route::get('/admin/usuario/index', [AdminController::class, 'indexUsuario'])->middleware('auth.admin')->name('admin.usuario-index');
Route::get('/admin/usuario/crear', [AdminController::class, 'crearUsuario'])->middleware('auth.admin')->name('admin.usuario-crear');
Route::post('/admin/usuario/crear/guardar', [AdminController::class, 'guardarUsuario'])->middleware('auth.admin')->name('admin.usuario-guardar');

// RUTAS USUARIO


// RUTAS ADMINISTRADOR Y USUARIO
// Editar rutas
Route::get('/login', [SesionController::class, 'create'])->name('login.index');
Route::post('/login', [SesionController::class, 'store'])->name('login.store');
Route::get('/logout', [SesionController::class, 'destroy'])->middleware('auth')->name('login.destroy');

// Modificar esta ruta ya que es de admin y user
Route::put('/peticions/{peticion}/alternar-estatus', [AdminController::class, 'alternarEstatusPeticion'])->middleware('auth')->name('peticions.alternar-estatus');

// Modificar esta ruta por si es admin o user
Route::get("/", fn () => redirect()->route('index'));

Route::fallback(fn () => abort(404));

