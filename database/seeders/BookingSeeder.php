<?php

namespace Database\Seeders;

use App\Models\Bookable;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookable::all()->each( function (Bookable $bookable){
            $booking = Booking::factory()->make();
            $bookings = [$booking];

            for ($i = 1 ; $i <= 4 ; $i++)
            {
                $from = Carbon::create($booking->to)->addDays(random_int(1,7))->toDateString();
                $to   = Carbon::create($from)->addDays(random_int(0,15))->toDateString();

                $booking = Booking::factory()->make([
                    'from' => $from,
                    'to' => $to ,
                    'price' => $bookable->getPrice($from,$to)['total'],
                ]);

                $bookings[] = $booking;
            }

            $bookable->bookings()->saveMany($bookings);
        });
    }
}
