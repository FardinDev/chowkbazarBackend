<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\ProductCategory;
use App\Product;
class CategoryFilterResource extends JsonResource
{

  private function getProductCount($slug){
     $category = ProductCategory::with('childs')->where('slug', $slug)->first();
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



            $products = Product::whereIn('category_id', $allChild)->select("id")->get();



    return count($products);



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
                  "items" => $this->getProductCount($this->slug),
                  "customFields" => [],
                  "parents" => null,
                  "children" => CategoryFilterResource::Collection($this->childs)
                ],
                // "count" => count($this->products)
              
        ];
    }
}
