<?php
namespace App\Livewire;

use App\Models\WatchEntry;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\UserWatchState;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;


class WatchList extends Component
{
    public string $filterEra           = 'all';
    #[\Livewire\Attributes\Url]
    public array $filterRecommendation = [];
    
    #[\Livewire\Attributes\Url]
    public bool $hideWatched = false;
    public ?int   $expandedId  = null;


    public bool $showGreatnessWarning = false;

    // select as watched button
    public function toggleWatched(int $id): void
    {
        $userId = Auth::id();

        // Only check greatness when marking AS watched (not unwatching)
        $entry = WatchEntry::findOrFail($id);
        $currentlyWatched = UserWatchState::where('user_id', $userId)
            ->where('watch_entry_id', $id)
            ->value('watched');

        if (!$currentlyWatched && !in_array($entry->order, [141, 142, 143, 144])) {
            $greatestOrders = [141, 142, 143, 144];
            $greatnessAllWatched = WatchEntry::whereIn('order', $greatestOrders)
                ->get()
                ->every(function ($e) use ($userId) {
                    return UserWatchState::where('user_id', $userId)
                        ->where('watch_entry_id', $e->id)
                        ->value('watched');
                });

            if (!$greatnessAllWatched && $entry->order > 141) {
                $this->showGreatnessWarning = true;
                return;
            }
        }

        $this->showGreatnessWarning = false;

        $state = UserWatchState::firstOrNew([
            'user_id' => $userId,
            'watch_entry_id' => $id,
        ]);

        $state->watched = !$state->watched;
        $state->save();
    }

    // function for filtering the entries
    public function toggleFilter(string $value): void
    {
        if (in_array($value, $this->filterRecommendation)) 
        {
            $this->filterRecommendation = array_values(
                array_filter($this->filterRecommendation, fn($v) => $v !== $value)
            );
        } 
        else 
        {
            $this->filterRecommendation[] = $value;
        }
    }

    // helper functions for greatness
    public function dismissGreatness(): void
    {
        $this->showGreatnessWarning = false;
    }

    public function toggleExpanded(int $id): void
    {
        $this->expandedId = ($this->expandedId === $id) ? null : $id;
    }

    // reset progress button
    public function resetProgress(): void
    {
        
        DB::table('user_watch_states')
            ->where('user_id', (int) Auth::id())
            ->update(['watched' => false]);
    }

    
    // getting all the entries logic
    public function entries()
    {
        $userId = Auth::id();

        $raw = WatchEntry::ordered()
            ->leftJoin('user_watch_states as uws', function ($join) use ($userId) {
                $join->on('watch_entries.id', '=', 'uws.watch_entry_id')
                    ->where('uws.user_id', $userId);
            })
            ->when(count($this->filterRecommendation) > 0,
                fn($q) => $q->whereIn('recommendation', $this->filterRecommendation))
            ->select('watch_entries.*', 'uws.watched as user_watched')
            ->get()
            ->map(function ($entry) {
                $entry->watched = (bool) $entry->user_watched;
                return $entry;
            });
            

        // Build consecutive series groups
        $grouped = [];
        $prev = null;

        foreach ($raw as $entry) {
            $isSeries = $entry->type === 'series';
            $sameRun  = $prev
                && $isSeries
                && $prev['series_name'] === $entry->series_name;

            if ($sameRun) {
                $grouped[count($grouped) - 1]['episodes'][] = $entry;
            } else {
                $grouped[] = [
                    'type'        => $isSeries ? 'series_group' : 'film',
                    'series_name' => $isSeries ? $entry->series_name : null,
                    'era_label'   => $entry->era_label,
                    'episodes'    => $isSeries ? [$entry] : [],
                    'entry'       => $isSeries ? null : $entry,
                    'group_thumbnail'   => $isSeries ? $this->getGroupThumbnail($entry->series_name) : null,
                    'group_thumbnail_position'   => $isSeries ? $this->getGroupThumbnailPosition($entry->series_name) : null,
                ];
            }

            $prev = [
                'series_name' => $isSeries ? $entry->series_name : null,
            ];
        }
        if ($this->hideWatched) {
            $grouped = array_filter($grouped, function ($item) {
                if ($item['type'] === 'film') {
                    return !$item['entry']->watched;
                }
                $watchedCount = collect($item['episodes'])->where('watched', true)->count();
                return $watchedCount < count($item['episodes']);
            });
        
            // Also filter watched episodes within each group
            $grouped = array_map(function ($item) {
                if ($item['type'] === 'series_group') {
                    $item['episodes'] = array_values(
                        array_filter($item['episodes'], fn($ep) => !$ep->watched)
                    );
                }
                return $item;
            }, $grouped);
        }

        // Group by era
        $byEra = [];
        foreach ($grouped as $item) {
            $byEra[$item['era_label']][] = $item;
        }

        return $byEra;
    }

    
    // stats + watched logic
    #[Computed]
    public function stats()
    {
        $userId = Auth::id();
        $total   = WatchEntry::count();
        $watched = WatchEntry::join('user_watch_states as uws', function ($join) use ($userId) {
                $join->on('watch_entries.id', '=', 'uws.watch_entry_id')
                     ->where('uws.user_id', $userId)
                     ->where('uws.watched', true);
            })->count();
        
        $furthestOrder = WatchEntry::join('user_watch_states as uws', function ($join) use ($userId) {
                $join->on('watch_entries.id', '=', 'uws.watch_entry_id')
                     ->where('uws.user_id', $userId)
                     ->where('uws.watched', true);
            })->max('watch_entries.order') ?? 0;

        return [
            'total'          => $total,
            'watched'        => $watched,
            'percent'        => $total > 0 ? round(($watched / $total) * 100) : 0,
            'furthest_order' => $furthestOrder,
        ];
    }

