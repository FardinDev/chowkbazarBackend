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
use Illuminate\Database\Eloquent\Builder;
class UserController extends Controller
{

    private $sourceFileLocation = 'images/source-product-files/';
    public $query = '';
    private $selectArray = ['id', 'name', 'start_price', 'end_price', 'primary_image', 'views'];
    private function getCat(){
        return ProductCategory::where('parent_id', NULL)->orderBy('name')->get();
    }
    private function categoryChild($id){
        $category = ProductCategory::with('childs')->where('id', $id)->first();
        $childs = $category->childs;
        $firstChild = [];
        $secondChild = [];
        foreach ($childs as $fc) {
            array_push($firstChild, $fc->id);
            if($fc->childs){
                foreach ($fc->childs as $sc) {
                    array_push($secondChild, $sc->id);
                }
            }
        }
        $allChild = array_merge($firstChild, $secondChild);
        array_push($allChild, $category->id);



        $return = Product::whereIn('category_id', $allChild)
        ->select($this->selectArray)
        ->take(4)
        ->inRandomOrder()
        ->get();

        return $return;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {   
        $cat_id = [1,3,4,10,11];
      
        
        
        $apparels = $this->categoryChild(1);
        $bags = $this->categoryChild(3);
        $electronics = $this->categoryChild(4);
        $machineries = $this->categoryChild(10);
        $packagings = $this->categoryChild(11);



        $cats = $this->getCat();
        $products = Product::where('is_featured', 1)->select($this->selectArray)->get();
        $sliders = SliderInfo::where('is_active', 1)->get();
        
        
        return view('user.home')->with(
            [
                'sliders' => $sliders,
                'cats' => $cats,
                'products' => $products,
                'apparels' => $apparels,
                'bags' => $bags,
                'electronics' => $electronics,
                'machineries' => $machineries,
                'packagings' => $packagings

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
        $product->increment('views');
        $products = Product::orderBy('id')->get();
      

    
        return view('user.product-view')->with(
            [
           
                'cats' => $cats,
                'product' => $product,
                'products' => $products,
            
                ]);;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recommended(Request $request)
    {
        
        if($request->page == 'product'){
            if($request->tags != ''){

                $tags = explode(',', $request->tags);
                // return $tags;
            
                $products = Product::Where(function ($query) use($tags) {
                    for ($i = 0; $i < count($tags); $i++){
                    $query->orwhere('tags', 'like',  '%' . $tags[$i] .'%');
                    }      
            })->inRandomOrder()->select($this->selectArray)->get();

            }else{
                $products = Product::where('is_featured', 1)->inRandomOrder()->select($this->selectArray)->take(6)->get();
            }
            $string = '<div class="row"><h2 class="title text-center">You may also like</h2>';

            foreach ($products as $product) {
                $string .= '<div class="col">
                <div class="product-image-wrapper-r" style="margin:25px" onclick="window.location.href=`'.route('product', $product->id).'`">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="'.$product->primary_image.'" alt="" />
                            <h4>'.$product->start_price.'-'.$product->end_price.'<small> BDT</small></h4>
                            <p class="">'.$product->name.'</p>
                        </div>
                    </div>
                </div>
            </div>';
            }
            $string .= '</div>';
            return $string;
            
        }else{

            $products = Product::inRandomOrder()->take(6)->select($this->selectArray)->get();
            $string = '<div class="row"><h2 class="title text-center">You may also like</h2>';

            foreach ($products as $product) {
                $string .= '<div class="col-sm-2">
                <div class="product-image-wrapper-r" onclick="window.location.href=`'.route('product', $product->id).'`">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="'.$product->primary_image.'" alt="" />
                            <h4>'.$product->start_price.'-'.$product->end_price.'<small> BDT</small></h4>
                            <p class="">'.$product->name.'</p>
                        </div>
                    </div>
                </div>
            </div>';
            }
            $string .= '</div>';
            return $string;
        }
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
       return redirect()->back()->with('success','Your request is submitted! We will contact you at the given contact info.');;
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

        return redirect()->back()->with('success', 'Query Sent Successfully! We will contact you at the given contact info.');

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
    public function allProducts(Request $request)
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

        if(isset($request->search_query)){
            $this->query = $request->search_query;
   
            $products = Product::whereHas('category', function (Builder $q) {
               $q->where('name', 'like', "%{$this->query}%");
           })
           ->orWhere('name', 'like', "%{$this->query}%")
           ->orWhere('tags', 'like', "%{$this->query}%")
           ->select($this->selectArray)
           ->paginate(12);
        }else if(isset($request->category)){
            $this->query = $request->category;


            $category = ProductCategory::with('childs')->where('name','like', "%{$this->query}%")->first();
            $childs = $category->childs;
            
            $firstChild = [];
            $secondChild = [];
            foreach ($childs as $fc) {
                array_push($firstChild, $fc->id);
                if($fc->childs){
                    foreach ($fc->childs as $sc) {
                        array_push($secondChild, $sc->id);
                    }
                }
            }

            $allChild = array_merge($firstChild, $secondChild);
            array_push($allChild, $category->id);



            $products = Product::whereIn('category_id', $allChild)->select($this->selectArray)->paginate(12);



        }
        else{

            $products = Product::inRandomOrder()->select($this->selectArray)->paginate(12);
        }

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
            
            $products = Product::select($this->selectArray)->whereIn('category_id', $data)->get();

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
            $this->query = $request->get('query');
   
            $data = Product::whereHas('category', function (Builder $q) {
               $q->where('name', 'like', "%{$this->query}%");
           })
           ->orWhere('name', 'like', "%{$this->query}%")
           ->orWhere('tags', 'like', "%{$this->query}%")
           ->select($this->selectArray)
           ->get();

           if(sizeof($data) > 0){

               $output = '<ul class="dropdown-menu" style="display:block; position:relative width:293px;">';
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
                <label>No products Found for '.$this->query.'!!</label>
                </div>
                </li>
            </ul>';
            
        }
        echo $output;
        }
    }


    public function eloquent(Request $request){

        $this->query = $request->get('query');
   
         $data = Product::whereHas('category', function (Builder $q) {
            $q->where('name', 'like', "%{$this->query}%");
        })
        ->orWhere('name', 'like', "%{$this->query}%")
        ->orWhere('tags', 'like', "%{$this->query}%")
        ->select($this->selectArray)
        ->get();

        dd($data);
    }

    public function orderBy(Request $request){

        return $request->data;
        
    }
    
    public function tags(Request $request){
        $data = Product::select('tags')->inRandomOrder()->select('tags')->take(10)->get();
        $string = '';
                foreach($data as $item){
                    if($item->tags != null){
                        $string .= $item->tags.',';
                    }
                }
                $string = rtrim($string,',');

                $stringArray = explode(',', $string);
        $finalString = '';
        for ($i=0; $i < sizeof($stringArray); $i++) { 
            $finalString .= ' <a href="'.route('product.all',['search_query' => $stringArray[$i]]).'"><label class="label label-warning text-light" style="color:white !important; background-color:#FE980F !important; cursor:pointer">'.$stringArray[$i].'</label></a> ';
        }
                return $finalString;
            }

}
