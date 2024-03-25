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
        // Add the roleId column again
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('roleId')->nullable()->constrained('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key constraint
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['roleId']);
        });

        // Drop the roleId column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roleId');
        });
    }
};
