<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g. PROMO2024
            $table->text('description')->nullable();
            $table->enum('type', ['percentage', 'fixed']); // Diskon tipe persentase atau fixed amount
            $table->decimal('discount_value', 8, 2); // Jumlah/persentase diskon
            $table->decimal('max_discount', 8, 2)->nullable(); // Max diskon yang bisa didapat (untuk percentage)
            $table->integer('max_usage')->nullable(); // Berapa kali bisa dipakai
            $table->integer('usage_count')->default(0); // Sudah dipakai berapa kali
            $table->integer('max_usage_per_user')->default(1); // Max pakai per user
            $table->dateTime('valid_from');
            $table->dateTime('valid_until');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('promo_code_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('promo_code_id')->constrained('promo_codes')->onDelete('cascade');
            $table->foreignId('transaction_id')->nullable()->constrained('game_transactions')->onDelete('cascade');
            $table->decimal('discount_amount', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promo_code_usages');
        Schema::dropIfExists('promo_codes');
    }
};
