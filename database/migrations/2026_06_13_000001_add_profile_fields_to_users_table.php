<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'child_name')) {
                $table->string('child_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'child_age')) {
                $table->unsignedTinyInteger('child_age')->nullable()->after('child_name');
            }
            if (!Schema::hasColumn('users', 'parent_name')) {
                $table->string('parent_name')->nullable()->after('child_age');
            }
            if (!Schema::hasColumn('users', 'parent_age')) {
                $table->unsignedTinyInteger('parent_age')->nullable()->after('parent_name');
            }
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable()->after('password');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'child_name',
                'child_age',
                'parent_name',
                'parent_age',
                'profile_image',
            ]);
        });
    }
};
