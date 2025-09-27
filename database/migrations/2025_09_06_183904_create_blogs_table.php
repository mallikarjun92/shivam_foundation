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
        // Schema::create('blogs', function (Blueprint $table) {
        //     // $table->id();
        //     // $table->timestamps();
        //      Schema::create('blogs', function (Blueprint $table) {
        //         $table->id();
        //         $table->string('title');
        //         $table->string('slug')->unique();
        //         $table->text('excerpt')->nullable();
        //         $table->longText('content');
        //         $table->string('author')->nullable();
        //         $table->string('category')->nullable();
        //         $table->string('tags')->nullable();
        //         $table->string('featured_image')->nullable();
        //         $table->boolean('published')->default(false);
        //         $table->timestamp('published_at')->nullable();
        //         $table->foreignId('user_id')->constrained()->onDelete('cascade');
        //         $table->timestamps();
        //     });
        // });
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('author')->nullable();
            $table->string('category')->nullable();
            $table->string('tags')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('blogs');
        Schema::dropIfExists('blogs');
    }
};
