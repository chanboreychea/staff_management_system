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
        Schema::create('user_working_histroy_private_sectors', function (Blueprint $table) {
            $table->id();
            $table->integer('using_user_id');
            $table->string('economy')->nullable();
            $table->string('position')->nullable();
            $table->string('tecnology')->nullable();
            $table->string('other')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_working_histroy_private_sectors');
    }
};
