<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class ProductCategoryResource extends JsonResource
{
    function generateSlug($slug){

        return str_replace(' ', '-', strtolower($slug));

    }

    public function toArray($request)
    {

        return [
            'id'=>  $this->id,
            'type'=>  'shop',
            'name' => $this->name,
            'slug' => $this->slug,
            'path'=>  $this->generateSlug($this->name),
            'image'=> voyager::image($this->image) ?? null,
            'items'=>  [],
            'customFields'=>  'CustomFields',
            'parents'=>  'Category',
            'children'=>  'Category',
        ];
    }
}
