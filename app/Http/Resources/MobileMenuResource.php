<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MobileMenuResource extends JsonResource
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
            'type' => 'link', 
            'label' => $this->name, 
            'url' => '/shop/catalog/'.$this->slug, 
            'children' => $this->childs ?  MobileMenuResource::Collection($this->childs) : [],
        ];
    }
}
