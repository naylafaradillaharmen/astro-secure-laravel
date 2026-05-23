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
        Schema::create('screen_time_rules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('child_id')
                ->constrained('users')
                ->onDelete('cascade');

            // parent yang membuat aturan
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');

            // jam penggunaan
            $table->time('start_time');
            $table->time('end_time');

            // batas penggunaan dalam menit
            $table->integer('limit_minutes');

            // peringatan sebelum waktu habis
            $table->integer('warning_minutes')
                ->default(5);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screen_time_rules');
    }
};