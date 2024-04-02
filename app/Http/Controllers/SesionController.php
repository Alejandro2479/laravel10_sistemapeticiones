<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class SesionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        if (auth()->attempt(request(['name', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'El correo electrónico y/o la contraseña son incorrectos'
            ]);
        }

        return redirect()->route('home')->with('exito', 'Usuario inicio sesión con exito');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->to('/login');
    }
}
