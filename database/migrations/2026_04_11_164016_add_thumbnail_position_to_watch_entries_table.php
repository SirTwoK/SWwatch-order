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
            $table->string('thumbnail_position')->default('center')->after('thumbnail_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('watch_entries', 'thumbnail_position')) {
            Schema::table('watch_entries', function (Blueprint $table) {
                $table->dropColumn('thumbnail_position');
            });
        }
    }
};
