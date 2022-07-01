<?php

namespace App\Http\Controllers;

use App\Models\Petrol;

class PetrolController extends Controller
{
       public function __construct()
    {

        $this->middleware('role:super_admin', ['only' => ['index']]);
        $this->middleware('role:super_admin', ['only' => ['create', 'store']]);
        $this->middleware('role:super_admin', ['only' => ['edit', 'update']]);
        $this->middleware('role:super_admin', ['only' => ['destroy']]);

    }
    public function index()
    {
        $petrols = Petrol::all();
        return view('petrol.index', compact('petrols'));
    }
}
