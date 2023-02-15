<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Section;
use App\Models\Location;
use App\Models\Shift;
use App\Models\Roster;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        // Volunteer::factory(8)->create();
        // Section::factory(3)->create();
        // Location::factory(3)->create();
        // Shift::factory(10)->create();
        // Roster::factory(10)->create();
    }
}
