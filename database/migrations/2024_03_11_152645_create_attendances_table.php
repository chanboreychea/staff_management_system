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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('date');
            $table->string('leave')->nullable();
            $table->string('checkIn')->nullable();
            $table->string('lateIn')->nullable();
            $table->string('checkOut')->nullable();
            $table->string('lateOut')->nullable();
            $table->string('total')->nullable();
            $table->string('mission')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
