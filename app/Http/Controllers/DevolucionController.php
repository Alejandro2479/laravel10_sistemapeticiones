<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;

class DevolucionController extends Controller
{
    public function historialDevoluciones(Peticion $peticion)
    {
        return view('devolucion.historial-devoluciones', ['peticion' => $peticion]);
    }
}
