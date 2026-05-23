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
        Schema::create('screen_time_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('child_id')
                ->constrained('users')
                ->onDelete('cascade');

            // waktu mulai aplikasi digunakan
            $table->timestamp('start_time');

            // waktu aplikasi ditutup
            $table->timestamp('end_time')
                ->nullable();

            // total durasi pemakaian
            $table->integer('duration_minutes')
                ->default(0);

            // apakah parent sudah diberi notifikasi
            $table->boolean('notified_parent')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screen_time_logs');
    }
};