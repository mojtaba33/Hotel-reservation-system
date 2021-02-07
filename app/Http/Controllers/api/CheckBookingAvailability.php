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

        $is_available = $bookable->checkAvailability($request->input('from'),$request->input('to'));

        return response()->json([
            'data' => ['is_available' => $is_available]
        ]);
    }
}
