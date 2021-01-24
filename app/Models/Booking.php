<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['from' , 'to' , 'bookable_id'];

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($booking) {
            $booking->review_key = Str::uuid();
        });
    }
}
