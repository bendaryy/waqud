<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    public function store(Request $request)
    {
        $company = new Company;
        $company->name = $request->name;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->save();
        return redirect()->back()->with('success', __("messages.success"));
    }

    public function edit(Company $company)
    {
        return view('company.edit',compact('company'));
    }

    public function update($id,Request $request)
    {
        $company = Company::findOrFail($id);
        $company->name = $request->name;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->update();
        return redirect()->route('company.index')->with('success', __("messages.editSuccess"));
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->back()->with('delete', __("messages.deleteSuccess"));
    }
}
