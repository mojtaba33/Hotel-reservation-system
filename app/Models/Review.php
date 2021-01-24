<?php

namespace App\Models;

use App\Models\traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory , UsesUuid;

    protected $fillable = ['content','rating','bookable_id','booking_id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }
}