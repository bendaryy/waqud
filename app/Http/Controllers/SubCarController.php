<?php

namespace App\Http\Controllers;

use App\Models\CompanyUser;
use App\Models\MainCar;
use App\Models\subCar;
use Illuminate\Http\Request;

// use Intervention\Image\ImageManagerStatic as Image;
// use Intervention\Image\ImageManager;

class SubCarController extends Controller
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
        // $companyUser = CompanyUser::where('user_id', auth()->user()->id)->get();
        $companyUser = CompanyUser::all();
        $mainCars = MainCar::all();
        $subCars = subCar::all();
        return view('subcar.index', compact('subCars', 'mainCars', 'companyUser'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'main_car' => 'required',
            'sub_car' => 'required',
            'company' => 'required',
        ]);

        $subcar = new subCar();
        $subcar->main_car = $request->main_car;
        $subcar->sub_car = $request->sub_car;
        $subcar->car_letters = $request->car_letters;
        $subcar->car_numbers = $request->car_numbers;
        $subcar->model = $request->model;
        $subcar->engine_type = $request->engine_type;
        $subcar->company = $request->company;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $mainName = $file->storeAs('public/cars', $fileName);
            $subcar->image = "storage/cars/$fileName";
        }

        $subcar->save();
        return redirect()->back()->with('success', __('messages.car added successfully'));
    }

    public function show($id,$companyCar,$carLetters,$car_numbers){
        $subCar = subCar::findOrFail($id);
        return view ('subcar.show',compact('subCar','companyCar'));
    }

    public function destroy($id)
    {
        $role = subCar::findOrFail($id);
        $role->delete();
        if ($role->image != null) {
            unlink(public_path($role->image));
        } else {

        }
        return back()->with('delete', __('messages.deleteSuccess'));

    }
}
