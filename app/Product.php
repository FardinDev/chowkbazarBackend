<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo("App\ProductCategory");
    }
    public function badges(){
        return $this->belongsToMany("App\Badge", "product_badges");
    }
}
