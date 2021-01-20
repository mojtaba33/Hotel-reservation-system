<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use Illuminate\Http\Request;

class CheckBookingAvailability extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Bookable $bookable
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Bookable $bookable , Request $request)
    {
        $request->validate([
            'from' => 'required|date_format:Y-m-d|after_or_equal:today',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from',
        ]);

        $bookings = $bookable->bookings()
            ->where('to','>=',$request->input('from'))
            ->where('from','<=',$request->input('to'))
            ->get()->count();

        $is_available = $bookings === 0 ;

        return response()->json([
            'data' => ['is_available' => $is_available]
        ]);
    }
}
