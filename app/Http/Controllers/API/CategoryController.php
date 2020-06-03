<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Product;
use App\Badge;
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
    public function getCategoryList(Request $request){
        $categories = ProductCategory::select('id', 'name')->orderBy('id')->get();
        $badges = Badge::select('id', 'name')->orderBy('id')->get();

        $data = [
            'categories' => $categories,
            'badges' => $badges
        ];

        return response()->json( $data );
        
    }
    public function getCategoryBySlugs(Request $request){

        $categories = ProductCategory::where('is_popular', 1)->orderBy('name')->take(6)->get();

        $categories = CategoryBySlugsResource::collection($categories);


        return response()->json( $categories );


        // $categories = CategoryResource::collection( $categories );


        
    }

    public function getCategoryBySlug($slug){

        $category = ProductCategory::where('slug', $slug)->first();

        $category = new CategoryBySlugsResource($category);


        return response()->json( $category );


        // $categories = CategoryResource::collection( $categories );


        
    }
    public function getAllIds(Request $request){

        
$ids = getAllChildsBySlug( $request->slug );

        return response()->json( $ids );


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
    public function generateProductCount(){

        $categories = ProductCategory::select(['id', 'name', 'slug'])->get();

        $i = 0 ;
        foreach ($categories as $category) {
            $allChild = getAllChildsBySlug( $category->slug );
            $products = Product::whereIn('category_id', $allChild)->select("id")->get()->count();

            ProductCategory::where('id', $category->id)->update(['item_count' => $products]);
            // echo ++$i.') '.$category->name.' => '.$products.'<br>';
        }
        return true;

    }

}
