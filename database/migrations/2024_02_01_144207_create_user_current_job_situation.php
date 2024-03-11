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
        Schema::create('user_current_job_situation', function (Blueprint $table) {
            $table->id();
            $table->string('constitution_misitry_rank');
            $table->string('position');
            $table->string('economy');
            $table->date('constitution_amendment_date')->nullable();//កាលបរិច្ឆេទប្តូរក្រខណ្ខ ឋានន្តរស័ក្ត និងថ្នាក់ចុងក្រោយ
            $table->date('effective_date_of_last_promotion')->nullable();//កាលបរិច្ឆេទទទូលមុខតំណែងចុងក្រោយ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_current_job_situation');
    }
};
