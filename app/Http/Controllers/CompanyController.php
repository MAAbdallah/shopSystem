<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index(){
        return view('company_view');
    }

    public function getCompanies($id = 0){
        // Fetch all records
        $companyData['data'] = Company::getCompanyData($id);

        echo json_encode($companyData);
        exit;
    }
}
