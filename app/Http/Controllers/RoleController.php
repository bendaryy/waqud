<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // public function create()
    // {
    //     return view('roles.create');
    // }
    public function store(Request $request)
    {
        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', __('messages.success'));

    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();
        return back()->with('delete', __('messages.deleteSuccess'));

    }
}
