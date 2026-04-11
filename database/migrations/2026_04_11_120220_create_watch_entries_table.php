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
    Schema::create('watch_entries', function (Blueprint $table) {
        $table->id();
        $table->integer('order')->unique();
        $table->string('title');
        $table->string('type');          // "film" | "series"
        $table->string('series_name')->nullable();
        $table->integer('season')->nullable();
        $table->integer('episode')->nullable();
        $table->string('era');            // slug, e.g. "clone-wars"
        $table->string('era_label');      // human label
        $table->string('timeline');       // e.g. "32 BBY"
        $table->integer('duration_minutes');
        $table->string('recommendation'); // "must"|"recommended"|"skip"
        $table->string('thumbnail_color')->default('#1a2030');
        $table->text('synopsis')->nullable();
        $table->boolean('watched')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watch_entries');
    }
};
