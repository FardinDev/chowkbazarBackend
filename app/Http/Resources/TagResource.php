<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $tags = explode(',', $this->tags);
        usort($tags, function ($a, $b) { return (strlen($a) <=> strlen($b)); });
        return $tags;
        // return array_slice( explode(',', $this->tags), 0, 3, true);
    }
}
