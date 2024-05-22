<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Peticion;
use App\Models\User;
use App\Http\Requests\PeticionRequest;
use App\Http\Requests\UserRequest;
use App\Notifications\NuevoDerechoPeticion;

class AdminController extends Controller
{
    public function indexPeticion(Request $request)
    {
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn ($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where('estatus', false)
            ->whereHas('users', function ($query) {
                $query->where('role', '!=', 'admin');
            })
            ->oldest()->paginate(10);

        return view('admin.index-peticion-admin', ['peticiones' => $peticiones]);
    }

    public function indexPeticionCompleta(Request $request)
    {
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn ($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where('estatus', true)
            ->whereHas('users', function ($query) {
                $query->where('role', '!=', 'admin');
            })
            ->oldest()->paginate(10);

        return view('admin.index-peticion-admin', ['peticiones' => $peticiones]);
    }

    public function indexPeticionDevuelta(Request $request)
    {
        $userId = Auth::id();
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn ($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where([['user_id', $userId], ['estatus', false]])->oldest()->paginate(10);

        return view('admin.index-peticion-devuelta-admin', ['peticiones' => $peticiones]);
    }

    public function crearPeticion()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.crear-peticion-admin', ['users' => $users]);
    }

    public function mostrarPeticion(Peticion $peticion)
    {
        return view('admin.mostrar-peticion-admin', ['peticion' => $peticion]);
    }

    public function editarPeticion(Peticion $peticion)
    {
        $users = User::where('role', 'user')->get();
        $usuariosAsignados = $peticion->users->pluck('id')->toArray();

        return view('admin.editar-peticion-admin', ['peticion' => $peticion, 'users' => $users, 'usuariosAsignados' => $usuariosAsignados]);
    }

    public function guardarPeticion(PeticionRequest $peticionRequest)
    {
        $data = $peticionRequest->validated();

        $peticion = new Peticion($data);
        $peticion->calcularFechaVencimiento();
        $peticion->save();

        $usuariosSeleccionados = $peticionRequest->input('user_id', []);
        $peticion->users()->sync($usuariosSeleccionados);

        foreach ($peticion->users as $user) {
            $user->notify(new NuevoDerechoPeticion($peticion->numero_radicado, $peticion->fecha_vencimiento));
        }

        return redirect()->route('admin.peticion-index')->with('exito', 'Petición creada con éxito');
    }

    public function actualizarPeticion(Peticion $peticion, PeticionRequest $peticionRequest)
    {
        $data = $peticionRequest->validated();

        $peticion->update($data);
        $peticion->calcularFechaVencimiento($peticion->created_at);
        $peticion->save();

        $usuariosSeleccionados = $peticionRequest->input('user_id', []);
        $peticion->users()->sync($usuariosSeleccionados);

        return redirect()->route('admin.peticion-index')->with('exito', 'Petición editada con éxito');
    }

    public function eliminarPeticion(Peticion $peticion)
    {
        $peticion->delete();

        return redirect()->route('admin.peticion-index')->with('exito', 'Petición eliminada con exito');
    }

    public function indexUser()
    {
        return view('admin.index-user-admin', ['users' => User::latest()->get()]);
    }

    public function crearUser()
    {
        return view('admin.crear-user-admin');
    }

    public function editarUser(User $user)
    {
        return view('admin.editar-user-admin', ['user' => $user]);
    }

    public function guardarUser(UserRequest $userRequest)
    {
        $peticion = User::create($userRequest->validated());

        return redirect()->route('admin.user-index')->with('exito', 'Usuario creado con exito');
    }

    public function actualizarUser(User $user, UserRequest $userRequest)
    {
        $user->update($userRequest->validated());

        return redirect()->route('admin.user-index')->with('exito', 'Usuario editado con exito');
    }

    public function eliminarUser(User $user)
    {
        if ($user->role !== 'admin') {
            $user->delete();
            return redirect()->route('admin.user-index')->with('exito', 'Usuario eliminado con éxito');
        } else {
            return redirect()->route('admin.user-index')->with('error', 'No se puede eliminar un administrador');
        }
    }

    public function alternarEstatusPeticionAdmin(Peticion $peticion)
    {
        $peticion->alternarPeticionAdmin();

        return redirect()->back()->with('exito', 'Petición actualizada con exito');
    }
}
