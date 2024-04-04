<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        } else {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.peticion-index')->with('exito', 'Administrador inicio sesión con exito');
            } else {
                return redirect()->route(abort(404));
            }
        }
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->to('/login');
    }
}
