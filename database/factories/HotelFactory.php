<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->sentence(),
            'created_at' => fake()->dateTimeBetween('-20 days', '-10 days'),
            'updated_at' => fake()->dateTimeBetween('-5 days', '-1 days')
        ];
    }
}
