<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Bookable;
use App\Models\Booking;
use App\Rules\Available;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "bookable" => "required|array",
            "bookable.*.slug" => "required|exists:bookables,slug",
            "bookable.*.from" => "required|date_format:Y-m-d|after_or_equal:today",
            "bookable.*.to" => "required|date_format:Y-m-d|after_or_equal:bookable.from",
            "bookable.*" => [new Available()],

            "address.name" => "required",
            "address.last_name" => "required",
            "address.city" => "required",
            "address.country" => "required",
            "address.state" => "required",
            "address.zip" => "required",
            "address.email" => "required|email",
        ]);

        $address = Address::create([
            "name" => $request->input('address.name'),
            "last_name" => $request->input('address.last_name'),
            "city" => $request->input('address.city'),
            "country" => $request->input('address.country'),
            "state" => $request->input('address.state'),
            "zip" => $request->input('address.zip'),
            "email" => $request->input('address.email'),
        ]);

        foreach($request->input('bookable') as $item)
        {
            $bookable = Bookable::where('slug',$item['slug'])->firstOrFail();

            $booking = $bookable->bookings()->create([
                "from" => $item['from'],
                "to" => $item['to'],
                "price" => $bookable->getPrice($item['from'],$item['to'])['total'],
                "address_id" => $address->id
            ]);
        }

        return response()->json([
            'date' => [
                'from'  => $booking->from,
                'to'    => $booking->to,
                'total' => $booking->price,
            ]
        ]);
    }
}
