<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_query extends Model
{
    protected $table = 'product_queries';

    protected $guarded = [];

    public function getProductInfo(){
        return $this->belongsTo('App\Product', 'product_id');
    }
}
