<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Festival;

class FestivalSeeder extends Seeder
{
    public function run(): void
    {
        $festivals = [
            [
                'name' => 'Awakenings Festival',
                'date' => '2025-06-28',
                'location' => 'Spaarnwoude, NL',
                'price' => 79.00,
                'max_capacity' => 25000,
                'description' => 'Techno festival met internationale line-up en stages.'
            ],
            [
                'name' => 'Thunderdome',
                'date' => '2025-10-18',
                'location' => 'Jaarbeurs Utrecht, NL',
                'price' => 65.00,
                'max_capacity' => 18000,
                'description' => 'Early hardcore, gabber en classics. Het legendarische Thunderdome!'
            ],
            [
                'name' => 'Defqon.1',
                'date' => '2025-06-20',
                'location' => 'Biddinghuizen, NL',
                'price' => 89.00,
                'max_capacity' => 60000,
                'description' => 'Hardstyle, early hardcore, raw en classics op het grootste outdoor festival.'
            ],
            [
                'name' => 'Verknipt Festival',
                'date' => '2025-07-12',
                'location' => 'Utrecht, NL',
                'price' => 55.00,
                'max_capacity' => 12000,
                'description' => 'Techno, house en acid. Verknipt staat bekend om de rauwe sfeer.'
            ],
            [
                'name' => 'Dominator',
                'date' => '2025-07-19',
                'location' => 'Eersel, NL',
                'price' => 72.50,
                'max_capacity' => 25000,
                'description' => 'Early hardcore, industrial, uptempo en terror. Het hardste festival van Nederland.'
            ],
            [
                'name' => 'Mysteryland',
                'date' => '2025-08-23',
                'location' => 'Haarlemmermeer, NL',
                'price' => 82.00,
                'max_capacity' => 35000,
                'description' => 'Techno, house, trance en meer op het oudste dancefestival van Nederland.'
            ],
            [
                'name' => 'Qlimax',
                'date' => '2025-11-22',
                'location' => 'Gelredome Arnhem, NL',
                'price' => 69.00,
                'max_capacity' => 27000,
                'description' => 'Hardstyle, early hardcore en een spectaculaire show in het Gelredome.'
            ],
            [
                'name' => 'Decibel Outdoor',
                'date' => '2025-08-16',
                'location' => 'Hilvarenbeek, NL',
                'price' => 75.00,
                'max_capacity' => 40000,
                'description' => 'Hardcore, hardstyle, freestyle en classics op een enorm outdoor terrein.'
            ],
            [
                'name' => 'Free Your Mind',
                'date' => '2025-06-07',
                'location' => 'Stadsblokken Arnhem, NL',
                'price' => 49.00,
                'max_capacity' => 8000,
                'description' => 'Techno, house en progressive in een unieke outdoor setting.'
            ],
            [
                'name' => 'Time Warp NL',
                'date' => '2025-11-08',
                'location' => 'Amsterdam, NL',
                'price' => 68.00,
                'max_capacity' => 15000,
                'description' => 'Techno, minimal en house op het iconische Time Warp event.'
            ],
            [
                'name' => 'Harmony of Hardcore',
                'date' => '2025-05-31',
                'location' => 'Erp, NL',
                'price' => 59.00,
                'max_capacity' => 20000,
                'description' => 'Early hardcore, millennium, uptempo en freestyle op een outdoor festival.'
            ],
            [
                'name' => 'Soenda Festival',
                'date' => '2025-05-17',
                'location' => 'Utrecht, NL',
                'price' => 52.00,
                'max_capacity' => 10000,
                'description' => 'Techno, house en electronica in een industriële setting.'
            ],
            [
                'name' => 'Awakenings Festival',
                'date' => '2025-06-28',
                'location' => 'Spaarnwoude, NL',
                'price' => 79.00,
                'max_capacity' => 25000,
                'description' => 'Techno festival met internationale line-up en stages.'
            ],
            [
                'name' => 'Thunderdome',
                'date' => '2025-10-18',
                'location' => 'Jaarbeurs Utrecht, NL',
                'price' => 65.00,
                'max_capacity' => 18000,
                'description' => 'Early hardcore, gabber en classics. Het legendarische Thunderdome!'
            ],
            [
                'name' => 'Defqon.1',
                'date' => '2025-06-20',
                'location' => 'Biddinghuizen, NL',
                'price' => 89.00,
                'max_capacity' => 60000,
                'description' => 'Hardstyle, early hardcore, raw en classics op het grootste outdoor festival.'
            ],
            [
                'name' => 'Verknipt Festival',
                'date' => '2025-07-12',
                'location' => 'Utrecht, NL',
                'price' => 55.00,
                'max_capacity' => 12000,
                'description' => 'Techno, house en acid. Verknipt staat bekend om de rauwe sfeer.'
            ],
            [
                'name' => 'Dominator',
                'date' => '2025-07-19',
                'location' => 'Eersel, NL',
                'price' => 72.50,
                'max_capacity' => 25000,
                'description' => 'Early hardcore, industrial, uptempo en terror. Het hardste festival van Nederland.'
            ],
        ];

        foreach ($festivals as $festival) {
            $festivalModel = Festival::updateOrCreate([
                'name' => $festival['name'],
                'date' => $festival['date'],
            ], $festival);
            // Koppel een bus aan elk festival
            \App\Models\Bus::updateOrCreate([
                'festival_id' => $festivalModel->id,
            ], [
                'festival_id' => $festivalModel->id,
                'name' => 'Bus voor ' . $festivalModel->name,
                'capacity' => rand(40, 80),
            ]);
        }
    }
}
