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

    public function resetProgress(): void
{
    DB::table('user_watch_states')
        ->where('user_id', auth()->id())
        ->update(['watched' => false]);
}

    
public function entries()
{
    $userId = auth()->id();

    return WatchEntry::ordered()
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
        })
        ->groupBy('era_label');
}

    
    public function stats()
{
    $userId = auth()->id();

    $total = WatchEntry::count();

    $watched = \DB::table('user_watch_states')
        ->where('user_id', $userId)
        ->where('watched', true)
        ->count();

    return [
        'total'   => $total,
        'watched' => $watched,
        'percent' => $total > 0 ? round(($watched/$total)*100) : 0,
    ];
}

public bool $userMenuOpen = false;

public function toggleUserMenu(): void
{
    $this->userMenuOpen = !$this->userMenuOpen;
}

public function closeUserMenu(): void
{
    $this->userMenuOpen = false;
}


    public function render()
    {
        return view('livewire.watch-list', [
            'entries'              => $this->entries(),
            'stats'                => $this->stats(),
            'filterRecommendation' => $this->filterRecommendation,
            'hideWatched'          => $this->hideWatched,
            'expandedId'           => $this->expandedId,
        ]);
    }
}