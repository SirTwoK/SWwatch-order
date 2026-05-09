<?php

namespace App\Helpers;

use App\Models\GlossaryDefinition;
use App\Models\GlossaryTerm;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GlossaryParser
{
    public static function parse(string $text, int $currentOrder): string
    {
        // Load all terms once and cache them
        $terms = GlossaryTerm::with('definitions')->get()->keyBy('slug');

        return preg_replace_callback('/\[\[([a-z0-9-]+)\]\]/', function ($matches) use ($terms, $currentOrder) {
        
    
            $slug = $matches[1];
        

            if (!isset($terms[$slug])) {
                return $matches[0];
            }

            $term = $terms[$slug];
            $definitions = $term->definitions;
            

            $definition = $definitions
                ->where('unlocks_at_order', '<=', $currentOrder)
                ->sortByDesc('unlocks_at_order')
                ->first();

            if (!$definition) {
                $definition = $definitions->sortBy('unlocks_at_order')->first();
            }

            $name = e($term->name);
            $desc = e($definition->description);

            return '<span x-data=\'{ open: false }\' @mouseenter="open = true" @mouseleave="open = false" class="relative inline-block">' .
    '<span @click.stop="open = !open" class="text-[#c9a227] border-b border-dashed border-[#c9a227] cursor-pointer">' .
    $name .
    '</span>' .
    '<span x-show="open" x-transition @click.outside="open = false" ' .
    'style="background: rgba(10,12,18,0.98); width: 280px; position: absolute; bottom: 100%; left: 0; margin-bottom: 8px; z-index: 50; border-radius: 6px; border: 1px solid #2a3545; padding: 12px; font-size: 12px; color: #9aaabb; line-height: 1.6;">' .
    '<span style="display: block; color: #f0ece0; font-weight: 600; margin-bottom: 4px;">' . $name . '</span>' .
    $desc .
    '</span>' .
    '</span>';

        }, $text);
    }
}