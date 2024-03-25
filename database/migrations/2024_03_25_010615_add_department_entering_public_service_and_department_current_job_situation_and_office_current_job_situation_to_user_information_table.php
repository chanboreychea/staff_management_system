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
        Schema::table('user_information', function (Blueprint $table) {
            //
         
            $table->string('department_enteing_public_service', 255)->nullable(); //នាយកដ្ខាន
            $table->string('office_current_job_situation',255)->nullable();
            $table->string('department_current_job_situation', 255)->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_information', function (Blueprint $table) {
            if (Schema::hasColumn('user_information', 'department_enteing_public_service')) {
                $table->dropColumn('department_enteing_public_service');
            }
            if (Schema::hasColumn('user_information', 'office_current_job_situation')) {
                $table->dropColumn('office_current_job_situation');
            }
            if (Schema::hasColumn('user_information', 'department_current_job_situation')) {
                $table->dropColumn('department_current_job_situation');
            }
        });
    }
};
