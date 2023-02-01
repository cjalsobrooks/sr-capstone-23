<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->companySuffix(),
            'description' => fake()->sentence(),
            'created_at' => fake()->dateTimeBetween('-10 days', '-5 days'),
            'updated_at' => fake()->dateTimeBetween('-3 days', '-1 hour')
        ];
    }
}
