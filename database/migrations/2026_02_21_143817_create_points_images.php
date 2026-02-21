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
        Schema::create('points_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('create_user_id');
            $table->integer('points_id');
            $table->string('original_file_name');
            $table->string('file_size');
            $table->string('file_type');
            $table->string('path');

            $table->index('id');
            $table->index('points_id');
            $table->index('create_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_images');
    }
};
