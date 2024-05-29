<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use App\Models\Devolucion;

class DevolucionController extends Controller
{
    public function indexDevolucion()
    {
        return view('devolucion.index-devolucion', ['devoluciones' => Devolucion::oldest()->paginate(10)]);
    }

    public function reasignarDevolucion(Devolucion $devolucion)
    {
        return view('devolucion.reasignar-devolucion', ['devolucion' => $devolucion]);
    }

    public function historialDevolucion(Peticion $peticion)
    {
        return view('devolucion.historial-devolucion', ['peticion' => $peticion]);
    }
}
