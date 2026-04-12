<?php
namespace App\Livewire;

use App\Models\WatchEntry;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\UserWatchState;
use Illuminate\Support\Facades\DB;


class WatchList extends Component
{

    
    public string $filterEra           = 'all';
    #[\Livewire\Attributes\Url]
    public string $filterRecommendation = 'all';
    
    #[\Livewire\Attributes\Url]
    public bool $hideWatched = false;
    public ?int   $expandedId           = null;


    // select as watched button
    public function toggleWatched(int $id): void
    {
        $userId = auth()->id();
    
        $state = UserWatchState::firstOrNew([
            'user_id' => $userId,
            'watch_entry_id' => $id,
        ]);
    
        $state->watched = !$state->watched;
        $state->save();
    }

    public function toggleExpanded(int $id): void
    {
        $this->expandedId = ($this->expandedId === $id) ? null : $id;
    }

    // reset progress button
    public function resetProgress(): void
    {
        DB::table('user_watch_states')
            ->where('user_id', auth()->id())
            ->update(['watched' => false]);
    }

    
    // getting all the entries logic
    public function entries()
    {
        $userId = auth()->id();

        $raw = WatchEntry::ordered()
            ->leftJoin('user_watch_states as uws', function ($join) use ($userId) {
                $join->on('watch_entries.id', '=', 'uws.watch_entry_id')
                    ->where('uws.user_id', $userId);
            })
            ->when($this->filterRecommendation !== 'all',
                fn($q) => $q->where('recommendation', $this->filterRecommendation))
            ->when($this->hideWatched,
                fn($q) => $q->where(function ($q) {
                    $q->whereNull('uws.watched')
                        ->orWhere('uws.watched', false);
                }))
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
                ];
            }

            $prev = [
                'series_name' => $isSeries ? $entry->series_name : null,
            ];
        }

        // Group by era
        $byEra = [];
        foreach ($grouped as $item) {
            $byEra[$item['era_label']][] = $item;
        }

        return $byEra;
    }

    
    // stats + watched logic
    public function stats()
    {
        $userId = auth()->id();

        $total = WatchEntry::count();

        $watched = DB::table('user_watch_states')
            ->where('user_id', $userId)
            ->where('watched', true)
            ->count();

        return [
            'total'   => $total,
            'watched' => $watched,
            'percent' => $total > 0 ? round(($watched/$total)*100) : 0,
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
            'The Clone Wars'         => '/images/clone-wars-banner.jpg',
            'The Bad Batch'          => '/images/bad-batch-banner.jpg',
            'Star Wars Rebels'       => '/images/rebels-banner.jpg',
            'The Mandalorian'        => '/images/mandalorian-banner.jpg',
            'The Book of Boba Fett'  => '/images/boba-fett-banner.jpg',
            'Ahsoka'                 => '/images/ahsoka-banner.jpg',
            'Obi-Wan Kenobi'         => '/images/obi-wan-banner.jpg',
            'Andor'                  => '/images/andor-banner.jpg',
            'Tales of the Jedi'      => '/images/tales-jedi-banner.jpg',
            'Tales of the Empire'    => '/images/tales-empire-banner.jpg',
            'Tales of the Underworld'=> '/images/tales-underworld-banner.jpg',
            default                  => null,
        };
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
        ]);
    }
}