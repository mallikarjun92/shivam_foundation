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
        Schema::create('programs_enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('payment_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('payment_currency')->nullable();
            $table->string('remarks')->nullable();
            $table->string('program_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs_enrollments');
    }
};
