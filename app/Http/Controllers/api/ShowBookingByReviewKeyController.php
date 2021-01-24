<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\ShowBookingByReviewKey;
use App\Models\Booking;
use Illuminate\Http\Request;

class ShowBookingByReviewKeyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Booking $booking
     * @return ShowBookingByReviewKey
     */
    public function __invoke(Booking $booking)
    {
        return new ShowBookingByReviewKey($booking);
    }
}
