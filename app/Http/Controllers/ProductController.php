<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    //
    public function index(){
        $Products = Product::query()->get();
        return view('ProductD.index',compact('Products'));
    }

    public function create(){
        $companies = Company::query()->get();
        return view('ProductD.create', compact('companies'));
    }

    public function store(){
        $data = request()->validate([
            'code'     => ['required'],
            'description' => ['required'],
            'price' => ['required','between:0,99999.99'],
            'company' => ['required'],
            'type' => ['required'],
            'image'     => ['image'],
        ]);
        if (!request()->hasFile('image'))
        {
            $imagePath = '/uploads/No_Pic.jpg';
        }
        else {
            $imagePath = request('image')->store('/uploads/products', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(220, 293);
            $image->save();
        }
        $company = DB::table('company')->where('id', $data['company'])->first() ;
        $type = DB::table('types')->where('id', $data['type'])->first() ;
       Product::create([
            'code' =>$data['code'],
            'description' =>$data['description'],
            'price' =>$data['price'],
            'company' => $company->name ,
            'type' =>$type->name,
            'image' =>$imagePath,
        ]);

        return redirect('/product');
    }

    public function show($id){

    }
}
