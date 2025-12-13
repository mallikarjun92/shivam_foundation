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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('children_served')->default(0);
            $table->integer('volunteers')->default(0);
            $table->integer('meals_distributed')->default(0);
            $table->integer('countries_active')->default(0);
            $table->json('country_list')->nullable(); // ["India","Nepal","Kenya"]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
