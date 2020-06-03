<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Filterable;
class Product extends Model
{
    use Filterable;
    protected $guarded = [];
    
    public function category(){
        return $this->belongsTo("App\ProductCategory");
    }
    public function badges(){
        return $this->belongsToMany("App\Badge", "product_badges");
    }
    public function attributes(){
        return $this->hasMany("App\Attribute");
    }
}
