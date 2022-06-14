<?php

namespace App\Http\Controllers;

use App\Models\Petrol;

class PetrolController extends Controller
{
    public function index()
    {
        $petrols = Petrol::all();
        return view('petrol.index', compact('petrols'));
    }
}
