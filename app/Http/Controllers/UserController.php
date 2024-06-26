<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Peticion;
use App\Models\Devolucion;
use App\Http\Requests\CompletarPeticionRequest;
use App\Http\Requests\DevolucionRequest;

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
        return view('user.completar-peticion-user', ['peticion' => $peticion]);
    }

    public function alternarEstatusPeticion(Peticion $peticion, CompletarPeticionRequest $completarPeticionRequest)
    {
        $user = Auth::user();

        $data = $completarPeticionRequest->validated();
        $peticion->completarPeticionUser($user->id, $data['resumen']);
        $peticion->save();

        return redirect()->route('user.peticion-index')->with('exito', 'Petición completada con éxito');
    }

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
