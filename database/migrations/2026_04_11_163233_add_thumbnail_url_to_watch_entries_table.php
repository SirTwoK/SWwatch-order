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
        Schema::table('watch_entries', function (Blueprint $table) {
            $table->string('thumbnail_url')->nullable()->after('thumbnail_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('watch_entries', function (Blueprint $table) {
            if (Schema::hasColumn('watch_entries', 'thumbnail_url')) {
                $table->dropColumn('thumbnail_url');
            }
        });
    }
};
