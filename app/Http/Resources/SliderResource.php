<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class SliderResource extends JsonResource
{

    function getThumbnail($image, $type){

        $images = \explode('.', $image);

        return $images[0].'-'.$type.'.'.$images[1];

    }
    
    public function toArray($request)
    {
        return [
            'title' => $this->title ?? '',
            'subtitle' => $this->subtitle ?? '',
            'text' => $this->short_description ?? '',
            'image_classic' =>  voyager::image($this->desktop_image),
            'image_full' => voyager::image($this->main_image) ?? '',
            'image_mobile' =>voyager::image($this->getThumbnail($this->main_image, 'mobile')),
            'url' => $this->button_url ?? ''
        ];
    }
}
