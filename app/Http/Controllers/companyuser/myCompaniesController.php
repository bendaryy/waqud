<?php

namespace App\Http\Controllers\companyuser;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Petrol;
use App\Models\subCar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        // $petrols = Petrol::where('carId', $id)->whereMonth(
        //     'created_at', '=', Carbon::now()->subMonth()->month
        // )->get();

        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car'));
    }
    public function carPetrolThisWeek($id)
    {
        $petrols = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        // $petrols = Petrol::where('carId', $id)->whereMonth(
        //     'created_at', '=', Carbon::now()->subMonth()->month
        // )->get();

        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car'));
    }
    public function carPetrolLastWeek($id)
    {
        $currentDate = Carbon::now();
        $petrols = Petrol::where('carId', $id)->where('created_at', '>=',Carbon::now()->subdays(15))->get();
        // $petrols = Petrol::where('carId', $id)->whereMonth(
        //     'created_at', '=', Carbon::now()->subMonth()->month
        // )->get();

        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car'));
    }
    public function carPetrolThisMonth($id)
    {
        $petrols = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        // $petrols = Petrol::where('carId', $id)->whereMonth(
        //     'created_at', '=', Carbon::now()->subMonth()->month
        // )->get();

        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car'));
    }
    public function carPetrolLastMonth($id)
    {
        $petrols = Petrol::where('carId', $id)->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->get();

        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car'));
    }

    public function companyPetrol($id)
    {
        $petrols = Petrol::where('companyId', $id)->get();
        $company = Company::find($id);
        return view('companyuser.car.petrol', compact('petrols', 'company'));
    }

    public function editKilo($id)
    {
        $petrol = Petrol::findOrFail($id);
        return view('companyuser.petrol.edit', compact('petrol'));
    }

    public function update($id, Request $request)
    {
        $petrol = Petrol::find($id);

        $petrol->kiloNumbers = $request->kiloNumbers;
        $petrol->safy7aNumbers = $request->safy7aNumbers;
        $petrol->hundredNumbers = $request->hundredNumbers;
        $petrol->kilosperliter = $request->kilosperliter;
        $petrol->created_at = $request->created_at;
        $petrol->update();
        return redirect()->route('carpetrol', $petrol->car->id)->with('success', __("messages.editSuccess"));

    }

}
