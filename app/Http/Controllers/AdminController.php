<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;
use App\Http\Requests\PeticionRequest;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function indexPeticion(Request $request)
    {
        $numeroRadicado = $request->input('numero_radicado');
        
        $peticiones = Peticion::when(
            $numeroRadicado,
            fn($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where('estatus', false)->oldest()->paginate(10);
        
        return view('admin.index-peticion-admin', ['peticiones' => $peticiones]);
    }

    public function indexPeticionCompleta(Request $request)
    {
        $numeroRadicado = $request->input('numero_radicado');
        
        $peticiones = Peticion::when(
            $numeroRadicado,
            fn($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where('estatus', true)->oldest()->paginate(10);
        
        return view('admin.index-peticion-completa-admin', ['peticiones' => $peticiones]);
    }

    public function indexPeticionDevuelta(Request $request)
    {
        $userId = Auth::id();
        $numeroRadicado = $request->input('numero_radicado');

        $peticiones = Peticion::when(
            $numeroRadicado,
            fn($query, $numeroRadicado) => $query->numeroRadicado($numeroRadicado)
        )->where([['user_id', $userId],['estatus', false]])->oldest()->paginate(10);
    
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

        return view('admin.editar-peticion-admin', ['peticion' => $peticion, 'users' => $users]);
    }

    public function guardarPeticion(PeticionRequest $peticionRequest)
    {
        $data = $peticionRequest->validated();
        $data['dias'] = now()->diffInDays($data['fecha_vencimiento']);
        
        $peticion = Peticion::create($data);
    
        return redirect()->route('admin.peticion-index')->with('exito', 'Petición creada con éxito');
    }
    
    public function actualizarPeticion(Peticion $peticion, PeticionRequest $peticionRequest)
    {
        $data = $peticionRequest->validated();
        $data['dias'] = now()->diffInDays($data['fecha_vencimiento']);
        
        $peticion->update($data);
    
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
}
