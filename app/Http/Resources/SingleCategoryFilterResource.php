<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleCategoryFilterResource extends JsonResource
{
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
            "type" => "current",
            "category" => [
              "id" => $this->id,
              "type" => "shop",
              "name" => $this->name,
              "slug" => $this->slug,
              "path" => $this->slug,
              "image" => $this->image,
              "items" => count($this->products),
              "customFields" => [],
              "parents" => null,
              "children" => CategoryFilterResource::Collection($this->childs)
            ],
            "count" => count($this->products)
          
        ];
    }
}
