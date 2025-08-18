<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

    // Zorg dat admin account altijd bestaat en niet opnieuw wordt aangemaakt
    $this->call([\Database\Seeders\AdminUserSeeder::class, \Database\Seeders\FestivalSeeder::class, \Database\Seeders\BusSeeder::class]);
    }
}
