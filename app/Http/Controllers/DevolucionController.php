<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Devolucion;
use App\Models\Peticion;
use App\Models\User;
use App\Http\Requests\DevolucionRequest;


class DevolucionController extends Controller
{
    public function crearDevolucion(Peticion $peticion)
    {
        return view('user.devolver-peticion-user', ['peticion' => $peticion]);
    }

    public function guardarDevolucion(Peticion $peticion, DevolucionRequest $devolucionRequest)
    {
        $data = $devolucionRequest->validated();
        $data['peticion_id'] = $peticion->id;
        $data['user_id'] = Auth::id();

        Devolucion::create($data);

        return redirect()->route('user.peticion-index')->with('exito', 'Petición devuelta con éxito');
    }
}
