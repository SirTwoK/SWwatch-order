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
        Schema::create('user_watch_states', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('watch_entry_id')->constrained()->cascadeOnDelete();
        
            $table->boolean('watched')->default(false);
        
            $table->timestamps();
        
            $table->unique(['user_id', 'watch_entry_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_watch_states');
    }
};
