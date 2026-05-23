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
        Schema::create('child_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('child_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->integer('level')
                ->default(1);

            $table->integer('streak_days')
                ->default(0);

            $table->integer('total_completed_tasks')
                ->default(0);

            $table->date('last_activity_date')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_progress');
    }
};