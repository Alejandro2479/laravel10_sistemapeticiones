<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;

class PeticionController extends Controller
{
    public function homePeticion()
    {
        return view('peticions.home', ['peticions' => Peticion::latest()->paginate(10)]);
    }

    public function crearPeticion()
    {
        return view('peticions.crear-peticion');
    }

    public function crearUsuario()
    {
        return view('peticions.crear-usuario');
    }

    public function eliminarPeticion(Peticion $peticion)
    {
        $peticion->delete();

        return redirect()->back()->with('exito', 'Peticion eliminada con exito');
    }
}
