<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use App\Http\Requests\PeticionRequest;
use App\Models\User;
use App\Http\Requests\UserRequest;

class AdminController extends Controller
{
    public function indexPeticion()
    {
        return view('admin.index-peticion-admin', ['peticions' => Peticion::latest()->paginate(10)]);
    }

    /*
    public function indexPeticion()
    {
        $peticionesIncompletas = Peticion::where('estatus', false)->latest()->paginate(10);

        return view('index', ['peticions' => $peticionesIncompletas]);
    }
    */

    public function crearPeticion()
    {
        return view('admin.crear-peticion-admin');
    }

    public function mostrarPeticion(Peticion $peticion)
    {
        return view('admin.mostrar-peticion-admin', ['peticion' => $peticion]);
    }

    public function editarPeticion(Peticion $peticion)
    {
        return view('admin.editar-peticion-admin', ['peticion' => $peticion]);
    }

    public function guardarPeticion(PeticionRequest $peticionRequest)
    {
        $peticion = Peticion::create($peticionRequest->validated());

        return redirect()->route('admin.peticion-index')->with('exito', 'Petición creada con exito');
    }

    public function actualizarPeticion(Peticion $peticion, PeticionRequest $peticionRequest)
    {
        $peticion->update($peticionRequest->validated());

        // return redirect()->route('peticions.mostrar', ['peticion' => $peticion->id])->with('exito', 'Petición editada con exito');
        return redirect()->route('admin.peticion-index')->with('exito', 'Petición editada con exito');
    }

    public function eliminarPeticion(Peticion $peticion)
    {
        $peticion->delete();

        return redirect()->route('admin.peticion-index')->with('exito', 'Petición eliminada con exito');
    }

    public function indexUsuario()
    {
        return view('admin.index-usuario-admin', ['users' => User::latest()->get()]);
    }

    public function crearUsuario()
    {
        return view('admin.crear-usuario-admin');
    }

    public function guardarUsuario(UserRequest $userRequest)
    {
        $peticion = User::create($userRequest->validated());

        return redirect()->route('admin.peticion-index')->with('exito', 'Usuario creado con exito');
    }

    //
    //

    // Este metodo debe ir en otro controlador compartido
    public function alternarEstatusPeticion(Peticion $peticion)
    {
        $peticion->alternarPeticion();

        return redirect()->back()->with('exito', 'Petición actualizada con exito');
    }
}
