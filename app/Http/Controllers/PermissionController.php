<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //  public function __construct()
    // {

    //     $this->middleware('role:super_admin', ['only' => ['index']]);
    //     $this->middleware('role:super_admin', ['only' => ['create', 'store']]);
    //     $this->middleware('role:super_admin', ['only' => ['edit', 'update']]);
    //     $this->middleware('role:super_admin', ['only' => ['destroy']]);

    // }
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }
    // public function create()
    // {
    //     return view('permissions.create');
    // }
    public function store(Request $request)
    {
        $permission = Permission::create(['name' => $request->name]);
        $permission->assignRole('super_admin');
        return redirect()->route('permissions.index')->with('success', __('messages.permissionSuccess'));

    }
       public function destroy($id){
        $role = Permission::findOrFail($id);
        $role->delete();
        return back()->with('delete', __('messages.deleteSuccess'));

    }
}
