<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('festivals', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('location');
        $table->date('start_date');
        $table->date('end_date');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('festivals');
}
};
