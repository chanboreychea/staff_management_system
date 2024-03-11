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
        Schema::create('user_language_skills', function (Blueprint $table) {
            $table->id();
            $table->integer('using_user_id');
            $table->string('language')->nullable();
            $table->string('read')->nullable();
            $table->string('write')->nullable();
            $table->string('speak')->nullable();
            $table->string('listen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_language_skills');
    }
};
