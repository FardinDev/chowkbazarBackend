<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Product;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryBySlugsResource;
class CategoryController extends Controller
{
    public function getCategories(Request $request){
        $categories = ProductCategory::where('parent_id', NULL)->orderBy('name')->get();

        $categories = CategoryResource::collection( $categories );


        return response()->json( $categories );
        
    }
    public function getCategoryBySlugs(Request $request, $slugs, $depth){

        $slugs = \json_decode($slugs);

        $categories = ProductCategory::whereIn('slug', $slugs)->orderBy('name')->get();

        $categories = CategoryBySlugsResource::collection($categories);


        return response()->json( $categories );


        // $categories = CategoryResource::collection( $categories );


        
    }

    // function generateSlug($slug){

        
    //     $slug = str_replace(',', '', strtolower($slug));
    //     $slug = str_replace('.', ' ', strtolower($slug));
    //     $slug = str_replace('/', '', strtolower($slug));
    //     $slug = str_replace('&', 'and', strtolower($slug));
    //     $slug = str_replace(' ', '-', strtolower($slug));
    //     return $slug;

    // }
    // public function genSlugs(){

    //     $products = Product::all();


    //     foreach ($products as $product) {
    //         Product::where('id', $product->id)->update(['slug' => $this->generateSlug($product->name)
    //         ]);
    //     }


    //     return response()->json( 'done' );
        
    // }
}
