<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;

class ProductListResource extends JsonResource
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
            "items" => ProductResource::collection(collect($this->items())),
            "page" => $this->currentPage(),
            "limit" => (int) $this->perPage(),
            "total" => $this->total(),
            "pages" => $this->lastPage(),
            "from" => $this->currentPage(),
            "to" => $this->lastPage(),
            "sort" => "default",
            "filters" => [
            [
                "type" => "categories",
                "slug" => "categories",
                "name" => "Categories",
                "root" => true,
                "items" => []
            ],
            [
                "type" => "range",
                "slug" => "price",
                "name" => "Price",
                "value" => [
                0,
                3200
                ],
                "min"=> 0,
                "max"=> 3200
            ],
        
            ],
            "filterValues" => []
        ];
    }
}
