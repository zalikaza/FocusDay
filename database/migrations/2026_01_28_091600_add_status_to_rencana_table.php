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
        if (!Schema::hasTable('rencana')) {
            return;
        }

        if (Schema::hasColumn('rencana', 'status')) {
            return;
        }

        Schema::table('rencana', function (Blueprint $table) {
            $table->string('status')->nullable()->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('rencana')) {
            return;
        }

        if (!Schema::hasColumn('rencana', 'status')) {
            return;
        }

        Schema::table('rencana', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
