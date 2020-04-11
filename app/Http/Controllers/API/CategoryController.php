<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Product;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryBySlugsResource;
use App\Http\Resources\CategoryFilterResource;
class CategoryController extends Controller
{
    public function getCategories(Request $request){
        $categories = ProductCategory::where('parent_id', NULL)->orderBy('name')->get();

        $categories = CategoryResource::collection( $categories );


        return response()->json( $categories );
        
    }
    public function getCategoryBySlugs(Request $request){

        $categories = ProductCategory::where('is_popular', 1)->orderBy('name')->take(6)->get();

        $categories = CategoryBySlugsResource::collection($categories);


        return response()->json( $categories );


        // $categories = CategoryResource::collection( $categories );


        
    }

    public function getCategoryBySlug($slug){

        $category = ProductCategory::where('slug', $slug)->first();

        $category = new CategoryFilterResource($category);


        return response()->json( $category );


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
