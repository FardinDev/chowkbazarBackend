<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class SliderResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'title' => $this->title ?? '',
            'subtitle' => $this->subtitle ?? '',
            'text' => $this->short_description ?? '',
            'image_classic' => Str_replace('.jpg', '-classic.jpg', voyager::image($this->main_image)) ?? '',
            'image_full' => voyager::image($this->main_image) ?? '',
            'image_mobile' => Str_replace('.jpg', '-mobile.jpg', voyager::image($this->main_image)) ?? '',
            'url' => $this->button_url ?? ''
        ];
    }
}
