<?php

namespace App\Http\Controllers;

use App\Company;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    //
    public function index(){
        return view('TypeD.type_view');
    }
    public function create(){
        $companies = Company::all();
        return view('TypeD.create',compact('companies'));
    }
    public function store(){

        $data = request()->validate([
            'type_name'     => ['required'],
        ]);

        $type = Type::create([
            'name' => request()->type_name,
        ]);
        $companyid = request()->company;
        $company = Company::find($companyid);
        $type->hasCompanies()->attach($company);
        return redirect('/');
    }

    public function GetAllCompanies($id){

        $type = Type::find($id);
        foreach ($type->hasCompanies as $company){
            echo $company->name;
            echo "<br>";
        }
    }
    public function show() {
        $types = Type::all();
        return view('TypeD.show', compact('types'));
    }

    public function getTypes($id = 0){
        // Fetch all records
        $typeData['data'] = Type::getTypeData($id);

        echo json_encode($typeData);
        exit;
    }
    public function getCompanies($id = 0){
        // Fetch all records
        $type = Type::find($id);

        $companyData['data'] = $type->hasCompanies;

        echo json_encode($companyData);
        exit;
    }
}
