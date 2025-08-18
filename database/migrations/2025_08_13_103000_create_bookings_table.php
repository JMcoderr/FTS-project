<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('festival_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->unsignedInteger('seats')->default(1);
            $table->string('status')->default('pending');
            $table->string('seat_numbers')->nullable();
            $table->string('seat_type')->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->timestamp('booked_at')->useCurrent();
            $table->unsignedInteger('points_awarded')->default(0);
            $table->timestamps();
            $table->foreign('bus_id')->references('id')->on('buses')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
