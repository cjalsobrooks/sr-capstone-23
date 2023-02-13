<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ShirtSize;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Volunteer>
 */
class VolunteerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'user_id' => User::all()->random()->id,
            'first_name' => fake()->firstname(),
            'last_name' => fake()->lastname(),
            'shirt_size' => ShirtSize::randomSize(),
            'age' => rand(15, 70),
            'waiver_signed_by' => fake()->name(),
            'comment' => fake()->realText()
        ];
    }
}
