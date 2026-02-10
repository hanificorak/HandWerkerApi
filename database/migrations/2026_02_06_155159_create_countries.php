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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
        
            // Temel bilgiler
            $table->string('name');                // Turkey
        
            // Telefon / para
            $table->string('phone_code', 10)->nullable(); // +90
            $table->string('currency', 10)->nullable();   // TRY
            $table->string('currency_symbol', 5)->nullable(); // ₺
        
            // Bayrak & lokalizasyon
            $table->string('flag')->nullable();    // tr.svg veya URL
            $table->string('locale', 10)->nullable(); // tr_TR
        
            // Sistemsel alanlar
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
