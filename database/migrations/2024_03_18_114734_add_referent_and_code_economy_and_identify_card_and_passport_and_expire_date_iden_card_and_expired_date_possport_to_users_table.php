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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('referent', 255)->nullable();
            $table->string('engName', 255)->nullable();
            $table->string('codeEconomy', 100)->nullable();
            $table->string('passport', 255)->nullable(); // Corrected length to match the up method
            $table->string('identifyCard', 255)->nullable(); // Corrected length to match the up method
            $table->date('exprireDateIdenCard')->nullable();
            $table->date('exprirePassport')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'referent')) {
                $table->dropColumn('referent');
            }
            if (Schema::hasColumn('users', 'codeEconomy')) {
                $table->dropColumn('codeEconomy');
            }
            if (Schema::hasColumn('users', 'passport')) {
                $table->dropColumn('passport');
            }
            if (Schema::hasColumn('users', 'identifyCard')) {
                $table->dropColumn('identifyCard');
            }
            if (Schema::hasColumn('users', 'exprireDateIdenCard')) {
                $table->dropColumn('exprireDateIdenCard');
            }
            if (Schema::hasColumn('users', 'exprirePassport')) {
                $table->dropColumn('exprirePassport');
            }
            if (Schema::hasColumn('users', 'engName')) {
                $table->dropColumn('engName');
            }
        });
    }
};
