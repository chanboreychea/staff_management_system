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
        Schema::create('user_families', function (Blueprint $table) {
            $table->id();

            // Information of father and mother
            $table->integer('using_user_id');
            $table->text('father_name')->nullable();
            $table->text('father_name_in_english')->nullable();
            $table->text('father_status')->nullable();
            $table->text('father_job')->nullable();
            $table->text('father_national')->nullable();
            $table->text('f_current_residence')->nullable();
            $table->text('f_institute')->nullable();
            $table->text('f_address')->nullable();
            $table->date('father_date')->nullable();

            $table->text('mother_name')->nullable();
            $table->text('mother_name_in_english')->nullable();
            $table->text('mother_status')->nullable();
            $table->text('mother_job')->nullable();
            $table->text('mother_national')->nullable();
            $table->text('m_current_residence')->nullable();
            $table->text('m_institute')->nullable();
            $table->text('m_address')->nullable();

            $table->date('mother_date')->nullable();

            // information of federation សហព័ន្ធ

            $table->text('federation_name')->nullable();
            $table->text('federation_name_in_english')->nullable();
            $table->text('federation_status')->nullable();
            $table->text('federation_job')->nullable();
            $table->text('federation_national')->nullable();
            $table->text('federation_current_residence')->nullable();
            $table->text('federation_institute')->nullable();
            $table->text('federation_allowance')->nullable();
            $table->text('federation_phone_number')->nullable();
            $table->date('federation_date')->nullable();

              // array
            //information of relative
              $table->text('relative_name')->nullable();
              $table->text('relative_name_in_english')->nullable();
              $table->text('relative_gender')->nullable();
              $table->text('relative_job')->nullable();
              $table->text('relative_date')->nullable();


            // array
            //information of children
            $table->text('children_name')->nullable();
            $table->text('children_name_in_english')->nullable();
            $table->text('children_gender')->nullable();
            $table->text('children_job')->nullable();
            $table->text('children_allowance')->nullable();
            $table->text('children_date')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_families');
    }
};
