<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_query as Query;
use App\Attribute;
use App\Source_product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDescriptionResource;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\SingleCategoryFilterResource;
use App\Http\Filters\ProductFilter;

use App\ProductCategory;
use App\Http\Resources\CategoryFilterResource;

use Storage;
class ProductController extends Controller
{
    private $sourceFileLocation = 'images/source-product-files/';
    private $take = 24;
    private $selectArray = ['id', 'name', 'slug', 'category_id', 'start_price', 'end_price', 'primary_image', 'other_images', 'is_featured', 'views', 'minimum_orders', 'unit', 'tags'
];

private function formatCategory($category, $type){
            return [
                    
                "slug" => $category->slug,
                "name" => $category->name,
                "type" => $type,
                "category" => [
                "id" => $category->id,
                "type" => "shop",
                "name" => $category->name,
                "slug" => $category->slug,
                "path" => $category->slug,
                "image" => $category->image,
                "items" => $category->item_count,
                "customFields" => [],
                "parents" => null,
                "children" => CategoryFilterResource::Collection($category->childs)
                ],
                "count" => $category->item_count
            
        ];

}

    private function getProductCount($slug){
        $allChild = getAllChildsBySlug( $slug );
        $products = Product::whereIn('category_id', $allChild)->select("id")->get()->count();
        return $products;
    }

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

