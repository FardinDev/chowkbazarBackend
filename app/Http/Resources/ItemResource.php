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
     
            return count($this->childs) ? [
                'size' => 4,
                'items' => [
                    [
                    'label' => $this->name,
                    'url' => 'shop/catalog/'.$this->id,
                    'items' =>   SubCategoryResource::collection($this->childs),
                ]
                ]
            ] : 
            [
                'size' => 4,
                'items' => [
                    [
                    'label' => $this->name,
                    'url' => 'shop/catalog/'.$this->id
                   
                ]
                ]
            ];
        
    }
}
