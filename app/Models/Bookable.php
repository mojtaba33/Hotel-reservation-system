<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    use HasFactory;
    use Sluggable;

    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getPrice($from , $to): array
    {
        $days = Carbon::parse($from)->diffInDays(Carbon::parse($to)) + 1 ;
        $price = $days * $this->price;

        return [
            'total' => $price,
            'breakdown' => [
                $this->price => $days
            ],
        ];
    }
}
