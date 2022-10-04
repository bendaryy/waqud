<?php

namespace App\Http\Controllers\companyuser;

use App\Charts\petrol as Chart;
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
        $chart = new Chart;
        $chart->labels(['One', 'Two', 'Three', 'four', 'five']);
        $chart->dataset('My dataset 1', 'bar', [1, 2, 3, 4, 5])->options([
            "borderColor" => 'rgb(75, 192, 192)',
            "fill" => 'false',
            'borderWidth' => 3,
            'backgroundColor' => ['rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)'],
        ]);
        return view('companyuser.company.index', compact('companies', 'chart'));
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
        $petrols2 = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->paginate(10);
        $chart = new Chart;

        if (($petrols->count() >= 1)) {
            foreach ($petrols2 as $petrol) {
                $chart->labels(['معدل الإستهلاك طبقاً للتاريخ']);
                $chart->dataset(Carbon::parse($petrol->created_at)->format('d-m-Y'), 'bar', [$petrol->litre])->options([]);
            }

        } else {

            $chart->labels(['no data']);
            $chart->dataset('date', 'bar', [0]);

        }

        // ->options([
        //     "borderColor" => 'rgb(75, 192, 192)',
        //     "fill" => 'false',
        //     'borderWidth' => 3,
        //     'backgroundColor' => ['rgba(255, 99, 132, 0.2)',
        //         'rgba(255, 159, 64, 0.2)',
        //         'rgba(255, 205, 86, 0.2)',
        //         'rgba(75, 192, 192, 0.2)',
        //         'rgba(54, 162, 235, 0.2)'],
        // ]);

        $sumPetrol = Petrol::where('carId', $id)->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->sum('all_costs');

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
        $average = $car->average;
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo', 'chart','average'));
    }
    public function carPetrolThisWeek($id)
    {
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $petrols2 = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);
        $sumPetrol = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('all_costs');
        $chart = new Chart;

        if (($petrols->count() >= 1)) {
            foreach ($petrols2 as $petrol) {
                $chart->labels(['معدل الإستهلاك طبقاً للتاريخ']);
                $chart->dataset(Carbon::parse($petrol->created_at)->format('d-m-Y'), 'bar', [$petrol->litre])->options([]);
            }

        } else {

            $chart->labels(['no data']);
            $chart->dataset('date', 'bar', [0]);

        }

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
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo', 'chart'));
    }
    public function carPetrolLastWeek($id)
    {
        $currentDate = Carbon::now();
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->where('created_at', '>=', Carbon::now()->subdays(15))->get();
        $petrols2 = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->where('created_at', '>=', Carbon::now()->subdays(15))->paginate(10);
        $sumPetrol = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->where('created_at', '>=', Carbon::now()->subdays(15))->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->where('created_at', '>=', Carbon::now()->subdays(15))->sum('all_costs');
        $chart = new Chart;

        if (($petrols->count() >= 1)) {
            foreach ($petrols2 as $petrol) {
                $chart->labels(['معدل الإستهلاك طبقاً للتاريخ']);
                $chart->dataset(Carbon::parse($petrol->created_at)->format('d-m-Y'), 'bar', [$petrol->litre])->options([]);
            }

        } else {

            $chart->labels(['no data']);
            $chart->dataset('date', 'bar', [0]);

        }

        // $sumAllKilo = Petrol::where('carId', $id)->where('created_at', '>=', Carbon::now()->subdays(15))->sum('all_kilometers');
        // $LastallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->where('created_at', '>=', Carbon::now()->subdays(15))->first()['all_kilometers'];
        // $firstallKilo = Petrol::where('carId', $id)->orderBy('created_at', 'asc')->where('created_at', '>=', Carbon::now()->subdays(15))->first()['all_kilometers'];

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
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo', 'chart'));
    }
    public function carPetrolThisMonth($id)
    {
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        $petrols2 = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->paginate(10);
        $sumPetrol = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('litre');
        $sumPaid = Petrol::where('carId', $id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('all_costs');

        $chart = new Chart;

        if (($petrols->count() >= 1)) {
            foreach ($petrols2 as $petrol) {
                $chart->labels(['معدل الإستهلاك طبقاً للتاريخ']);
                $chart->dataset(Carbon::parse($petrol->created_at)->format('d-m-Y'), 'bar', [$petrol->litre])->options([]);
            }

        } else {

            $chart->labels(['no data']);
            $chart->dataset('date', 'bar', [0]);

        }

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
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo', 'chart'));
    }
    public function carPetrolLastMonth($id)
    {
        $petrols = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get();
        $petrols2 = Petrol::where('carId', $id)->orderBy('created_at', 'desc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->paginate(10);

        $chart = new Chart;

        if (($petrols->count() >= 1)) {
            foreach ($petrols2 as $petrol) {
                $chart->labels(['معدل الإستهلاك طبقاً للتاريخ']);
                $chart->dataset(Carbon::parse($petrol->created_at)->format('d-m-Y'), 'bar', [$petrol->litre])->options([]);
            }

        } else {

            $chart->labels(['no data']);
            $chart->dataset('date', 'bar', [0]);

        }

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
        return view('companyuser.car.show', compact('petrols', 'id', 'car', 'sumPetrol', 'sumPaid', 'sumAllKilo', 'chart'));
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
