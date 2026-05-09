<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        // Find the first Tales of the Underworld entry in Empire Era
        $firstUnderworld = DB::table('watch_entries')
            ->where('series_name', 'Tales of the Underworld')
            ->where('era', 'empire')
            ->orderBy('order')
            ->first();

        if (!$firstUnderworld) {
            throw new \Exception('Could not find Tales of the Underworld in Empire Era');
        }

        $insertAt = $firstUnderworld->order;

        // Shift everything from that order onwards up by 10
        DB::table('watch_entries')
            ->where('order', '>=', $insertAt)
            ->orderByDesc('order')
            ->get()
            ->each(function ($entry) {
                DB::table('watch_entries')
                    ->where('id', $entry->id)
                    ->update(['order' => $entry->order + 10]);
            });

        // Insert Maul episodes
        $episodes = [
            [1,  'The Dark Revenge'],
            [2,  'Sinister Schemes'],
            [3,  'Whispers in the Unknown'],
            [4,  'Pride and Vengeance'],
            [5,  'Inquisition'],
            [6,  'Night of the Hunted'],
            [7,  'Call to Oblivion'],
            [8,  'The Creeping Fear'],
            [9,  'Strange Allies'],
            [10, 'The Dark Lord'],
        ];

        foreach ($episodes as [$ep, $title]) {
            DB::table('watch_entries')->insert([
                'order'              => $insertAt + $ep - 1,
                'title'              => $title,
                'type'               => 'series',
                'series_name'        => 'Maul: Shadow Lord',
                'season'             => 1,
                'episode'            => $ep,
                'era'                => 'empire',
                'era_label'          => 'Empire Era',
                'timeline'           => '18 BBY',
                'duration_minutes'   => 30,
                'recommendation'     => 'must',
                'thumbnail_color'    => '#1a0a0a',
                'thumbnail_url'      => null,
                'thumbnail_position' => 'center',
                'synopsis'           => null,
                'before_watch'       => null,
                'after_watch'        => null,
                'watched'            => false,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Find and delete Maul episodes
        $maul = DB::table('watch_entries')
            ->where('series_name', 'Maul: Shadow Lord')
            ->orderBy('order')
            ->get();

        if ($maul->isEmpty()) return;

        $firstOrder = $maul->first()->order;

        DB::table('watch_entries')
            ->where('series_name', 'Maul: Shadow Lord')
            ->delete();

        // Shift everything after back down
        DB::table('watch_entries')
            ->where('order', '>', $firstOrder)
            ->orderBy('order')
            ->get()
            ->each(function ($entry) {
                DB::table('watch_entries')
                    ->where('id', $entry->id)
                    ->update(['order' => $entry->order - 10]);
            });
    }
};
