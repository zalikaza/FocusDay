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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'theme')) {
                $table->string('theme')->default('light');
            }

            if (!Schema::hasColumn('users', 'week_start')) {
                $table->unsignedTinyInteger('week_start')->default(1);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'theme')) {
                $table->dropColumn('theme');
            }

            if (Schema::hasColumn('users', 'week_start')) {
                $table->dropColumn('week_start');
            }
        });
    }
};
