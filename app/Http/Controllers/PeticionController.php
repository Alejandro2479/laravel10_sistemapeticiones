<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peticion;

class PeticionController extends Controller
{
    public function homePeticion()
    {
        return view('peticions.home', ['peticions' => Peticion::latest()->get()]);
    }
}
