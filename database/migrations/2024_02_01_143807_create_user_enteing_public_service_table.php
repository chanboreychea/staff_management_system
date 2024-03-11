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
        Schema::create('user_enteing_public_service', function (Blueprint $table) {
            $table->id();
            $table->string('constitution');//ក្របខណ្ខ
            $table->string('position');//មុខតំណែង
            $table->string('ministry');//ក្រសួង
            $table->string('office');//ការិយាល័យ
            $table->string('economy');//អង្គភាព
            $table->date('date')->nullable();
            $table->date('comfirm_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_enteing_public_service');
    }
};
