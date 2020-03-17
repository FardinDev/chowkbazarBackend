<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\ItemResource;
use TCG\Voyager\Facades\Voyager;

class MenuResource extends JsonResource
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
            'type' => 'megamenu',
            'size' => 'xl',
            'image' => voyager::image($this->thumbnail('medium')),
            'columns' =>  $this->childs ? ItemResource::collection($this->childs) : []
                ];
    }
}
