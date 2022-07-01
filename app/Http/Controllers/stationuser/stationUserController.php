<?php

namespace App\Http\Controllers\stationuser;

use App\Http\Controllers\Controller;
use App\Models\Petrol;
use Illuminate\Support\Facades\DB;

class stationUserController extends Controller
{
    public function __construct()
    {

        $this->middleware('role:station', ['only' => ['index']]);
        $this->middleware('role:station', ['only' => ['show']]);
        $this->middleware('role:station', ['only' => ['create', 'store']]);
        $this->middleware('role:station', ['only' => ['edit', 'update']]);
        $this->middleware('role:station', ['only' => ['destroy']]);

    }

    public function index()
    {
        $companyId = DB::table('petrols')->distinct()->pluck('companyId');
        $petrols = Petrol::select('companyId')->whereIn('companyId', $companyId)->distinct()->get();

        return view('stationuser.index', compact('petrols'));
    }
}
