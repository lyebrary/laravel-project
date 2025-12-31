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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->integer('capacity');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->timestamps();
        });

        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('suffix')->nullable();
            $table->string('student_number')->unique();
            $table->string('year_standing');
            $table->string('college');
            $table->string('degree_program');
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('surname');
            $table->string('middle_name');
            $table->string('suffix')->nullable();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('log_in');
            $table->dateTime('log_out')->nullable(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('operation_id')->constrained('operations')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendancelogs');
        Schema::dropIfExists('adminprofiles');
        Schema::dropIfExists('studentprofiles');
        Schema::dropIfExists('operations');
    }
};
