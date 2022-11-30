<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Session;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        return view('companies.index')->withCompanies($companies);
    }
    public function create()
    {
        return view('companies.create');
    }
    
   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $input = $request->all();

        Company::create($input);
        Session::flash('flash_message', 'Company successfully added!');

        return redirect()->route('companies.index');
        
    }
    
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit')->withCompany($company);
    }
    
    public function update($id, Request $request)
    {
        $company = Company::findOrFail($id);

        $this->validate($request, [
            'name' => 'required'
            ]);

        $input = $request->all();

        $company->fill($input)->save();

        Session::flash('flash_message', 'Company successfully added!');

        return redirect()->route('companies.index');
    }
    
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        Session::flash('flash_message', 'Company successfully deleted!');

        return redirect()->route('companies.index');
    }
    
    public function add_users($id)
    {
        $company = Company::findOrFail($id);
        $users = User::all();
        return view('companies.add_users',compact('company','users'));
    }
    
    public function store_users($id, Request $request)
    {
        $company = Company::findOrFail($id);

       if($request->has('user_id')){
           $input = $request->all();
            $company->user_id = json_encode($input['user_id']);
            $company->save();
       }else{
           $company->user_id = null;
            $company->save();
       }
        

        Session::flash('flash_message', 'Company successfully added!');

        return redirect()->route('companies.index');
    }
}
