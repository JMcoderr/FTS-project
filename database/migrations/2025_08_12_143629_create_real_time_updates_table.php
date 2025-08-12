<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('real_time_updates', function (Blueprint $table) {
        $table->id();
        $table->foreignId('trip_id')->constrained('trips')->onDelete('cascade');
        $table->text('update_message');
        $table->timestamp('update_time')->useCurrent();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('real_time_updates');
}
};
