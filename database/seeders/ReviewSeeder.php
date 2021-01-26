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
            $count = $bookable->bookings()->count();
            $bookable->bookings->random(intval($count/2))
                ->map( function (Booking $booking) use ($bookable) {
                $review = Review::factory()->make([
                    'bookable_id' => $bookable->id,
                    'id' => $booking->review_key,
                ]);
                $booking->review_key = null;
                $booking->save();
                $booking->review()->save($review);
            });
        });
    }
}
