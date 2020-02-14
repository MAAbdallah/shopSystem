<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Type extends Model
{
    //
    protected $guarded = [];
    protected $table = 'types';
    public static function getTypeData($id=0){

        if($id==0){
            $value=DB::table('types')->orderBy('id', 'asc')->get();
        }else{
            $value=DB::table('types')->where('id', $id)->first();
        }
        return $value;
    }
}
