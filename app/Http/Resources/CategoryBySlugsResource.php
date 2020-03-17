<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;
class CategoryBySlugsResource extends JsonResource
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
            'id' => $this->id,
            'type' => 'shop',
            'name' => $this->name,
            'slug' => $this->slug,
            'path' => $this->slug,
            'image' =>  voyager::image($this->thumbnail('medium')),
            'items' => count($this->products),
            'customFields' => '',
            // 'parents' => $this->parent ? new CategoryBySlugsResource($this->parent) : null,
            'children' => $this->childs ? CategoryBySlugsResource::collection($this->childs) : null,
        ];
    }
}
