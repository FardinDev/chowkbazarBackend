<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{

    function generateSlug($slug){
        $slug = str_replace(',', '', strtolower($slug));
        $slug = str_replace('.', '', strtolower($slug));
        $slug = str_replace(' ', '-', strtolower($slug));

        return $slug;
        
    }

    public function toArray($request)
    {
        return [
            'name' => $this['text'],
            'slug' => $this->generateSlug( $this['text'] ),
            'featured' => true,
            'values' => [[
                'name' => $this['value'],
                'slug' => $this->generateSlug( $this['text'] ),
            ]]
        ];
    }
}
