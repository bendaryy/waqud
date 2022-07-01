<?php

namespace App\Http\Controllers;

use App\Models\MainCar;
use Illuminate\Http\Request;

class MainCarController extends Controller
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
        $mainCars = MainCar::all();
        return view('mainCars.index', compact('mainCars'));
    }

    public function store(Request $request)
    {
        $mainCar = new MainCar();
        $mainCar->name = $request->name;
        $mainCar->save();
        return redirect()->back()->with('success', __('messages.car added successfully'));

    }

    public function update()
    {

    }

    public function edit()
    {

    }

    public function destroy($id)
    {
        $mainCar = MainCar::findOrFail($id);
        $mainCar->delete();
        return redirect()->back()->with('deleted', __('messages.deleteSuccess'));
    }
}
