<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowBookingByReviewKey extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $bookable = $this->bookable;
        return [
            'id' => $this->id ,
            'from' => $this->from ,
            'to' => $this->to ,
            'created_at' => $this->created_at ,
            'bookable' => [
                'id' => $bookable->id,
                'title' => $bookable->title,
                'slug' => $bookable->slug,
            ]
        ];
    }
}
