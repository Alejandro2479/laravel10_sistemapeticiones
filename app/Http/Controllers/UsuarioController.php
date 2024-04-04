<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;

class UsuarioController extends Controller
{
    public function indexPeticion()
    {
        return view('usuario.index-peticion-usuario', ['peticions' => Peticion::latest()->paginate(10)]);
    }
}
