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
        Schema::create('game_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_package_id');
            $table->tinyInteger('rating')->default(5); // 1-5 stars
            $table->text('review')->nullable();
            $table->integer('helpful_count')->default(0); // Helpful votes
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_package_id')->references('id')->on('game_packages')->onDelete('cascade');

            // Indexes
            $table->index('user_id');
            $table->index('game_package_id');
            $table->index('rating');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_reviews');
    }
};
