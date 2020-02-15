<?php

namespace App\Http\Controllers;

use App\Company;
use App\Type;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index(){
        return view('CompanyD.company_view');
    }

    public function create(){
        $types = Type::all();
        return view('CompanyD.create',compact('types'));
    }

    public function store(){
        //$compaines = ['toshiba','fresh','LG','unionaire'];

        $data = request()->validate([
            'company_name'     => ['required'],
        ]);

        $company = Company::create([
           'name' => request()->company_name,
        ]);
        $typeid = request()->type;
        $type = Type::find($typeid);
        $company->hasTypes()->attach($type);
        return redirect('/');
    }

    public function GetAllType($id){
        $company = Company::find($id);
        echo $company->name . '<br>' ;
        foreach ($company->hasTypes as $type){
            echo $type->name;
            echo "<br>";
        }
    }
    public function show() {
        $companies = Company::all();
        return view('CompanyD.show', compact('companies'));
    }
    public function getCompanies($id = 0){
        // Fetch all records
        $companyData['data'] = Company::getCompanyData($id);

        echo json_encode($companyData);
        exit;
    }

    public function getTypes($id = 0){
        // Fetch all records
        $Company = Company::find($id);

        $typeData['data'] = $Company->hasTypes;

        echo json_encode($typeData);
        exit;
    }
}
