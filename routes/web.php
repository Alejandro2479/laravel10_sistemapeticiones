<?php

use App\Http\Controllers\PeticionController;
use Illuminate\Support\Facades\Route;

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
