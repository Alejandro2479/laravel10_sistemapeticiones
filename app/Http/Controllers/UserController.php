<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function crearUsuario()
    {
        return view('users.crear-usuario');
    }

    public function guardarUsuario(UserRequest $userRequest)
    {
        $peticion = User::create($userRequest->validated());

        return redirect()->route('home')->with('exito', 'Usuario creado con exito');
    }
}
