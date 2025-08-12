<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('trips', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade');
        $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
        $table->dateTime('departure_time');
        $table->dateTime('arrival_time')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('trips');
}
};
