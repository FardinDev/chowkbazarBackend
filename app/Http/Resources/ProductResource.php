<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\AttributeResource;
use TCG\Voyager\Facades\Voyager;
use App\Product;
class ProductResource extends JsonResource
{
    
    function generateSlug($slug){

        return str_replace(' ', '-', strtolower($slug));
    }
    function generateName($name){

        $return = strlen($name ) > 75 ? substr($name ,0,75)."..." : $name;

        return $name;
    }
    
    function generateImages($Primary, $other){


        $other = json_decode($other);
        if($other){

            array_unshift($other,$Primary);
            $images = $other;
        }else{

            $images = [$Primary];
        }

        foreach ($images as $key => $image) {
            $images[$key] = voyager::image($image);
        }

        return $images;
    }
    function getBadges($badges, $id){
       $newBadges = [];



       $newProducts = Product::select('id')->orderBy('id', 'desc')->take(24)->get();
      foreach ($newProducts as $newProduct) {
        if ($newProduct->id == $id) {
            array_push($newBadges, 'new');
        }
      }
      $viewedProducts = Product::select('id')->orderBy('views', 'desc')->take(24)->get();
      foreach ($viewedProducts as $newProduct) {
        if ($newProduct->id == $id) {
            array_push($newBadges, 'view');
        }
      }

      if($badges){
        foreach ($badges as $badge) {
            array_push($newBadges, $badge->name);
        }
       }

        return $newBadges;
        
    }
    public function toArray($request)
    {
        $attributes = [
                        [
                            'text' => $this->text_one_title,
                            'value' => $this->text_one_text
                        ],
                        [
                            'text' => $this->text_two_title,
                            'value' => $this->text_two_text
                        ],
                        [
                            'text' => $this->text_three_title,
                            'value' => $this->text_three_text,
                        ],
                        [
                            'text' => $this->text_four_title,
                            'value' => $this->text_four_text
                        ],
                        [
                            'text' => $this->text_five_title,
                            'value' => $this->text_five_text
                        ]
        ];

        return [
            'id' => $this->id,
            'slug' =>$this->slug,
            'name' =>$this->generateName($this->name),
            'price' => $this->start_price,
            'start_price' => \number_format($this->start_price),
            'end_price' => \number_format($this->end_price),
            'minimum_orders' => $this->minimum_orders.' '.$this->unit,
            'compareAtPrice' => null,
            'images' => $this->generateImages($this->primary_image, $this->other_images),
            'badges' => $this->getBadges($this->badges, $this->id),
            'rating' => $this->wasRecentlyCreated,
            'reviews' =>'1564',
            'availability' =>'in-stock',
            'brand' =>'null',
            'categories' =>[ new ProductCategoryResource($this->category)],
            'attributes' => AttributeResource::collection( collect($attributes) ),
            'tags' => new TagResource($this),
            'customFields' => '12.3647',
            'views' => $this->views
        ];
    }
}
