<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('routes', function (Blueprint $table) {
        $table->id();
        $table->string('route_name');
        $table->string('start_location');
        $table->string('end_location');
        $table->integer('distance_km');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('routes');
}
};
