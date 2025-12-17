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
        Schema::create('user_badges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('badge_code'); // early_bird, power_user, collector, etc
            $table->string('badge_name');
            $table->text('badge_description')->nullable();
            $table->string('badge_icon'); // emoji or icon class
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Prevent duplicates
            $table->unique(['user_id', 'badge_code']);

            // Indexes
            $table->index('user_id');
            $table->index('badge_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_badges');
    }
};
