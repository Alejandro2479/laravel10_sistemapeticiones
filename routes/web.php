<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdminUsuarioController;
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

// RUTAS LOGIN
Route::get('/login', [SesionController::class, 'homeLogin'])->name('login.home');

Route::post('/login', [SesionController::class, 'guardarSesion'])->name('login.guardar');

Route::get('/logout', [SesionController::class, 'eliminarSesion'])->middleware('auth')->name('login.eliminar');

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
Route::get('/usuario/peticion/index', [UsuarioController::class, 'indexPeticion'])->middleware('auth.user')->name('usuario.peticion-index');

Route::get('/usuario/peticion/{peticion}/mostrar', [UsuarioController::class, 'mostrarPeticion'])->middleware('auth.user')->name('usuario.peticion-mostrar');

// RUTAS ADMINISTRADOR Y USUARIO
Route::get("/", function () {
    if (Auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.peticion-index');
        } elseif (auth()->user()->role === 'user') {
            return redirect()->route('usuario.peticion-index');
        }
    }
    return redirect()->route('login.index');
});

Route::put('/peticion/{peticion}/alternar-estatus', [AdminUsuarioController::class, 'alternarEstatusPeticion'])->middleware('auth')->name('peticion.alternar-estatus');

Route::fallback(fn () => abort(404));

