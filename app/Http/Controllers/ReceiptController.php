<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Product;
use App\Receipt;
use App\Receipt_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    //
    public function index()
    {
        $receipts = Receipt::all();
        return view('ReceiptD.index',compact('receipts'));
    }
    public function show($id)
    {
        $receipt = Receipt::find($id);
        /*$products = $receipt->hasProducts;
        $products_Receipt = Receipt_Product::query()->where('receipt_id',$id)->get();
        $merged = $products->merge($products_Receipt);*/
        $merged = DB::table('product_receipt')
            ->join('products','product_receipt.product_id','products.id')
            ->join('receipts','product_receipt.receipt_id','receipts.id')
            ->where('product_receipt.receipt_id',$id)
            ->get();
        //dd($merged);
        //return view('ReceiptD.show',compact('receipt','products','products_Receipt','merged'));
        return view('ReceiptD.show',compact('receipt','merged'));
    }
    public  function create()
    {
        $products = Product::all();
        return view('ReceiptD.create' , compact('products'));
    }
    public function store(Request $request)
    {
        $Number = $request->get('pr_number');
        $Total_count = $request->get('total_count');
        $Total_price = $request->get('total_price');
        $Recipient = $request->get('Recipient');
        $receipts = Receipt::query()->where('Number' , $Number)->get();
        $count = $receipts->count();
        if($count==0)
        {
            $receipt = Receipt::create([
                'Number' => $Number,
                'Total_price_R' => $Total_price ,
                'Total_count_R' => $Total_count ,
                'Recipient' => $Recipient ,
            ]);
            foreach($request->input('pr_item') as $key => $value) {
                $code = $request->get('pr_code')[$key];
                $product= Product::find($code);
                $product->price = $request->get('pr_cpi')[$key];
                $product->count += $request->get('pr_count')[$key];
                $product->save();
                //dd($product);
                $receipt->hasProducts()->attach($product);
                $idP = $product->id;
                $idR = $receipt->id;
                $receipt_product = Receipt_Product::query()->where('receipt_id',$idR)->where('product_id',$idP)->first();
                if($receipt_product)
                {
                    $receipt_product->price_PR=$request->get('pr_cpi')[$key];
                    $receipt_product->count_PR=$request->get('pr_count')[$key];
                    $receipt_product->Total_price_PR=$request->get('pr_AllP')[$key];
                    $receipt_product->save();
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
