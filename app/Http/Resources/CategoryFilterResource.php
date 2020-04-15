<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\ProductCategory;
use App\Product;
class CategoryFilterResource extends JsonResource
{

  private function getProductCount($slug){
   
        $allChild = getAllChildsBySlug( $slug );
        $products = Product::whereIn('category_id', $allChild)->select("id")->get()->count();
        return $products;
    
}
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            
                "slug" => $this->slug,
                "name" => $this->name,
                "type" => "child",
                "category" => [
                  "id" => $this->id,
                  "type" => "shop",
                  "name" => $this->name,
                  "slug" => $this->slug,
                  "path" => $this->slug,
                  "image" => $this->image,
                  "items" => (integer) $this->item_count,
                  "customFields" => [],
                  "parents" => null,
                  "children" => CategoryFilterResource::Collection($this->childs)
                ],
                "count" => (integer) $this->item_count
              
        ];
    }
}
