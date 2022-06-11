<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            // 'password' => 'required',
            // 'roles_name' => 'required',
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->syncRoles("user");
        // $user->syncPermissions("عرض ملفاتى");
        // $user->assignRole($request->input('roles_name'));
        return redirect()->route('users.index')->with('success', __('messages.success'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $companies = Company::with('users')->get();
        $CompanyUser = CompanyUser::where('user_id', $user->id)->with('companies')->get();
        // $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'permissions', 'companies', 'CompanyUser'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $request_data = $request->except(['permissions', 'roles']);
        $user->update($request_data);
        // $user->syncPermissions("add") ;
        $request->roles ? $user->syncRoles($request->roles) : $user->syncRoles($request->roles);
        $request->permissions ? $user->syncPermissions($request->permissions) : $user->syncPermissions($request->permissions);
        // $request->company ? $user->companies()->syncWithoutDetaching($request->company) : "";
        // $request->companyDetach ? $user->companies()->detach($request->companyDetach) : "";
        // $request->company ? $user->companies()->sync($request->company) : $user->companies()->detach($request->company);
        session()->flash('success', __('messages.editSuccess'));
        // $request->detachPermissions($request->permissions);
        return redirect()->route('users.index');

    }

    // start attach company

    public function EditsyncCompanies(Request $request, $id)
    {
        $companies = Company::all();
        $user = User::find($id);
        $CompanyUser = CompanyUser::where('user_id', $id)->get();
        // $request->company ? $user->companies()->syncWithoutDetaching($request->company) : "";
        return view('users.syncCompanies', compact('CompanyUser', 'user', 'companies'));
    }

    public function AddsyncCompanies(Request $request, $id)
    {
        $user = User::find($id);
        $request->company ? $user->companies()->syncWithoutDetaching($request->company) : "";
        return redirect()->back()->with('success', __('messages.success'));
    }

    // end attach company

    // start detach company

    public function EditDetachCompanies(Request $request, $id)
    {
        $user = User::find($id);
        $CompanyUser = CompanyUser::where('user_id', $id)->get();
        return view('users.detachCompanies', compact('CompanyUser', 'user'));
    }

    public function DetachCompanies($id)
    {
        $CompanyUser = CompanyUser::find($id);
        $CompanyUser->delete();
        return redirect()->back()->with('delete', __('messages.deleteSuccess'));
    }

    // end detach company

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('delete', __('messages.deleteSuccess'));
    }

}
