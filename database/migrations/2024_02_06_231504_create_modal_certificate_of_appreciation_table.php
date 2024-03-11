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
        Schema::create('modal_certificate_of_appreciation', function (Blueprint $table) {
            $table->id();
            
            $table->string('document')->nullable();
            $table->boolean('status')->default(0);
            $table->string('economy')->nullable();
            $table->string('type')->nullable();
            $table->text('decription')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modal_certificate_of_appreciation');
    }
};
