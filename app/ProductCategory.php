<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
class ProductCategory extends Model
{
    use Resizable;
    public function childs(){
        return $this->hasMany('App\ProductCategory', 'parent_id', 'id')->orderBy('name');
    }

    public function parent(){
        return $this->belongsTo('App\ProductCategory', 'parent_id');
    }

    public function products()
    {
        return $this->hasManyThrough(
            'App\Product', 'App\ProductCategory',
            'parent_id', 'id'
        );
    }

}

