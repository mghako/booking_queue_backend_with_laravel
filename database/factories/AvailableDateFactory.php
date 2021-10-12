<?php

namespace Database\Factories;

use App\Models\AvailableDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvailableDateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AvailableDate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'available_date' => $this->faker->unique()->date(),
            'max_slots' => $this->faker->randomElement([10, 15, 20, 25, 30])
        ];
    }
}
