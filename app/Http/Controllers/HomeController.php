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
}
