<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;
class SearchProductResource extends JsonResource
{
    function generateName($name){

        $return = strlen($name ) > 35 ? substr($name ,0,35)."..." : $name;

        return $return;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->generateName($this->name),
            'slug' => $this->slug,
            'image' =>  voyager::image($this->primary_image),
            'start_price' => \number_format($this->start_price),
            'end_price' => \number_format($this->end_price),
            'minimum_orders' => $this->minimum_orders.' '.$this->unit,
            'views' => $this->views

        ];
    }
}
