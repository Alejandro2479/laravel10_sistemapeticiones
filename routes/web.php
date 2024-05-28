<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DevolucionController;
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

Route::get('/admin/peticion/index-completas', [AdminController::class, 'indexPeticionCompleta'])->middleware('auth.admin')->name('admin.peticion-completa-index');

Route::get('/admin/peticion/crear', [AdminController::class, 'crearPeticion'])->middleware('auth.admin')->name('admin.peticion-crear');

Route::get('/admin/peticion/{peticion}/mostrar', [AdminController::class, 'mostrarPeticion'])->middleware('auth.admin')->name('admin.peticion-mostrar');

Route::get('/admin/peticion/{peticion}/editar', [AdminController::class, 'editarPeticion'])->middleware('auth.admin')->name('admin.peticion-editar');

Route::post('/admin/peticion/crear/guardar', [AdminController::class, 'guardarPeticion'])->middleware('auth.admin')->name('admin.peticion-guardar');

Route::put('/admin/peticion/{peticion}/editar/actualizar', [AdminController::class, 'actualizarPeticion'])->middleware('auth.admin')->name('admin.peticion-actualizar');

Route::delete('/admin/peticion/{peticion}/editar/eliminar', [AdminController::class, 'eliminarPeticion'])->middleware('auth.admin')->name('admin.peticion-eliminar');

Route::get('/admin/user/index', [AdminController::class, 'indexUser'])->middleware('auth.admin')->name('admin.user-index');

Route::get('/admin/user/crear', [AdminController::class, 'crearUser'])->middleware('auth.admin')->name('admin.user-crear');

Route::get('/admin/user/{user}/editar', [AdminController::class, 'editarUser'])->middleware('auth.admin')->name('admin.user-editar');

Route::post('/admin/user/crear/guardar', [AdminController::class, 'guardarUser'])->middleware('auth.admin')->name('admin.user-guardar');

Route::put('/admin/user/{user}/editar/actualizar', [AdminController::class, 'actualizarUser'])->middleware('auth.admin')->name('admin.user-actualizar');

Route::delete('/admin/user/{user}/eliminar', [AdminController::class, 'eliminarUser'])->middleware('auth.admin')->name('admin.user-eliminar');

Route::put('/admin/peticion/{peticion}/alternar-estatus', [AdminController::class, 'alternarEstatusPeticion'])->middleware('auth.admin')->name('admin.peticion-alternar');

// RUTAS USUARIO
Route::get('/user/peticion/index', [UserController::class, 'indexPeticion'])->middleware('auth.user')->name('user.peticion-index');

Route::get('/user/peticion/index-completas', [UserController::class, 'indexPeticionCompleta'])->middleware('auth.user')->name('user.peticion-completa-index');

Route::get('/user/peticion/{peticion}/mostrar', [UserController::class, 'mostrarPeticion'])->middleware('auth.user')->name('user.peticion-mostrar');

Route::get('/user/peticion/{peticion}/mostrar/completar', [UserController::class, 'completarPeticion'])->middleware('auth.user')->name('user.peticion-completar');

Route::put('/user/peticion/{peticion}/mostrar/completar/alternar-estatus', [UserController::class, 'alternarEstatusPeticion'])->middleware('auth.user')->name('user.peticion-alternar');

Route::get('/user/peticion/{peticion}/mostrar/devolver', [UserController::class, 'crearDevolucion'])->middleware('auth.user')->name('user.peticion-devolucion');

Route::post('/user/peticion/{peticion}/mostrar/devolver/guardar', [UserController::class, 'guardarDevolucion'])->middleware('auth.user')->name('user.peticion-devolver');

// RUTAS ADMINISTRADOR Y USUARIO
Route::get('/all/peticion/{peticion}/mostrar/devoluciones', [DevolucionController::class, 'mostrarDevoluciones'])->middleware('auth')->name('all.devoluciones-mostrar');

Route::get("/", function () {
    if (Auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.peticion-index');
        } elseif (auth()->user()->role === 'user') {
            return redirect()->route('user.peticion-index');
        }
    }
    return redirect()->route('login.home');
});

Route::fallback(fn () => abort(404));
