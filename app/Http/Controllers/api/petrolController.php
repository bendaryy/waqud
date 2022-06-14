<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petrol;

class petrolController extends Controller
{
     public function index(){
        $petrol = Petrol::all();
        return $petrol;
    }

    public function store(Request $request){
        $petrol  = new petrol;
        $petrol->companyId = $request->companyId;
        $petrol->carId = $request->carId;
        $petrol->litre = $request->litre;
        $petrol->pound = $request->pound;

        $petrol->save();
    }
}
