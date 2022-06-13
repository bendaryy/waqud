<?php

namespace App\Http\Controllers;

use App\Models\Petrol;
use Illuminate\Http\Request;

class PetrolController extends Controller
{
    public function index(){
        $petrol = Petrol::all();
        return $petrol;
    }

    public function store(Request $request){
        $petrol  = new Petrol;
        $petrol->companyId = $request->companyId;
        $petrol->carId = $request->carId;
        $petrol->litre = $request->litre;
        $petrol->pound = $request->pound;

        $petrol->save();
    }
}
