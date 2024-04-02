<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', ['peticions' => Peticion::latest()->paginate(10)]);
    }

    /*
    public function index()
    {
        $peticionesIncompletas = Peticion::where('estatus', false)->latest()->paginate(10);

        return view('index', ['peticions' => $peticionesIncompletas]);
    }
    */
}
