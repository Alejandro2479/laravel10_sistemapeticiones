<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use App\Models\User;
use App\Models\Devolucion;
use App\Http\Requests\ReasignarPeticionRequest;

class DevolucionController extends Controller
{
    public function indexDevolucion()
    {
        $devoluciones = Devolucion::where('estatus', false)->oldest()->paginate(10);

        return view('devolucion.index-devolucion', ['devoluciones' => $devoluciones]);
    }

    public function reasignarDevolucion(Devolucion $devolucion)
    {
        $idUsuarios = $devolucion->peticion->users->pluck('id');

        $users = User::where('rol', 'user')->whereNotIn('id', $idUsuarios)->get();

        return view('devolucion.reasignar-devolucion', ['devolucion' => $devolucion, 'users' => $users]);
    }

    public function actualizarPeticion(ReasignarPeticionRequest $reasignarPeticionRequestrequest, Devolucion $devolucion)
    {
        $data = $reasignarPeticionRequestrequest->validated();
        $nuevoUserId = $data['user_id'];

        $peticion = $devolucion->peticion;
        $peticion->users()->updateExistingPivot($devolucion->user_id, ['user_id' => $nuevoUserId]);

        $devolucion->estatus = true;
        $devolucion->save();

        return redirect()->route('all.devoluciones-index')->with('exito', 'Petición reasignada con éxito');
    }

    public function historialDevolucion(Peticion $peticion)
    {
        return view('devolucion.historial-devolucion', ['peticion' => $peticion,]);
    }
}
