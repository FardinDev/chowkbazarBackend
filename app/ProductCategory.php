<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public function childs(){
        return $this->hasMany('App\ProductCategory', 'parent_id');
    }
}
