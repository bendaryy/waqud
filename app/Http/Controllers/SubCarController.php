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
    public function index()
    {
        $companyUser = CompanyUser::where('user_id', auth()->user()->id)->get();
        $mainCars = MainCar::all();
        $subCars = subCar::all();
        return view('subcar.index', compact('subCars', 'mainCars', 'companyUser'));
    }

    public function store(Request $request)
    {
        $subcar = new subCar();
        $subcar->main_car = $request->main_car;
        $subcar->sub_car = $request->sub_car;
        $subcar->model = $request->model;
        $subcar->engine_type = $request->engine_type;
        $subcar->company = $request->company;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $mainName =  $file->storeAs('public/cars', $fileName);
            $subcar->image = "storage/cars/$fileName";
        }

        $subcar->save();
        return redirect()->back()->with('success', __('messages.car added successfully'));
    }

     public function destroy($id){
        $role = subCar::findOrFail($id);
        $role->delete();
        if($role->image != NULL){
            unlink(public_path($role->image));
        }else{

        }
        return back()->with('delete', __('messages.deleteSuccess'));

    }
}
