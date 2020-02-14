<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    //
    protected $guarded = [];
    protected $table = 'company';
    public static function getCompanyData($id=0){

        if($id==0){
            $value=DB::table('company')->orderBy('id', 'asc')->get();
        }else{
            $value=DB::table('company')->where('id', $id)->first();
        }
        return $value;

    }
}
