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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roleId')->constrained('roles')->onDelete('cascade');
            $table->foreignId('departmentId')->nullable()->constrained('departments');
            $table->foreignId('officeId')->nullable()->constrained('offices');
            $table->string('firstNameKh', 100);
            $table->string('lastNameKh', 100);
            $table->string('gender', 2);
            $table->string('phoneNumber', 20)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('idCard', 100)->unique();
            $table->string('status', 100);
            $table->string('nationality', 100);
            $table->date('dateOfBirth', 100);
            $table->string('pobAddress', 255);
            $table->string('currentAddress', 255);
            $table->string('image', 255)->nullable();
            $table->string('active', 2)->default(1);
            $table->timestamps();
            // Specify the storage engine as InnoDB
            // $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
