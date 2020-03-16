<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\TagResource;

class ProductResource extends JsonResource
{
    
    function generateSlug($name){

        return str_replace(' ', '-', strtolower($name));
    }
    function generateName($name){

        $return = strlen($name ) > 75 ? substr($name ,0,75)."..." : $name;

        return $return;
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' =>$this->generateSlug($this->name),
            'name' =>$this->generateName($this->name),
            'price' => $this->start_price,
            'start_price' => $this->start_price,
            'end_price' => $this->end_price,
            'minimum_orders' => $this->minimum_orders.' '.$this->unit,
            'compareAtPrice' => null,
            'images' =>[$this->primary_image],
            'badges' =>['featured'],
            'rating' =>'5',
            'reviews' =>'1564',
            'availability' =>'in-stock',
            'brand' =>'null',
            'categories' =>[ new ProductCategoryResource($this->category)],
            'attributes' => [],
            'tags' => new TagResource($this),
            'customFields' => '12.3647',
        ];
    }
}
