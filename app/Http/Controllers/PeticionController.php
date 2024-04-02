<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use App\Http\Requests\PeticionRequest;

class PeticionController extends Controller
{
    public function crearPeticion()
    {
        return view('peticions.crear-peticion');
    }

    public function mostrarPeticion(Peticion $peticion)
    {
        return view('peticions.mostrar-peticion', ['peticion' => $peticion]);
    }

    public function editarPeticion(Peticion $peticion)
    {
        return view('peticions.editar-peticion', ['peticion' => $peticion]);
    }

    public function guardarPeticion(PeticionRequest $peticionRequest)
    {
        $peticion = Peticion::create($peticionRequest->validated());

        return redirect()->route('home')->with('exito', 'Petición creada con exito');
    }

    public function actualizarPeticion(Peticion $peticion, PeticionRequest $peticionRequest)
    {
        $peticion->update($peticionRequest->validated());

        // return redirect()->route('peticions.mostrar', ['peticion' => $peticion->id])->with('exito', 'Petición editada con exito');
        return redirect()->route('home')->with('exito', 'Petición editada con exito');
    }

    public function eliminarPeticion(Peticion $peticion)
    {
        $peticion->delete();

        return redirect()->route('home')->with('exito', 'Petición eliminada con exito');
    }

    public function alternarEstatusPeticion(Peticion $peticion)
    {
        $peticion->alternarPeticion();

        return redirect()->back()->with('exito', 'Petición actualizada con exito');
    }
}
