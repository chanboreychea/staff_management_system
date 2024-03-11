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
        Schema::create('user_additional_position_on_current_job', function (Blueprint $table) {
            $table->id();
            $table->string('using_user_id')->nullable();
            $table->string('position','255')->nullable();
            $table->string('economy','255')->nullable();
            $table->string('document')->nullable();
            $table->string('equivalent','255')->nullable();//ឋានៈស្មើ
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_additional_position_on_current_job');
    }
};
