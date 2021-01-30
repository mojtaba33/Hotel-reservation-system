<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetBookablePriceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Bookable $bookable
     * @param  \Illuminate\Http\Request $request
     * @return int
     */
    public function __invoke(Bookable $bookable , Request $request)
    {
        $request->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from',
        ]);

        $days = Carbon::parse($request->input('from'))->diffInDays(Carbon::parse($request->input('to'))) + 1 ;
        $price = $days * $bookable->price;
        return response()->json([
            'data' => [
                'total' => $price,
                'breakdown' => [
                    $bookable->price => $days
                ]
            ]
        ]);
    }
}
