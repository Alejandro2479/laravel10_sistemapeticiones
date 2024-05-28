<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;

class DevolucionController extends Controller
{
    public function mostrarDevoluciones(Peticion $peticion)
    {
        return view('devolucion.mostrar-devoluciones', ['peticion' => $peticion]);
    }
}
