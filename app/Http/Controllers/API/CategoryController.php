<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Http\Resources\CategoryResource;
class CategoryController extends Controller
{
    public function getCategories(Request $request){
        $categories = ProductCategory::where('parent_id', NULL)->orderBy('name')->get();

        $categories = CategoryResource::collection( $categories );


        return response()->json( $categories );
        
    }
}
