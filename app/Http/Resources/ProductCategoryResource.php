<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class ProductCategoryResource extends JsonResource
{
    function generateSlug($name){

        return str_replace(' ', '-', strtolower($name));

    }

    public function toArray($request)
    {

        return [
            'id'=>  $this->id,
            'type'=>  'shop',
            'name' => $this->name,
            'slug' => $this->generateSlug($this->name),
            'path'=>  $this->generateSlug($this->name),
            'image'=> voyager::image($this->image) ?? null,
            'items'=>  [],
            'customFields'=>  'CustomFields',
            'parents'=>  'Category',
            'children'=>  'Category',
        ];
    }
}
