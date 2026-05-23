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
        Schema::create('reward_responses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reward_id')
                ->constrained('reward_requests')
                ->onDelete('cascade');

            // parent yang memberi respon
            $table->foreignId('parent_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->text('response_text');

            $table->enum('status', [
                'approved',
                'rejected'
            ]);

            $table->timestamp('responded_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_responses');
    }
};