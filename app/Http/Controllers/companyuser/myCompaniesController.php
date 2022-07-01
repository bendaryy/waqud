<?php

namespace App\Http\Controllers\companyuser;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Petrol;
use App\Models\subCar;

class myCompaniesController extends Controller
{
    public function __construct()
    {

        $this->middleware('role:company', ['only' => ['index']]);
        $this->middleware('role:company', ['only' => ['show']]);
        $this->middleware('role:company', ['only' => ['create', 'store']]);
        $this->middleware('role:company', ['only' => ['edit', 'update']]);
        $this->middleware('role:company', ['only' => ['destroy']]);
        $this->middleware('role:company', ['only' => ['companyPetrol']]);

    }

    public function index()
    {
        $companies = CompanyUser::where('user_id', auth()->user()->id)->get();
        return view('companyuser.company.index', compact('companies'));
    }
    public function show($id)
    {
        $company = CompanyUser::where('company_id', $id)->where('user_id', auth()->user()->id)->get();
        return view('companyuser.company.show', compact('company', 'id'));
    }

    public function cars($id)
    {
        $company = Company::where('id', $id)->firstOrFail();
        $cars = subCar::with('companies')->where('company', $id)->get();
        return view('companyuser.car.index', compact('cars', 'id', 'company'));

    }

    public function carPetrol($id)
    {
        $petrols = Petrol::where('carId', $id)->get();
        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id','car'));
    }

    public function companyPetrol($id){
        $petrols = Petrol::where('companyId',$id)->get();
        $company = Company::find($id);
        return view('companyuser.car.petrol',compact('petrols','company'));
    }

}
