<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use App\Models\User;
use App\Models\Devolucion;

class DevolucionController extends Controller
{
    public function indexDevolucion()
    {
        return view('devolucion.index-devolucion', ['devoluciones' => Devolucion::oldest()->paginate(10)]);
    }

    public function reasignarDevolucion(Devolucion $devolucion)
    {
        $idUsuarios = $devolucion->peticion->users->pluck('id');

        $users = User::where('rol', 'user')
            ->whereNotIn('id', $idUsuarios)
            ->get();

        return view('devolucion.reasignar-devolucion', ['devolucion' => $devolucion, 'users' => $users]);
    }

    public function historialDevolucion(Peticion $peticion)
    {
        return view('devolucion.historial-devolucion', ['peticion' => $peticion]);
    }
}
