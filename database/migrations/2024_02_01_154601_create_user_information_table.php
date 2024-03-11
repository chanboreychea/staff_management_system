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
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->integer('using_user_id');
            $table->string('constitution',250)->nullable();//ក្របខណ្ខ
            $table->string('position_enteing_public_service',250)->nullable();//មុខតំណែង
            $table->string('ministry_enteing_public_service',250)->nullable();//ក្រសួង
            $table->string('office_enteing_public_service',250)->nullable();//ការិយាល័យ
            $table->string('economy_enteing_public_service',250)->nullable();//អង្គភាព
            $table->date('date_enteing_public_service')->nullable();
            $table->date('comfirm_date')->nullable();

            $table->string('constitution_misitry_rank',250)->nullable();
            $table->string('position_current_job_situation',250)->nullable();
            $table->string('economy_current_job_situation',250)->nullable();
            $table->date('constitution_amendment_date')->nullable();//កាលបរិច្ឆេទប្តូរក្រខណ្ខ ឋានន្តរស័ក្ត និងថ្នាក់ចុងក្រោយ
            $table->date('effective_date_of_last_promotion')->nullable();//កាលបរិច្ឆេទទទូលមុខតំណែងចុងក្រោយ

            $table->string('position_additional_position_on_current_job',250)->nullable();
            $table->string('economy_additional_position_on_current_job',250)->nullable();
            $table->string('document')->nullable();
            $table->string('equivalent',250)->nullable();//ឋានៈស្មើ
            $table->date('date_additional_position_on_current_job')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_information');
    }
};
