<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Http\Resources\ProductResource;
class ProductController extends Controller
{
    private $take = 24;
    private $selectArray = ['id', 'name', 'slug', 'category_id', 'start_price', 'end_price', 'primary_image', 'other_images', 'is_featured', 'views', 'minimum_orders', 'unit', 'tags',
    'text_one_title', 'text_one_text',
    'text_two_title', 'text_two_text',
    'text_three_title', 'text_three_text',
    'text_four_title', 'text_four_text',
    'text_five_title', 'text_five_text'
];

    public function getFeatured(Request $request){

        $products = Product::with('category')->where('is_featured', 1)->select($this->selectArray)->inRandomOrder()->take($request->take)->get();
        foreach ($products as $product) {
            $product->badge = 'featured';
        }
        $products = ProductResource::collection( $products );
        
        return response()->json( $products );


    }
    public function getMostViewed(Request $request){

        $products = Product::with('category')->select($this->selectArray)->orderBy('views', 'desc')->take($request->take)->get();
        foreach ($products as $product) {
            $product->badge = 'view';
        }
        $products = ProductResource::collection( $products );
        
        return response()->json( $products );


    }
    public function getNewArrival(Request $request){

        $products = Product::with('category')->select($this->selectArray)->orderBy('id', 'desc')->take($this->take)->get();
        foreach ($products as $product) {
            $product->badge = 'new';
        }

        $products = ProductResource::collection( $products , 'new');
        
        return response()->json( $products );


    }
}
