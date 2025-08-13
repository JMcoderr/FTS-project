<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Festival;
use App\Services\BusService;

class AssignBusesToFestivals extends Command
{
    protected $signature = 'buses:assign';
    protected $description = 'Wijs automatisch bussen toe aan festivals op basis van aanmeldingen';

    public function handle()
    {
        $festivals = Festival::all();
        foreach ($festivals as $festival) {
            BusService::assignBuses($festival);
            $this->info("Bussen toegewezen voor festival: {$festival->name}");
        }

        $this->info('Alle festivals verwerkt!');
    }
}
