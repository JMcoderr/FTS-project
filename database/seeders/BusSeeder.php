<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Festival;
use App\Models\Bus;

class BusSeeder extends Seeder
{
    public function run(): void
    {
        $festivals = Festival::all();
        foreach ($festivals as $festival) {
            Bus::updateOrCreate([
                'festival_id' => $festival->id,
            ], [
                'festival_id' => $festival->id,
                'name' => 'Bus voor ' . $festival->name,
                'capacity' => rand(40, 80),
            ]);
        }
    }
}
