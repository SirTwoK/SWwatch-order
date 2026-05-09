<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class GlossaryTerm extends Model
{
    protected $fillable = ['name', 'slug'];

    public function definitions(): HasMany
    {
        return $this->hasMany(GlossaryDefinition::class);
    }

    protected static function booted(): void
    {
        static::saved(fn() => Cache::forget('glossary_terms'));
        static::deleted(fn() => Cache::forget('glossary_terms'));
    }
}