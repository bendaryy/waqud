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
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->get();
        $sumPetrol = Petrol::where('carId', $id)->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->sum('all_costs');
        $firstallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'asc')->first()['all_kilometers'];

        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'desc')->first()['all_kilometers'])) {
            $LastallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->first()['all_kilometers'];

        } else {
            $LastallKilo = 0;
        }
        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'asc')->first()['all_kilometers'])) {
            $firstallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'asc')->first()['all_kilometers'];
        } else {
            $firstallKilo = 0;
        }

        $sumAllKilo = $LastallKilo - $firstallKilo;
        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo'));
    }
    public function carPetrolThisWeek($id)
    {
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $sumPetrol = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('all_costs');
        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first()['all_kilometers'])) {
            $LastallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first()['all_kilometers'];

        } else {
            $LastallKilo = 0;
        }
        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'asc')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first()['all_kilometers'])) {
            $firstallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'asc')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first()['all_kilometers'];

        } else {
            $firstallKilo = 0;
        }
        $sumAllKilo = $LastallKilo - $firstallKilo;
        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo'));
    }
    public function carPetrolLastWeek($id)
    {
        $currentDate = Carbon::now();
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->where('created_at', '>=', Carbon::now()->subdays(15))->get();
        $sumPetrol = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->where('created_at', '>=', Carbon::now()->subdays(15))->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->where('created_at', '>=', Carbon::now()->subdays(15))->sum('all_costs');
        // $sumAllKilo = Petrol::where('carId', $id)->where('created_at', '>=', Carbon::now()->subdays(15))->sum('all_kilometers');
        $LastallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->where('created_at', '>=', Carbon::now()->subdays(15))->first()['all_kilometers'];
        $firstallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'asc')->where('created_at', '>=', Carbon::now()->subdays(15))->first()['all_kilometers'];

        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'desc')->where('created_at', '>=', Carbon::now()->subdays(15))->first()['all_kilometers'])) {
            $LastallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->where('created_at', '>=', Carbon::now()->subdays(15))->first()['all_kilometers'];

        } else {
            $LastallKilo = 0;
        }
        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'asc')->where('created_at', '>=', Carbon::now()->subdays(15))->first()['all_kilometers'])) {
            $firstallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'asc')->where('created_at', '>=', Carbon::now()->subdays(15))->first()['all_kilometers'];

        } else {
            $firstallKilo = 0;
        }

        $sumAllKilo = $LastallKilo - $firstallKilo;
        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo'));
    }
    public function carPetrolThisMonth($id)
    {
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        $sumPetrol = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('all_costs');

        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->first()['all_kilometers'])) {
            $LastallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->first()['all_kilometers'];

        } else {
            $LastallKilo = 0;
        }
        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'asc')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->first()['all_kilometers'])) {
            $firstallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'asc')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->first()['all_kilometers'];

        } else {
            $firstallKilo = 0;
        }

        $sumAllKilo = $LastallKilo - $firstallKilo;

        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo'));
    }
    public function carPetrolLastMonth($id)
    {
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get();

        $sumPetrol = Petrol::where('carId', $id)->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->sum('all_costs');
        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->first()['all_kilometers'])) {
            $LastallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->first()['all_kilometers'];

        } else {
            $LastallKilo = 0;
        }
        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'asc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->first()['all_kilometers'])) {
            $firstallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'asc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->first()['all_kilometers'];

        } else {
            $firstallKilo = 0;
        }

        $sumAllKilo = $LastallKilo - $firstallKilo;

        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo'));
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

    public function fromDateToDate($id, Request $request)
    {
        $from = date($request->dateFrom);
        $to = date($request->dateTo);
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [$from, $to])->get();

        $sumPetrol = Petrol::where('carId', $id)->whereBetween('created_at', [$from, $to])->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->whereBetween('created_at', [$from, $to])->sum('all_costs');
        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [$from, $to])->first()['all_kilometers'])) {
            $LastallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [$from, $to])->first()['all_kilometers'];

        } else {
            $LastallKilo = 0;
        }
        if (isset(Petrol::where('carId', $id)->orderBy('created_at', 'asc')->whereBetween('created_at', [$from, $to])->first()['all_kilometers'])) {
            $firstallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'asc')->whereBetween('created_at', [$from, $to])->first()['all_kilometers'];

        } else {
            $firstallKilo = 0;
        }

        $sumAllKilo = $LastallKilo - $firstallKilo;

        $car = subCar::find($id);
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'from', 'to', 'sumPetrol', 'sumPaid', 'sumAllKilo'));
    }

}
