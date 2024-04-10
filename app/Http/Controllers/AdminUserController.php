<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;

class AdminUserController extends Controller
{
    public function alternarEstatusPeticion(Peticion $peticion)
    {
        $peticion->alternarPeticion();

        return redirect()->back()->with('exito', 'Petición actualizada con exito');
    }
}
