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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            // anak yang menjalankan task
            $table->foreignId('child_id')
                ->constrained('users')
                ->onDelete('cascade');

            // parent yang membuat task
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();

            $table->time('start_time');
            $table->time('end_time');

            $table->enum('repeat_type', [
                'daily',
                'weekly'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};