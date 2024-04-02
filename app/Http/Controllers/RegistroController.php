<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class RegistroController extends Controller
{
    public function create()
    {
        return view('auth.registro');
    }

    public function store()
    {
        $user = User::create(request(['name', 'email', 'password']));

        return redirect()->route('home')->with('exito', 'Usuario creado con exito');
    }
}
