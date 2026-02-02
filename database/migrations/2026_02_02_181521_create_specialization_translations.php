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
        Schema::create('specialization_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialization_id')
                  ->constrained('specializations')
                  ->cascadeOnDelete();

            $table->string('locale', 5); // tr, en, de
            $table->string('title');
            $table->text('description')->nullable();

            $table->timestamps();

            // aynı uzmanlığa aynı dil 1 kez eklenebilir
            $table->unique(['specialization_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialization_translations');
    }
};
