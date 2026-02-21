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
        Schema::create('master_points', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('create_user_id');
            $table->integer('master_id');
            $table->integer('job_id');
            $table->integer('point');
            $table->string('comments');

            $table->index('id');
            $table->index('master_id');
            $table->index('job_id');
            $table->index('create_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_points');
    }
};
