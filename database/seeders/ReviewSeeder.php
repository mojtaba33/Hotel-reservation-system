<?php

namespace Database\Seeders;

use App\Models\Bookable;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookable::all()->each( function (Bookable $bookable){
            $bookable->bookings()->each( function (Booking $booking) use ($bookable) {
                $review = Review::factory()->make([
                    'bookable_id' => $bookable->id
                ]);
                $booking->review()->save($review);
            });
        });
    }
}
