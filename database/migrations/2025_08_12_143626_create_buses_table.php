<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('buses', function (Blueprint $table) {
        $table->id();
        $table->string('bus_number')->unique();
        $table->integer('seating_capacity');
        $table->string('driver_name');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('buses');
}
};
