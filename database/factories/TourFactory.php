<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'travel_id' => Travel::inRandomOrder()->first()->id,
            'name' => fake()->text(20),
            'starting_date' => fake()->date,
            'ending_date' => fake()->date,
            'price' => rand(1000, 10000000),
        ];
    }
}
