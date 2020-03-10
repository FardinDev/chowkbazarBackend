<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ItemResource;
class SubCategoryResource extends JsonResource
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
                // 'id' => $this->id,
                'label' => $this->name,
                'url' => 'shop/catalog/'.$this->id,
                // 'items' => $this->childs ? new ItemResource($this) : []
            ];
        
        
  
    }
}
