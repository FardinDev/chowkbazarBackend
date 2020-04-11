<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MenuResource;

class CategoryResource extends JsonResource
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
            'url' => 'shop/catalog/'.$this->slug,
            'menu' => $this->childs ? new MenuResource( $this ) : []
        ];
    }
}
