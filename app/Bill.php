<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $guarded = [];
    protected $table = 'bills';

    public function hasProducts()
    {
        return $this->belongsToMany(Product::class);
    }
}
