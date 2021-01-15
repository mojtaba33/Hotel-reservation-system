<?php

namespace App\Http\Resources\Bookable;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookableCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->map(function($item){
            return [
                $item->title,
                $item->description,
            ];
        });
    }
}
