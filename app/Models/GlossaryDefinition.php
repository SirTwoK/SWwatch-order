<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class GlossaryDefinition extends Model
{
    protected $fillable = ['glossary_term_id', 'description', 'unlocks_at_order'];

    public function term(): BelongsTo
    {
        return $this->belongsTo(GlossaryTerm::class);
    }

    protected static function booted(): void
    {
        static::saved(fn() => Cache::forget('glossary_terms'));
        static::deleted(fn() => Cache::forget('glossary_terms'));
    }
}