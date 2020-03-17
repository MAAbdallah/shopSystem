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
        $companies = Company::all();
        return view('ProductD.index2',compact('Products','companies'));
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
            'count' => ['required','numeric'],
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
            'count' =>$data['count'],
            'company' => $company->name ,
            'type' =>$type->name,
            'image' =>$imagePath,
        ]);

        return redirect('/product');
    }

    public function show($id){
        $Product = Product::query()->get()->where('id',$id)->first();

        return view('ProductD.show', compact('Product'));
    }

    public function search(){
        $code = request()->Code ;
        $Product = Product::query()->get()->where('code',$code)->first();
        return view('ProductD.show', compact('Product'));

    }
    public function find()
    {
        $code = request()->code ;
        //echo $code ;
        $Products = Product::query()->get()->where('code',$code);
        $output = '';
        $total_row = $Products->count();
        //echo $total_row;
        if($total_row > 0)
        {
            foreach($Products as $row)
            {
                $link = "/product/$row->id" ;
                $output .= '
               <div class="col-sm-5 col-lg-4 col-md-4">
                <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:550px;">

                 <a href="'.$link.'"><img src="storage/'. $row->image .'" alt="" class="img-responsive" ></a>
                 <p align="center"><strong><a href=" '.$link. '">'. $row->code .'</a></strong></p>
                 <h4 style="text-align:center;" class="text-danger" >'. $row->price .'</h4>
                 Brand : '. $row->company .' <br />
                 category : '. $row->type .' <br />
                 count : '. $row->count .' <br />
                 description : '. $row->description .'  </p>
                </div>

               </div>
               ';
            }
        }
        else
        {
            $output = '<h3>No Data Found</h3>';
        }
        echo $output ;
    }
    public function filter(){
        $companyCode = request()->company ;
        $typeCode = request()->type ;
        if($companyCode!=-1&&$typeCode!=-1)
        {
            $companies = Company::all();
            $company = Company::query()->where('id',$companyCode)->first();
            $type = Type::query()->where('id',$typeCode)->first();
            $Products = Product::query()->get()->where('company',$company->name)->where('type',$type->name);
            return view('ProductD.index', compact('Products','companies'));
        }
        return redirect('/product');
    }
    public function fetch_data(){
        $brand = request()->brand;

        //$brand = $_POST["brand"];
        $Products= Product::query()->get()->whereIn('company',$brand);
        $output = '';
        $total_row = $Products->count();
        //echo $total_row;
        if($total_row > 0)
        {
            foreach($Products as $row)
            {
                $link = "/product/$row->id" ;
                $output .= '
               <div class="col-sm-5 col-lg-4 col-md-4">
                <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:550px;">
                 
                 <a href="'.$link.'"><img src="storage/'. $row->image .'" alt="" class="img-responsive" ></a>
                 <p align="center"><strong><a href=" '.$link. '">'. $row->code .'</a></strong></p>
                 <h4 style="text-align:center;" class="text-danger" >'. $row->price .'</h4>
                 Brand : '. $row->company .' <br />
                 category : '. $row->type .' <br />
                 count : '. $row->count .' <br />
                 description : '. $row->description .'  </p>
                </div>

               </div>
               ';
            }
        }
        else
        {
            $output = '<h3>No Data Found</h3>';
        }
        echo $output ;
    }



}
