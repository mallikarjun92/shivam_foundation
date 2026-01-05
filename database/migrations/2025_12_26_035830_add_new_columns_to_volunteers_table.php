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
        Schema::table('volunteers', function (Blueprint $table) {
            //
            $table->string('country')->nullable()->after('zip_code');
            $table->string('occupation')->nullable()->after('country');
            $table->text('testimonial')->nullable()->after('occupation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {
            //
            $table->dropColumn(['country', 'occupation', 'testimonial']);
        });
    }
};
