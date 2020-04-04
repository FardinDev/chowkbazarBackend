<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_query as Query;
use App\Attribute;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDescriptionResource;
use App\Http\Resources\ProductListResource;
use App\Http\Filters\ProductFilter;
class ProductController extends Controller
{
    private $take = 24;
    private $selectArray = ['id', 'name', 'slug', 'category_id', 'start_price', 'end_price', 'primary_image', 'other_images', 'is_featured', 'views', 'minimum_orders', 'unit', 'tags'
];

    public function getProductBySlug($slug){

        $product = Product::where('slug', $slug)->select($this->selectArray)->first();
        $product->increment('views');
        // $product->views = $product->views + 1;
        $product = new ProductResource( $product );
        
        return response()->json( $product );


    }

    public function getRelatedProducts(Request $request){

        $slug = $request->for;

        $product = Product::select('tags')->where('slug', $slug)->first();

        $tags = explode(',', $request->tags);

        $products = Product::Where(function ($query) use($tags) {
            for ($i = 0; $i < count($tags); $i++){
                $query->orwhere('tags', 'like',  '%' . $tags[$i] .'%');
            }      
            })->inRandomOrder()->select($this->selectArray)->take($request->limit)->get();

        $products = ProductResource::collection( $products );
    
        return response()->json( $products );


    }
    public function getProductDescriptionBySlug($slug){

        $product = Product::select('description')->where('slug', $slug)->first();

        $product = new ProductDescriptionResource( $product );
        
        return response()->json( $product );


    }
    public function getProductList(Request $request, ProductFilter $filter){

        $paginate = $request->params['limit'] ?? 12;

        $products = Product::filter($filter)->select($this->selectArray)->paginate($paginate);

        $products = new ProductListResource( $products );
// work needed
        return response()->json( $products );

    }
    public function getFeatured(Request $request){

        $products = Product::with('category')->whereHas('badges', function($q){
            $q->where('name', 'featured');
        })
        ->select($this->selectArray)->inRandomOrder()->take($request->limit)->get();
        
        $products = ProductResource::collection( $products );
        
        return response()->json( $products );


    }
    public function getMostViewed(Request $request){

        $products = Product::with('category')->select($this->selectArray)->orderBy('views', 'desc')->take($request->limit)->get();
        
        $products = ProductResource::collection( $products );
        
        return response()->json( $products );


    }
    public function storeQuery(Request $request){
        $data = [];
        $data['product_id'] = $request->params['product_id'];
        $data['user_name'] = $request->params['name'];
        $data['phone_number'] = $request->params['phone_number'];
        $data['product_query'] = $request->params['query'];

        $Query = Query::create($data);
        
        return response()->json( ['status' => 'success'] );


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


        $products = Product::with('category')->select($this->selectArray)->orderBy('id', 'desc')->take($request->limit)->get();

        $products = ProductResource::collection( $products );
        
        return response()->json( $products );


    }
}
