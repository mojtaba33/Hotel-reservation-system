<?php

namespace Database\Factories;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $from = Carbon::parse($this->faker->dateTimeBetween('-1 week', '+1 week'))->toDateString();
        $to = Carbon::create($from)->addDays(random_int(0,15))->toDateString();

        return [
            'from' =>  $from,
            'to'   =>  $to,
            'price' => random_int(200,5000),
            'address_id' => Address::factory()->create()->id,
        ];
    }
}
