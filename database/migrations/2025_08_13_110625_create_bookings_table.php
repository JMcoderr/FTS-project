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
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // verwijst naar users/customers
            $table->foreignId('festival_id')->constrained()->onDelete('cascade'); // verwijst naar festivals
            $table->unsignedInteger('seats')->default(1);
            $table->string('status')->default('pending');
            $table->decimal('total_price', 10, 2)->nullable();
            $table->timestamp('booked_at')->useCurrent();
            $table->unsignedInteger('points_awarded')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
