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
        Schema::create('user_work_histories', function (Blueprint $table) {
            $table->id();
          
            //public_function_sector វិស័យមុខងារសាធារណៈ
            $table->integer('using_user_id');
            $table->string('public_function_sector_ministry')->nullable();
            $table->string('public_function_sector_economy')->nullable();
            $table->string('public_function_sector_position')->nullable();
            $table->string('public_function_sector_other')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // private_sector វិស័យឯកជន
            $table->string('private_sector_economy');
            $table->string('private_sector_position');
            $table->string('private_sector_tecnology');
            $table->date('private_sector_start_date');
            $table->date('private_sector_end_date');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_work_histories');
    }
};
