<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{

    public function slugify($text){
    
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
    
        // trim
        $text = trim($text, '-');
    
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
    
        // lowercase
        $text = strtolower($text);
    
        if (empty($text)) {
            return 'n-a';
        }
    
      return $text;
    }
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'slug' => $this->slugify( $this->name ),
            'featured' => true,
            'values' => [[
                'name' => $this->value,
                'slug' => $this->slugify( $this->value ),
            ]]
        ];
    }
}
