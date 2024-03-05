<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bookingId')->constrained('booking')->onDelete('cascade');
            $table->string('room', 2);
            $table->string('time', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_times');
    }
};
