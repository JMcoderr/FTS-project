<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
        $table->foreignId('trip_id')->constrained('trips')->onDelete('cascade');
        $table->integer('seats_booked');
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('bookings');
}
};
