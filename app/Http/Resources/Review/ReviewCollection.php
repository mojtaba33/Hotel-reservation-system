<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item){
            return [
                'username' => $item->booking->address->full_name,
                'content' => $item->content,
                'created_at' => $item->created_at,
                'rating' => $item->rating,
            ];
        });
    }
}
