<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        $company->tax_number = $request->tax_number;
        $company->segal_togary = $request->segal_togary;
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
         $company->tax_number = $request->tax_number;
        $company->segal_togary = $request->segal_togary;
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
