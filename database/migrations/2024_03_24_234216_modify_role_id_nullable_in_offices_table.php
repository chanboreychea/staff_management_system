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
        Schema::table('offices', function (Blueprint $table) {
         // Add the departmentId column with nullable foreign key constraint
         $table->foreignId('departmentId')->nullable()->constrained('departments')->onDelete('cascade');
      });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offices', function (Blueprint $table) {
             // Drop the foreign key constraint
             $table->dropForeign(['departmentId']);
            
             // Drop the departmentId column
             $table->dropColumn('departmentId');
        });
    }
};
