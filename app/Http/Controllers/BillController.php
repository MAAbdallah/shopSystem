<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Bill_Product;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    //
    public function index()
    {
        $bills = Bill::all();
        return view('BillD.index',compact('bills'));
    }
    public function show($id)
    {
        $bill = Bill::find($id);

        $merged = DB::table('bill_product')
            ->join('products','bill_product.product_id','products.id')
            ->join('bills','bill_product.bill_id','bills.id')
            ->where('bill_product.bill_id',$id)
            ->get();
        //dd($merged);
        return view('BillD.show',compact('bill','merged'));
    }
    public  function create()
    {
        $products = Product::all();
        return view('BillD.create' , compact('products'));
    }
    public function store(Request $request)
    {
        $Number = $request->get('pr_number');
        $Total_count = $request->get('total_count');
        $Total_price = $request->get('total_price');
        $customer = $request->get('pr_customer');
        $salesman = $request->get('salesman');
        $bills = Bill::query()->where('Number' , $Number)->get();
        $count = $bills->count();
        if($count==0)
        {
            $bill = Bill::create([
                'Number' => $Number,
                'Total_price_B' => $Total_price ,
                'Total_count_B' => $Total_count ,
                'customer' => $customer ,
                'salesman' => $salesman ,
            ]);
            foreach($request->input('pr_item') as $key => $value) {
                $code = $request->get('pr_code')[$key];
                //$AvilCount = $request->get('pr_Avilcount')[$key];
                $countP = $request->get('pr_count')[$key] ;
                $product= Product::find($code);
                $product->count -= $countP;
                $product->save();
                //dd($product);
                $bill->hasProducts()->attach($product);
                $idP = $product->id;
                $idB = $bill->id;
                $bill_product = Bill_Product::query()->where('bill_id',$idB)->where('product_id',$idP)->first();
                if($bill_product)
                {
                    $bill_product->price_PB=$request->get('pr_cpi')[$key];
                    $bill_product->count_PB=$request->get('pr_count')[$key];
                    $bill_product->Total_price_PB=$request->get('pr_AllP')[$key];
                    $bill_product->save();
                }
            }
        }
        return redirect('/');

        /*if ($validator->passes()) {
            return response()->json(['success'=>'done']);
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }*/

    }
    public function fetch($id)
    {
        $product = Product::find($id);

        $Data['data'] = $product;

        echo json_encode($Data);
        exit;
    }
}
