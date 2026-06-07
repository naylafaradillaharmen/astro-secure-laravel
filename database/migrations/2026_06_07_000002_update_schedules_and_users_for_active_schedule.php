<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update tabel schedules
        Schema::table('schedules', function (Blueprint $table) {
            // Rename primary key id -> schedule_id agar serasi dengan model & response
            if (Schema::hasColumn('schedules', 'id') && !Schema::hasColumn('schedules', 'schedule_id')) {
                $table->renameColumn('id', 'schedule_id');
            }
            
            // Tambahkan kolom type (santai, produktif, aktif)
            if (!Schema::hasColumn('schedules', 'type')) {
                $table->string('type')->default('santai')->after('user_id');
            }

            // Tambahkan kolom activity_order untuk mengunci urutan kartu
            if (!Schema::hasColumn('schedules', 'activity_order')) {
                $table->unsignedTinyInteger('activity_order')->default(1)->after('type');
            }
        });

        // 2. Update tabel users (untuk menyimpan tipe jadwal yang sedang aktif)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'active_schedule_type')) {
                $table->string('active_schedule_type')->default('santai')->after('pin_parent');
            }
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            if (Schema::hasColumn('schedules', 'schedule_id') && !Schema::hasColumn('schedules', 'id')) {
                $table->renameColumn('schedule_id', 'id');
            }
            $table->dropColumn(['type', 'activity_order']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('active_schedule_type');
        });
    }
};
