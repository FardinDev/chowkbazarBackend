<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SliderInfo;
use App\ProductCategory;
use App\Product;
use App\Source_product;
use DB;
use App\Source_product_file;

class UserController extends Controller
{

    private $sourceFileLocation = 'images/source-product-files/';
    private function getCat(){
        return ProductCategory::where('parent_id', NULL)->get();
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {   
        $cats = $this->getCat();
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
        $cats = $this->getCat();
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
    public function sourceProduct()
    
    {
        $cats = $this->getCat();

        return view('user.source', compact('cats'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sourceProductStore(Request $request)
    
    {
        $validatedData = $request->validate([
            'user_name' => 'required|max:15',
            'user_phone' => 'required'
        ]);
        $data['user_name'] = $request->user_name;
        $data['user_phone'] = $request->user_phone;
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_description'] = $request->product_description;
        $data['product_url'] = $request->product_url;

        $productImages = [];
        
        if(!empty($request->file)){

            $files = $request->file;
            $i = 1;
            {
                foreach ($files as $file) {
                    $filename = $i.'_'.$file->getClientOriginalName();
                    $file->move($this->sourceFileLocation, $filename);
                    
                    array_push($productImages, $this->sourceFileLocation.''.$filename);

                    $i++;
                }
            }
        }
            
            $data['product_images'] = json_encode($productImages);
            $source = Source_product::create($data);
       return redirect()->back()->with('success','Your request is submitted! We will contact you at the given number.');;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendQuery($id)
    {
        dd(product::find($id));
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
