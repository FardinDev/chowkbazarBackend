<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use  App\Attribute;
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

        $products = Product::with('category')->whereHas('badges', function($q){
            $q->where('name', 'featured');
        })
        ->select($this->selectArray)->inRandomOrder()->take($request->take)->get();
        
        $products = ProductResource::collection( $products );
        
        return response()->json( $products );


    }
    public function getMostViewed(Request $request){

        $products = Product::with('category')->select($this->selectArray)->orderBy('views', 'desc')->take($request->take)->get();
        
        $products = ProductResource::collection( $products );
        
        return response()->json( $products );


    }
    public function getNewArrival(Request $request){

            // $products = Product::select($this->selectArray)->get();
                    
            // foreach ($products as $product) {
            //     # code...
            //     $attributes = [
            //         [
            //             'text' => $product->text_one_title,
            //             'value' => $product->text_one_text
            //         ],
            //         [
            //             'text' => $product->text_two_title,
            //             'value' => $product->text_two_text
            //         ],
            //         [
            //             'text' => $product->text_three_title,
            //             'value' => $product->text_three_text,
            //         ],
            //         [
            //             'text' => $product->text_four_title,
            //             'value' => $product->text_four_text
            //         ],
            //         [
            //             'text' => $product->text_five_title,
            //             'value' => $product->text_five_text
            //         ]
            // ];

            // foreach ($attributes as $attribute) {
            //    if ($attribute['text'] && $attribute['value']) {
            //     $data = [
            //         'product_id' => $product->id,
            //         'name' => $attribute['text'],
            //         'value' => $attribute['value']
            //     ];

            //       Attribute::create($data);
            //    }
            // }
            // }


        $products = Product::with('category')->select($this->selectArray)->orderBy('id', 'desc')->take($this->take)->get();

        $products = ProductResource::collection( $products );
        
        return response()->json( $products );


    }
}
