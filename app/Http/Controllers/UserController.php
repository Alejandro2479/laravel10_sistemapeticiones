<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function indexPeticion(Request $request)
    {
        $userId = Auth::id();
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where([['user_id', $userId],['estatus', false]])->oldest()->paginate(10);
    
        return view('user.index-peticion-user', ['peticiones' => $peticiones]);
    }
    

    public function indexPeticionCompleta(Request $request)
    {
        $userId = Auth::id();
        
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where([['user_id', $userId],['estatus', true]])->oldest()->paginate(10);
    
        return view('user.index-peticion-completa-user', ['peticiones' => $peticiones]);
    }

    public function mostrarPeticion(Peticion $peticion)
    {
        return view('user.mostrar-peticion-user', ['peticion' => $peticion]);
    }
}