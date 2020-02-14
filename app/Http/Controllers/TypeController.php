<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    //
    public function index(){
        return view('type_view');
    }

    public function getTypes($id = 0){
        // Fetch all records
        $typeData['data'] = Type::getTypeData($id);

        echo json_encode($typeData);
        exit;
    }
}
