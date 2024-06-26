<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function homeLogin()
    {
        if (Auth()->check()) {
            if (auth()->user()->rol === 'admin') {
                return redirect()->route('admin.peticion-index');
            } elseif (auth()->user()->rol === 'user') {
                return redirect()->route('user.peticion-index');
            }
        }
        return view('auth.login');
    }

    public function guardarSesion()
    {
        if (auth()->attempt(request(['username', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'El correo electrónico y/o la contraseña son incorrectos'
            ]);
        } else {
            if (auth()->user()->rol === 'admin') {
                return redirect()->route('admin.peticion-index')->with('exito', 'Administrador inicio sesión con exito');
            } else {
                return redirect()->route('user.peticion-index')->with('exito', 'Usuario inicio sesión con exito');
            }
        }
    }

    public function eliminarSesion()
    {
        auth()->logout();

        return redirect()->route('login.home');
    }
}
