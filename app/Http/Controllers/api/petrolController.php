<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Petrol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class petrolController extends Controller
{
    public function index()
    {
        $petrol = Petrol::with("company")->with('car')->get();
        return $petrol;
    }

    public function store(Request $request)
    {
        $petrol = new petrol;
        $petrol->companyId = $request->companyId;
        $petrol->carId = $request->carId;
        $petrol->litre = $request->litre;
        $petrol->pound = $request->pound;
        $petrol->ekramyat = $request->ekramyat;
        $petrol->all_costs = $request->all_costs;
        $petrol->user_id = $request->user_id;
        $petrol->all_kilometers = $request->all_kilometers;

        if ($request->companyId != 0 && $request->carId != 0) {
            $result = $petrol->save();
            return (object) ['data' => $request->all(), "msg" => "inserted successfully",
                "status" => true];
        } else {
            return "يوجد خطأ بالبيانات";
        }

    }
}
