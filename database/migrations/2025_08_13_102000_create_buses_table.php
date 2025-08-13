<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name'); // b.v. "Bus A"
            $table->foreignId('festival_id')->constrained()->cascadeOnDelete(); // koppeling festival
            $table->integer('capacity')->default(40); // max aantal plaatsen
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
