<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Http\Resources\ProductResource;
class ProductController extends Controller
{
    private $selectArray = ['id', 'name', 'category_id', 'start_price', 'end_price', 'primary_image', 'views', 'minimum_orders', 'unit', 'tags'];

    public function getFeatured(Request $request){

        $products = Product::with('category')->where('is_featured', 1)->select($this->selectArray)->inRandomOrder()->get();

        
        $products = ProductResource::collection( $products );
        
        return response()->json( $products );


    }
}
