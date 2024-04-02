<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', ['peticions' => Peticion::latest()->paginate(10)]);
    }

    /*
    public function home()
    {
        $peticionesIncompletas = Peticion::where('estatus', false)->latest()->paginate(10);

        return view('home', ['peticions' => $peticionesIncompletas]);
    }
    */
}
