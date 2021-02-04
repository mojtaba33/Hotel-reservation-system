<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
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

        $price = $bookable->getPrice($request->input('from'),$request->input('to'));

        return response()->json([
            'data' => $price ,
        ]);
    }
}
