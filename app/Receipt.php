<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $guarded = [];
    protected $table = 'receipts';

    public function hasProducts()
    {
        return $this->belongsToMany(Product::class);
    }
}