    // username menu logic
    public bool $userMenuOpen = false;

    public function toggleUserMenu(): void
    {
        $this->userMenuOpen = !$this->userMenuOpen;
    }

    public function closeUserMenu(): void
    {
        $this->userMenuOpen = false;
    }


    // tv series group logic
    public array $expandedGroups = [];

    public function toggleGroup(string $key): void
    {
        if (in_array($key, $this->expandedGroups)) {
            $this->expandedGroups = array_values(
                array_filter($this->expandedGroups, fn($k) => $k !== $key)
            );
        } else {
            $this->expandedGroups[] = $key;
        }
    }

    // background image for tv series
    private function getGroupThumbnail(string $seriesName): ?string
    {
        return match($seriesName) {
            'The Clone Wars'         => '/images/cw6.jpg',
            'The Bad Batch'          => '/images/bad-batch.jpeg',
            'Star Wars Rebels'       => '/images/rebelsupscaled.jpg',
            'The Mandalorian'        => '/images/mando.jpeg',
            'The Book of Boba Fett'  => '/images/boba.png',
            'Ahsoka'                 => '/images/ahsoka-banner3-4k.jpg',
            'Tales of the Jedi'      => '/images/talesjedi3.jpg',
            'Tales of the Empire'    => '/images/talesempire.jpg',
            'Tales of the Underworld'=> '/images/tales-of-the-underworld.jpg',
            default                  => null,
        };
    }

    private function getGroupThumbnailPosition(string $seriesName): ?string
    {
        return match($seriesName) {
            'The Clone Wars'         => 'right 48%',
            'The Bad Batch'          => 'right 5%',
            'Star Wars Rebels'       => 'right 35%',
            'The Mandalorian'        => 'right 3%',
            'The Book of Boba Fett'  => 'right 15%',
            'Ahsoka'                 => 'right 55%',
            'Tales of the Jedi'      => 'right 58%',
            'Tales of the Empire'    => 'right 34%',
            'Tales of the Underworld'=> 'right 12%',
            default                  => null,
        };
    }


    // logic for recommendation legend
    public bool $legendOpen = false;

    public function toggleLegend(): void
    {
        $this->legendOpen = !$this->legendOpen;
    }


    public function render()
    {
        return view('livewire.watch-list', [
            'entries'              => $this->entries(),
            'stats'                => $this->stats(),
            'filterRecommendation' => $this->filterRecommendation,
            'hideWatched'          => $this->hideWatched,
            'expandedId'           => $this->expandedId,
            'expandedGroups'       => $this->expandedGroups,
            'legendOpen'           => $this->legendOpen,
            'furthestOrder' => $this->stats['furthest_order'],
        ]);
    }
}