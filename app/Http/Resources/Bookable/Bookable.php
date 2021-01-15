<?php

namespace App\Http\Resources\Bookable;

use Illuminate\Http\Resources\Json\JsonResource;

class Bookable extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
