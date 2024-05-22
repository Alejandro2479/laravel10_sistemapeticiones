<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Peticion;
use App\Models\User;

class UserController extends Controller
{
    public function indexPeticion(Request $request)
    {
        $userId = Auth::id();
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn ($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where('estatus', false)
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->oldest()
            ->paginate(10);

        return view('user.index-peticion-user', ['peticiones' => $peticiones]);
    }

    public function indexPeticionCompleta(Request $request)
    {
        $userId = Auth::id();
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn ($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where('estatus', true)
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->oldest()
            ->paginate(10);

        return view('user.index-peticion-completa-user', ['peticiones' => $peticiones]);
    }

    public function mostrarPeticion(Peticion $peticion)
    {
        return view('user.mostrar-peticion-user', ['peticion' => $peticion]);
    }

    public function completarPeticion(Peticion $peticion)
    {
        $userId = Auth::id();
        $peticion->users()->updateExistingPivot($userId, ['completado' => true]);

        if ($peticion->alternarPeticionUser()) {
            $peticion->estatus = true;
            $peticion->save();
        }

        return redirect()->back()->with('exito', 'Petición marcada como completa');
    }
}
