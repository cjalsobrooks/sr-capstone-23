<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;
use DateTime;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shift>
 */
class ShiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randDay = rand(2,5);
        $randHour  = rand(1,12);
        $time = "2023-06-{$randDay} {$randHour}:00";
        $randomInterval = "+" . rand(1,3) . " " . 'hours';

        return [
            'location_id' => Location::all()->random()->id,
            'name' => fake()->cityPrefix(),
            'description' => fake()->text(),
            'start_time' => date("Y-m-d H:i", strtotime($time)),
            'end_time' => date("Y-m-d H:i", strtotime($randomInterval, strtotime($time))),
            'max_volunteers' => 10,
            'current_volunteers' => 0,
            'is_accepting' => true
        ];
    }
}
