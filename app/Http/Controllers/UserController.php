<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SliderInfo;
use App\ProductCategory;
use App\Product;
use DB;

class UserController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $cats = ProductCategory::where('parent_id', NULL)->get();
        $products = Product::orderBy('id')->get();
        $sliders = SliderInfo::where('is_active', 1)->get();
        $brands = Product::select('brand', DB::raw('count(*) as count'))->groupBy('brand')->get();

        return view('user.home')->with(
            [
                'sliders' => $sliders,
                'cats' => $cats,
                'products' => $products,
                'brands' => $brands
                ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewProduct($id)
    {
        $cats = ProductCategory::with('childs')->where('parent_id', NULL)->get();
        $product = Product::where('id', $id)->first();
        $products = Product::orderBy('id')->get();
        $brands = Product::select('brand', DB::raw('count(*) as count'))->groupBy('brand')->get();

    
        return view('user.product-view')->with(
            [
           
                'cats' => $cats,
                'product' => $product,
                'products' => $products,
                'brands' => $brands
            
                ]);;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
