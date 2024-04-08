<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function indexPeticion()
    {
        $userId = Auth::id();
        
        $peticiones = Peticion::where([
            ['user_id', $userId],
            ['estatus', false]
        ])->latest()->paginate(10);
    
        return view('usuario.index-peticion-usuario', ['peticiones' => $peticiones]);
    }
    

    public function indexPeticionCompleta()
    {
        $userId = Auth::id();
        
        $peticiones = Peticion::where([
            ['user_id', $userId],
            ['estatus', true]
        ])->latest()->paginate(10);
    
        return view('usuario.index-peticion-usuario', ['peticiones' => $peticiones]);
    }

    public function mostrarPeticion(Peticion $peticion)
    {
        return view('usuario.mostrar-peticion-usuario', ['peticion' => $peticion]);
    }
}
