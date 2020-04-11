<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ItemResource;
class ColumnResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {if (count($this->childs)) {
        return 
        [
        'size' => 4,
        'items' =>  ItemResource::collection($this->childs)
        ];
     } else {
        return 
                    [
                    'label' => $this->name,
                    'url' => 'shop/catalog/'.$this->slug


            ];
     }
    }
}
