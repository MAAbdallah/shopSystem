<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyTypeRelation;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    //
    public function index(){
        return view('TypeD.index');
    }
    public function create(){
        $companies = Company::all();
        return view('TypeD.create',compact('companies'));
    }
    public function store(){

        $data = request()->validate([
            'type_name'     => ['required'],
        ]);
        $search_name = request()->type_name ;
        $type = Type::where('name',$search_name)->get();
        $count = $type->count();
        $companyid = request()->company;
        if($count==0) {
            $type = Type::create([
                'name' => request()->type_name,
            ]);
            $company = Company::find($companyid);
            $type->hasCompanies()->attach($company);
        }
        else{
            $searchRelation = CompanyTypeRelation::query()->where('type_id',$type->first()->id)->where('company_id',$companyid)->get();
            if($searchRelation->count()==0){
                $company = Company::find($companyid);
                $type->first()->hasCompanies()->attach($company);
            }
        }
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