    function myUrlEncode($string) {
        $entities = array('%20', '%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array(' ', '!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
        return str_replace($entities, $replacements, $string);
    }
    public function getProductList(Request $request, ProductFilter $filter){

        $minPrice = 0;
        $maxPrice = 100000; 
        $limit =  12;
        $sort = 'default';
        $order = null;
        $category = null;
        $tag = null;
        $search = null;
        $view = null;
        $categories = CategoryFilterResource::collection(ProductCategory::where('parent_id', null)->orderBy('name')->get());
        $root = true;
       if (!empty($request->params) ) {
   
            if ( array_key_exists('category', $request->params)) {
                $category = $request->params['category'];
            }

            if ( array_key_exists('sort', $request->params)) {

                if ( $request->params['sort'] !== 'default') {
                    # code...
                    $sortparams = explode('_', $request->params['sort']);
                    $sort = $sortparams[0];
                    $order = $sortparams[1];
                }

            }

            if ( array_key_exists('limit', $request->params)) {
                $limit = $request->params['limit'];
            }
            if ( array_key_exists('tag', $request->params)) {
                $tag = $request->params['tag'];

                $tag = $this->myUrlEncode($tag);
            }
            if ( array_key_exists('search', $request->params)) {

                $search = $request->params['search'];

        
            }
            if ( array_key_exists('view', $request->params)) {

                $view = $request->params['view'];

        
            }
       }


    if ($category != null) {
        

        if ($sort !== 'default' && $order !== null) {

            $products = Product::select($this->selectArray)
        ->whereHas('category', function ($query) use ($category) {
            $query->where('slug', $category);
        })
        ->orderBy($sort, $order)
        ->paginate($limit);
          
        }else{

            $products = Product::select($this->selectArray)
        ->whereHas('category', function ($query) use ($category) {
            $query->where('slug', $category);
        })
        ->paginate($limit);

        }

        $categories = [];
        $current = ProductCategory::where('slug', $category)->with('products')->first();
        $currentChilds = $current->childs;

        if ($current->parent_id != null) {
            $parent = $current->parent;
            array_push($categories, $this->formatCategory($parent, 'parent'));
        }
        array_push($categories, $this->formatCategory($current, 'current'));

        foreach ($currentChilds as $childs ) {
            array_push($categories, $this->formatCategory($childs, 'child')); 
        }
        $root = false;
        

    }else{
        if ($tag != null && $tag != 'all') {

            if ($sort !== 'default' && $order !== null) {

                $products = Product::select($this->selectArray)
                ->where('tags', 'like', "%{$tag}%")
                ->orderBy($sort, $order)
                ->paginate(100);

            } else {

                $products = Product::select($this->selectArray)
                ->where('tags', 'like', "%{$tag}%")
                ->inRandomOrder()
                ->paginate(100);
            }
            
           

        }else if ($search != null && $search != 'all') {


            if ($sort !== 'default' && $order !== null) {

                $products = Product::whereHas('category', function ($q) use ($search){
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('tags', 'like', "%{$search}%")
                ->select($this->selectArray)
                ->orderBy($sort, $order)
                ->paginate(100);

            } else {

                $products = Product::whereHas('category', function ($q) use ($search){
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('tags', 'like', "%{$search}%")
                ->select($this->selectArray)
                ->inRandomOrder()
                ->paginate(100);
            }
           
        
        }else if ($view != null && $view != 'all') {

            if ($view == 'featured') {
                # code...
                if ($sort !== 'default' && $order !== null) {

                    $products = Product::with('category')->whereHas('badges', function($q){
                        $q->where('name', 'featured');
                    })
                    ->select($this->selectArray)
                    ->orderBy($sort, $order)
                    ->paginate(100);
    
                } else {
    
                    $products = Product::with('category')->whereHas('badges', function($q){
                        $q->where('name', 'featured');
                    })
                    ->select($this->selectArray)
                    ->inRandomOrder()
                    ->paginate(100);
                }

                

            }else if ($view == 'most-viewed') {
                # code...

                if ($sort !== 'default' && $order !== null) {

                    $products = Product::with('category')
                    ->select($this->selectArray)
                    ->where('views', '>', 20)
                    ->orderBy('views', 'desc')
                    ->orderBy($sort, $order)
                    ->paginate(100);
    
                } else {
    
                    $products = Product::with('category')
                    ->select($this->selectArray)
                    ->where('views', '>', 20)
                    ->orderBy('views', 'desc')
                    ->inRandomOrder()
                    ->paginate(100);
                }

            }else{

                

                if ($sort !== 'default' && $order !== null) {

                $products = Product::select($this->selectArray)
                            ->orderBy($sort, $order)
                            ->paginate($limit);
                } else {
    
                $products = Product::select($this->selectArray)
                            ->inRandomOrder()
                            ->paginate($limit);
                }
            }

        }
        else{

            if ($sort !== 'default' && $order !== null) {

                $products = Product::select($this->selectArray)
                            ->orderBy($sort, $order)
                            ->paginate($limit);
                } else {
    
                $products = Product::select($this->selectArray)
                            ->inRandomOrder()
                            ->paginate($limit);
                }
            
        }

    }



        $list = [
            "items" => ProductResource::collection(collect($products->items())),
            "page" =>  $request->page ? (int) $request->page : 1,
            "limit" => (int) $limit,
            "tag" => $tag ?? 'all',
            "search" => $tag ?? 'all',
            "view" => $tag ?? 'all',
            "total" => $products->total(),
            "pages" => $products->lastPage(),
            "from" => $products->firstItem(),
            "to" => $products->lastItem(),
            "sort" => $order != null ? $sort.'_'.$order : $sort,
            "filters" => [
            [
                "type" => "categories",
                "slug" => "categories",
                "name" => "Categories",
                "root" => $root,
                "items" =>  $categories
            ],
            [
                "type" => "tag",
                "slug" => "tag",
                "name" => "Tags",
                "items" =>  $this->generateTags()
            ],
            ],
            "filterValues" => []
        ];
// work needed
        return response()->json( $list );

    }

    public function generateTags(){
        $data = Product::select('tags')->inRandomOrder()->select('tags')->take(10)->get();
        $tagString = '';
                foreach($data as $item){
                    if($item->tags != null){
                        $tagString .= $item->tags.',';
                    }
                }
                $tagString = rtrim($tagString,',');

                $tagArray = explode(',', $tagString);

                return  array_slice($tagArray, 0, 20);;
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

    public function storeSourceProduct(Request $request){

        $data['user_name'] = $request->name;
        $data['user_phone'] = $request->phoneOrEmail;
        $data['product_name'] = $request->productName;
        $data['product_quantity'] = $request->productQuantity;
        $data['product_description'] = $request->productDescription;
        $data['product_url'] = $request->alibabaUrl ?? '';

        $productImages = [];
        
        // return response()->json( $request->images );
        if(!empty($request->images)){

            $images =  $request->images ;
  
                foreach ($images as $key => $value) {
   
                    $image_parts = explode(";base64,", $value);
                   
                    $image_type_aux = explode("image/", $image_parts[0]);
                   
                    $image_type = $image_type_aux[1];
                  
                    $image_base64 = base64_decode($image_parts[1]);
                  
                    $image = $this->sourceFileLocation . uniqid() . '.'.$image_type;
                  
                    file_put_contents($image, $image_base64);

                    array_push($productImages, $image);
                }
            
        }
            
        $data['product_images'] = json_encode($productImages);

        $source = Source_product::create($data);

        if ($source) {
            return response()->json( ['status' => 'success'] );
        } else {
            return response()->json( ['status' => 'error'] );
        }
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


    public function store(Request $request){
        
        $images = $this->storeImages($request->primary_image, $request->other_images);

        if ($images) {
            $finalData = [];
            $finalData["web_url"] = preg_replace('/[\x{FFFF}-\x{FFFF}]+/u','',$request->url);
            $finalData["name"] = preg_replace('/[\x{FFFF}-\x{FFFF}]+/u','',$request->name);
            $finalData["slug"] = preg_replace('/[\x{FFFF}-\x{FFFF}]+/u','',$request->slug);
            $finalData["description" ] = preg_replace('/[\x{FFFF}-\x{FFFF}]+/u','',$request->description);
            $finalData["category_id"] = $request->category;
            $finalData["start_price"] = $request->start_price;
            $finalData["end_price" ] = $request->end_price ;
            $finalData["minimum_orders" ] = $request->minimum_orders;
            $finalData["unit"] = $request->unit;
            $finalData["primary_image"] = $images['primary_image'];
            $finalData["other_images" ] =  $images['other_images'];
            $finalData["tags"] =  implode (",", $request->tags);
            $finalData["type"] =  1;
    
            $product = Product::create($finalData);
    
            for ($i=0; $i < sizeof($request->attribute_title); $i++) { 
                if ($request->attribute_title[$i] && $request->attribute_value[$i]) {
                        $attrData = [
                            'product_id' => $product->id,
                            'name' => $request->attribute_title[$i],
                            'value' => $request->attribute_value[$i]
                        ];
                    Attribute::create($attrData);
                }
            }
    
            foreach ($request->badge as $badge) {
               $product->badges()->attach($badge);
            }
    
            return response()->json(  $product->id );
        }

    }


    public function storeImages($primaryImage, $otherImages){

        $ldate = date('FY');
       
        $primaryImageUrl = 'http:'.$primaryImage;
        $otherImageNames = $otherImages;

            if(false == ($primaryContents = @file_get_contents($primaryImageUrl))){
                $primaryImageName = $primaryImageUrl;
            }else{
                $primaryImageName = 'products/'.$ldate.'/'.substr($primaryImageUrl, strrpos($primaryImageUrl, '/') + 1);
                Storage::put('public/'.$primaryImageName, $primaryContents);
                $primaryImageName = str_replace('/', '\\', $primaryImageName  );
            }

            foreach ($otherImageNames as $key => $otherImage) {
                if (strpos($otherImage, 'video.') !== false) {
                    unset($otherImageNames[$key]);
                }
                $otherImageUrl = 'http:'.$otherImage;
                if(false == ($otherContents = @file_get_contents($otherImageUrl))){
                    unset($otherImageNames[$key]);
                }
            }
                array_shift($otherImageNames);

            foreach ($otherImageNames as $key => $otherImage) {
                    $otherImageUrl = 'http:'.$otherImage;
                    $otherContents = file_get_contents($otherImageUrl);
                    $n = explode("/", $otherImageUrl);
                    $otherImageName = $n[sizeof($n) - 2].'-'.$n[sizeof($n) - 1]  ;
                    $otherImageName = 'products/'.$ldate.'/other_images/'.$otherImageName;
                    Storage::put('public/'.$otherImageName, $otherContents);
                    $otherImageNames[$key] = str_replace('/', '\\', $otherImageName  );
            }

            $otherImageNames = json_encode($otherImageNames);

            return ['primary_image' => $primaryImageName, 'other_images' => $otherImageNames];
        
    }
}
