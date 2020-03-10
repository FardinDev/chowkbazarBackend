<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SubCategoryResource;
class ItemResource extends JsonResource
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
                'size' => 4,
                'items' => [
                    [
                    'label' => $this->name,
                    'url' => 'shop/catalog/'.$this->id,
                    'items' =>  count($this->childs) ? SubCategoryResource::collection($this->childs) : [],
                ]
                ]
            ];
        
    }
}
