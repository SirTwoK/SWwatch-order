<?php
namespace App\Livewire;

use App\Models\WatchEntry;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class WatchList extends Component
{
    public string $filterEra           = 'all';
    public string $filterRecommendation = 'all';
    public bool   $hideWatched          = false;
    public ?int   $expandedId           = null;

    public function toggleWatched(int $id): void
    {
        $entry = WatchEntry::findOrFail($id);
        $entry->update(['watched' => !$entry->watched]);
    }

    public function toggleExpanded(int $id): void
    {
        $this->expandedId = ($this->expandedId === $id) ? null : $id;
    }

    public function resetProgress(): void
    {
        WatchEntry::query()->update(['watched' => false]);
    }

    
    public function entries()
    {
        return WatchEntry::ordered()
            ->when($this->filterEra !== 'all',
                fn($q) => $q->where('era', $this->filterEra))
            ->when($this->filterRecommendation !== 'all',
                fn($q) => $q->where('recommendation', $this->filterRecommendation))
            ->when($this->hideWatched,
                fn($q) => $q->where('watched', false))
            ->get()->groupBy('era_label');
    }

    
    public function stats()
    {
        $total   = WatchEntry::count();
        $watched = WatchEntry::where('watched', true)->count();
        Log::info("alo alo");
        return [
            'total'   => $total,
            'watched' => $watched,
            'percent' => $total > 0 ? round(($watched/$total)*100) : 0,
        ];
        
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