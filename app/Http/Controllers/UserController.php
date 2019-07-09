<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MyEvent;
use App\Events\StatusLiked;
use App\SliderInfo;
use App\ProductCategory;
use App\Product;
use App\Product_query;
use App\Source_product;
use DB;
use App\Source_product_file;
use Pusher\Pusher;
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
    public function sendQuery(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|max:15',
            'phone_number' => 'required|min:11',
            'product_query' => 'required|max:1000'
        ]);

$data['product_id'] = $id;
$data['user_name'] = $request->user_name;
$data['phone_number'] = $request->phone_number;
$data['product_query'] = $request->product_query;

Product_query::create($data);

return redirect()->back()->with('success', 'Query Sent Successfully! We will contact you at the given number.');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allProducts()
    {
    //     $check = [];

    //    $pro = ProductCategory::with('childs')->where('parent_id', 29)->get();

    //    foreach ($pro as $k) {
    //        array_push($check, $k->id);
    //        if($k->childs){

    //            foreach ($k->childs as $c) {
    //                array_push($check, $c->id);
    //            }
    //        }
    //    }
        // dd($check);
        $products = Product::inRandomOrder()->take(5)->get();
        $cats = $this->getCat();

        return view('user.all_product', compact('cats', 'products'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getParentCat(Request $request)
    {
        if($request->id){

            $parent_id = $request->id;
            $check = [];
    
           $pro = ProductCategory::with('childs')->where('parent_id', $parent_id)->get();
    
           foreach ($pro as $k) {
               array_push($check, $k->id);
               if($k->childs){
    
                   foreach ($k->childs as $c) {
                       array_push($check, $c->id);
                   }
               }
           }
    
           return response()->json($check);
        }

        elseif ($request->data) {
            $data = $request->data;
            
            $products = Product::select('id', 'name', 'primary_image', 'start_price', 'end_price')->whereIn('category_id', $data)->get();

           return response()->json($products);


        }
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
    public function test()
    {
        event(new MyEvent('hello world'));
        return 'sent';
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchProduct(Request $request)
    {
        if($request->get('query'))
        {
         $query = $request->get('query');
   
         $data = DB::table('products')
           ->where('name', 'LIKE', "%{$query}%")
           ->orWhere('tags', 'LIKE', "%{$query}%")
           ->take(5)
           ->get();
           if(sizeof($data) > 0){

               $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
               foreach($data as $row)
               {
                $output .= '
                <li>
                <a href="'.route('product', $row->id).'" style="white-space: normal !important; display: flex">
                <img src="'.$row->primary_image.'" style="height:60px">
                <div>
                <label class="name">'.$row->name.'</label>
                <label class="name price" >'.$row->start_price.'-'.$row->end_price.' <small>BDT</small></label>
                </div>
                </a>
                </li>
                ';
               }
               $output .= '</ul>';
           }else{
            $output = '
            <ul class="dropdown-menu" style="display:block; position:relative; width:293px; text-align: -webkit-center">
                <li>
                <div>
                <label>No products Found for '.$query.'!!</label>
                </div>
                </li>
            </ul>';
            
        }
        echo $output;
        }
    }
}
