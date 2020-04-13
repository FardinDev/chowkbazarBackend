<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\Http\Resources\SearchProductResource;

class SearchController extends Controller
{
    private $selectArray = ['name', 'slug',  'start_price', 'end_price', 'primary_image',  'views', 'minimum_orders', 'unit', 'tags'];

    public function search(Request $request){
        if($request->input('search') && $request->input('search') != '')
        {
            $query = $request->input('search');
   
            $data = Product::whereHas('category', function ($q) use ($query){
               $q->where('name', 'like', "%{$query}%");
           })
           ->orWhere('name', 'like', "%{$query}%")
           ->orWhere('tags', 'like', "%{$query}%")
           ->select($this->selectArray)
           ->take(8)
           ->get();

           $products = SearchProductResource::collection($data);
           return response()->json( $products );
        }
        
        



    }
}
