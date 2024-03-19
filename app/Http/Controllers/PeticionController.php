<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use App\Http\Requests\PeticionRequest;

class PeticionController extends Controller
{
    public function homePeticion()
    {
        return view('peticions.home', ['peticions' => Peticion::latest()->paginate(10)]);
    }

    public function crearPeticion()
    {
        return view('peticions.crear');
    }

    public function mostrarPeticion(Peticion $peticion)
    {
        return view('peticions.mostrar', ['peticion' => $peticion]);
    }

    public function guardarPeticion(PeticionRequest $peticionRequest)
    {
        $peticion = Peticion::create($peticionRequest->validated());

        return redirect()->route('peticions.home')->with('exito', 'Petición creada con exito');
    }

    public function eliminarPeticion(Peticion $peticion)
    {
        $peticion->delete();

        return redirect()->route('peticions.home')->with('exito', 'Petición eliminada con exito');
    }
}
