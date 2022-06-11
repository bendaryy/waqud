<?php

namespace App\Http\Controllers;

use App\Models\CompanyUser;
use App\Models\MainCar;
use App\Models\subCar;
use Illuminate\Http\Request;

class SubCarController extends Controller
{
    public function index()
    {
        $companyUser = CompanyUser::where('user_id', auth()->user()->id)->get();
        $mainCars = MainCar::all();
        $subCars = subCar::all();
        return view('subcar.index', compact('subCars', 'mainCars','companyUser'));
    }


    public function store(Request $request)
    {
        $subcar = new subCar();
        $subcar->main_car = $request->main_car;
        $subcar->sub_car = $request->sub_car;
        $subcar->model = $request->model;
        $subcar->engine_type = $request->engine_type;
        $subcar->company = $request->company;

        $subcar->save();
        return redirect()->back()->with('success', __('messages.car added successfully'));
    }
}
