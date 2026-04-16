<div>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <div class="flex items-center justify-between flex-wrap gap-6 mb-8 pb-6 border-b border-[#2a3545]">
            @auth
            <div class="relative flex items-center gap-3">
                <button wire:click="toggleUserMenu"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-md border border-[#2a3545] bg-[#0f1520] hover:border-[#3a4f60] transition-all duration-150">
                    <div class="w-2 h-2 rounded-full bg-[#c9a227]"></div>
                    <span class="text-xs tracking-[1.5px] uppercase text-[#9aaabb]">
                        {{ auth()->user()->name ?? auth()->user()->email }}
                    </span>
                    <svg class="w-3 h-3 text-[#7a8fa0]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                @if($userMenuOpen)
                    <div wire:click="closeUserMenu" class="fixed inset-0 z-10"></div>
                    <div class="absolute right-0 top-10 z-20 w-44 bg-[#0f1520] border border-[#2a3545] rounded-md overflow-hidden shadow-lg">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-xs uppercase tracking-[2px] text-[#7a8fa0] hover:bg-[#1a2535] hover:text-[#c9a227] transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            @endauth

            <div>
                <h1 class="font-['Exo_2'] text-3xl font-extrabold tracking-[4px] uppercase text-[#f0ece0]">★ Star Wars</h1>
                <p class="text-xs tracking-[2px] uppercase text-[#7a8fa0] mt-1">Greatest Watch Order In The Galaxy</p>
            </div>
            <div class="min-w-[220px]">
                <div class="flex justify-between text-sm text-[#7a8fa0] mb-1.5">
                    <span>{{ $stats['watched'] }} / {{ $stats['total'] }} watched</span>
                    <span>{{ $stats['percent'] }}%</span>
                </div>
                <div class="h-[3px] bg-[#2a3545] rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-[#c9a227] to-[#f0d060] rounded-full transition-all duration-500"
                         style="width: {{ $stats['percent'] }}%"></div>
                </div>
            </div>
        </div>

        {{-- Controls --}}
        <div class="flex flex-wrap gap-4 items-start justify-between mb-7">
            <div class="flex flex-col gap-2.5 flex-1">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <span class="text-xs tracking-[2px] uppercase text-[#7a8fa0]">Show</span>
                    <div class="flex gap-1 flex-wrap">
                        @foreach([
                            ['all', 'All', ''],
                            ['must', 'Must Watch', 'must'],
                            ['highly_recommended', 'Highly Rec.', 'hrec'],
                            ['recommended', 'Recommended', 'rec'],
                            ['skip', 'Could Skip', 'skip'],
                        ] as [$val, $label, $type])
                            <button wire:click="$set('filterRecommendation', '{{ $val }}')"
                                    class="px-3 py-1 border rounded-full text-xs font-semibold tracking-wide uppercase cursor-pointer transition-all duration-150
                                    {{ $filterRecommendation === $val
                                        ? ($type === 'must'  ? 'bg-[#2a1f08] border-[#c9a227] text-[#c9a227]'
                                        : ($type === 'hrec'  ? 'bg-[#1f1a35] border-[#9b6dff] text-[#9b6dff]'
                                        : ($type === 'rec'   ? 'bg-[#0a1f2a] border-[#4a9eca] text-[#4a9eca]'
                                        : ($type === 'skip'  ? 'bg-[#1a1f25] border-[#556070] text-[#9aaabb]'
                                        : 'bg-[#1a2535] border-[#3a4f60] text-[#d0ccbc]'))))
                                        : 'border-[#2a3545] text-[#7a8fa0] hover:border-[#3a4f60] hover:text-[#9aaabb]' }}">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Collapsible legend --}}
                <div>
                    <button wire:click="toggleLegend"
                            class="flex items-center gap-2 text-[10px] tracking-[2px] uppercase text-[#556070] hover:text-[#7a8fa0] transition-colors">
                        <svg class="w-3 h-3 transition-transform duration-200 {{ $legendOpen ? 'rotate-180' : '' }}" viewBox="0 0 16 16" fill="none">
                            <polyline points="3,6 8,11 13,6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        What do these mean?
                    </button>

                    @if($legendOpen)
                        <div class="mt-3 border border-[#2a3545] rounded-md overflow-hidden">
                            <div class="grid grid-cols-4 divide-x divide-[#2a3545]">
                                <div class="px-4 py-3">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="w-2 h-2 rounded-full bg-[#c9a227] shrink-0"></span>
                                        <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#c9a227]">Must Watch</span>
                                    </div>
                                    <p class="text-xs text-[#7a8fa0] leading-relaxed">Essential to the story. Skipping these will leave you lost or miss major character moments that pay off later.</p>
                                </div>
                                <div class="px-4 py-3">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="w-2 h-2 rounded-full bg-[#9b6dff] shrink-0"></span>
                                        <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#9b6dff]">Highly Recommended</span>
                                    </div>
                                    <p class="text-xs text-[#7a8fa0] leading-relaxed">Worth your time. Expands the lore, develops characters, or adds context that enriches the must-watch content.</p>
                                </div>
                                <div class="px-4 py-3">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="w-2 h-2 rounded-full bg-[#4a9eca] shrink-0"></span>
                                        <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#4a9eca]">Recommended</span>
                                    </div>
                                    <p class="text-xs text-[#7a8fa0] leading-relaxed">Has some bearing on the story and characters but mostly just fun Star Wars. Watch if you're enjoying the ride.</p>
                                </div>
                                <div class="px-4 py-3">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="w-2 h-2 rounded-full bg-[#7a8fa0] shrink-0"></span>
                                        <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#9aaabb]">Could Skip</span>
                                    </div>
                                    <p class="text-xs text-[#7a8fa0] leading-relaxed">Filler or self-contained. Fine for completionists but skipping won't affect your experience.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3 flex-wrap">
                <label class="flex items-center gap-2 cursor-pointer select-none text-sm text-[#7a8fa0]">
                    <input type="checkbox" wire:model.live="hideWatched" class="sr-only">
                    <div class="relative w-8 h-[18px] rounded-full border transition-colors duration-200 flex items-center px-[3px]
                                {{ $hideWatched ? 'bg-[#2a1f08] border-[#c9a227]' : 'bg-[#2a3545] border-[#2a3545]' }}">
                        <div class="w-3 h-3 rounded-full transition-all duration-200
                                    {{ $hideWatched ? 'bg-[#c9a227] ml-[14px]' : 'bg-[#7a8fa0]' }}"></div>
                    </div>
                    <span>Hide watched</span>
                </label>
                <button wire:click="resetProgress"
                        class="bg-transparent border border-[#2a3545] rounded text-[#7a8fa0] text-xs font-semibold tracking-widest uppercase px-3 py-1 cursor-pointer transition-all hover:border-[#3a4f60] hover:text-[#9aaabb]">
                    Reset
                </button>
            </div>
        </div>

        {{-- Watch List --}}
        <div class="flex flex-col">
            @forelse ($entries as $eraLabel => $group)
                <div class="mb-2">
                    <div class="flex items-center gap-3 my-6">
                        <span class="flex-1 h-px bg-[#2a3545]"></span>
                        <span class="text-[11px] tracking-[3px] uppercase text-[#7a8fa0] whitespace-nowrap">{{ $eraLabel }}</span>
                        <span class="flex-1 h-px bg-[#2a3545]"></span>
                    </div>

                    @foreach ($group as $item)

                        @if ($item['type'] === 'film')
                            @php $entry = $item['entry']; @endphp
                            <div class="relative flex items-center h-24 rounded-md overflow-hidden mb-1.5 transition-all duration-150
                                        hover:translate-x-1
                                        border border-slate-800
                                        hover:border-blue-500
                                        hover:shadow-[0_0_8px_rgba(59,130,246,0.7)]"
                                wire:key="film-{{ $entry->id }}">

                                <div class="absolute inset-0 transition-all duration-200 {{ $entry->watched ? 'brightness-[0.15] saturate-[0.2]' : 'brightness-[0.6] saturate-75' }}"
                                     style="background-color: {{ $entry->thumbnail_color }}; {{ $entry->thumbnail_url ? 'background-image: url(' . $entry->thumbnail_url . '); background-size: 100%; background-position: ' . $entry->thumbnail_position . ';' : '' }}"></div>
                                <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(6,8,12,1) 0%, rgba(6,8,12,1) 25%, rgba(6,8,12,0.7) 40%, rgba(6,8,12,0.2) 60%, transparent 75%);"></div>

                                <div class="relative w-[52px] text-center shrink-0">
                                    <span class="font-['Exo_2'] text-xs font-bold tracking-wide {{ $entry->watched ? 'text-[#2a3f4f]' : 'text-[#7a8fa0]' }}">
                                        {{ str_pad($entry->order, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>

                                <div class="relative w-px h-8 bg-[#2a3545] shrink-0"></div>

                                <button class="relative flex-1 px-4 min-w-0 text-left bg-transparent border-none cursor-pointer"
                                        wire:click="toggleExpanded({{ $entry->id }})">
                                    <div class="text-xs tracking-[1.5px] uppercase {{ $entry->watched ? 'text-[#2a3f4f]' : 'text-[#7a8fa0]' }} mb-0.5">Film</div>
                                    <div class="font-['Exo_2'] text-base font-semibold tracking-wide truncate {{ $entry->watched ? 'text-[#3a4f5f]' : 'text-[#f0ece0]' }}">{{ $entry->title }}</div>
                                    <div class="text-xs text-[#7a8fa0] mt-0.5">{{ $entry->timeline }} · {{ $entry->formatted_duration }}</div>
                                </button>

                                <div class="relative flex items-center gap-1.5 px-4 shrink-0 {{ $entry->watched ? 'opacity-30' : '' }}">
                                    <span class="w-1.5 h-1.5 rounded-full shrink-0
                                        {{ $entry->recommendation === 'must' ? 'bg-[#c9a227]'
                                        : ($entry->recommendation === 'highly_recommended' ? 'bg-[#9b6dff]'
                                        : ($entry->recommendation === 'recommended' ? 'bg-[#4a9eca]'
                                        : 'bg-[#7a8fa0]')) }}"></span>
                                    <span class="text-xs tracking-[1.5px] uppercase font-semibold whitespace-nowrap
                                        {{ $entry->recommendation === 'must' ? 'text-[#c9a227]'
                                        : ($entry->recommendation === 'highly_recommended' ? 'text-[#9b6dff]'
                                        : ($entry->recommendation === 'recommended' ? 'text-[#4a9eca]'
                                        : 'text-[#9aaabb]')) }}">
                                        @if($entry->recommendation === 'must') Must watch
                                        @elseif($entry->recommendation === 'highly_recommended') Highly Rec.
                                        @elseif($entry->recommendation === 'recommended') Recommended
                                        @else Could skip @endif
                                    </span>
                                </div>

                                <div class="relative w-px h-8 bg-[#2a3545] shrink-0"></div>

                                <button class="relative w-[52px] h-full flex items-center justify-center bg-transparent border-none cursor-pointer shrink-0 group"
                                        wire:click="toggleWatched({{ $entry->id }})">
                                    <div class="w-[22px] h-[22px] rounded-full border flex items-center justify-center transition-all duration-200
                                        {{ $entry->watched ? 'bg-[#c9a227] border-[#c9a227]' : 'border-[#7a8fa0] group-hover:border-[#c9a227]' }}">
                                        @if($entry->watched)
                                            <svg class="w-2.5 h-2.5" viewBox="0 0 10 10" fill="none">
                                                <polyline points="1.5,5 4,7.5 8.5,2.5" stroke="#0a0c10" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                            </div>

                            @if($expandedId === $entry->id)
                                <div class="bg-[#0f1520] border border-[#2a3545] border-t-0 rounded-b-md -mt-1.5 mb-1.5 overflow-hidden">
                                    @if($entry->synopsis)
                                        <div class="px-6 py-4 pl-[70px] border-b border-[#2a3545]">
                                            <p class="text-sm text-[#9aaabb] leading-relaxed italic">{{ $entry->synopsis }}</p>
                                        </div>
                                    @endif

                                    <div class="px-6 py-4 pl-[70px] border-b border-[#2a3545]">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="text-[11px] tracking-[3px] uppercase text-[#4a9eca]">Before you watch</span>
                                            <div class="flex-1 h-px bg-[#2a3545]"></div>
                                        </div>
                                        @if($entry->before_watch)
                                            <p class="text-xs text-[#7a8fa0] leading-relaxed">{{ $entry->before_watch }}</p>
                                        @else
                                            <p class="text-xs text-[#445060] leading-relaxed italic">Context and things to remember coming soon.</p>
                                        @endif
                                    </div>

                                    @if($entry->watched)
                                        <div class="px-6 py-4 pl-[70px]">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-[11px] tracking-[3px] uppercase text-[#c9a227]">After you watch</span>
                                                <div class="flex-1 h-px bg-[#2a3545]"></div>
                                                <span class="text-[10px] tracking-[2px] uppercase text-[#556070]">spoilers</span>
                                            </div>
                                            @if($entry->after_watch)
                                                <p class="text-xs text-[#7a8fa0] leading-relaxed">{{ $entry->after_watch }}</p>
                                            @else
                                                <p class="text-xs text-[#445060] leading-relaxed italic">Spoiler breakdown and notes coming soon.</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="px-6 py-4 pl-[70px]">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-[11px] tracking-[3px] uppercase text-[#556070]">After you watch</span>
                                                <div class="flex-1 h-px bg-[#2a3545]"></div>
                                                <span class="text-[10px] tracking-[2px] uppercase text-[#556070]">spoilers</span>
                                            </div>
                                            <p class="text-xs text-[#445060] leading-relaxed italic">Mark as watched to reveal spoiler notes.</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                        @else
                            @php
                                $episodes     = $item['episodes'];
                                $first        = $episodes[0];
                                $last         = $episodes[count($episodes) - 1];
                                $groupKey     = $item['series_name'] . '-' . $first->order;
                                $isOpen       = in_array($groupKey, $expandedGroups);
                                $epCount      = count($episodes);
                                $watchedCount = collect($episodes)->where('watched', true)->count();
                                $allWatched   = $watchedCount === $epCount;
                                $anyWatched   = $watchedCount > 0;
                            @endphp

                            <div class="relative flex items-center h-24 rounded-md {{ $isOpen ? 'rounded-b-none' : '' }} overflow-hidden mb-1.5
                                        transition-all duration-200 ease-out
                                        hover:translate-x-1 cursor-pointer
                                        border border-slate-800
                                        shadow-[0_0_4px_rgba(59,130,246,0.15)]
                                        hover:border-blue-500
                                        hover:shadow-[0_0_12px_rgba(59,130,246,0.85),inset_0_0_6px_rgba(59,130,246,0.25)]"
                                        wire:key="group-{{ $groupKey }}"
                                        wire:click="toggleGroup('{{ $groupKey }}')">            

                                <div class="absolute inset-0 {{ $allWatched ? 'brightness-[0.15] saturate-[0.2]' : 'brightness-[0.6] saturate-75' }}"
                                     style="background-color: {{ $first->thumbnail_color }}; {{ $item['group_thumbnail'] ? 'background-image: url(' . $item['group_thumbnail'] . '); background-size: 85% auto; background-repeat: no-repeat; background-position: ' . ($item['group_thumbnail_position'] ?? 'center') . ';' : '' }}"></div>
                                <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(6,8,12,1) 0%, rgba(6,8,12,1) 25%, rgba(6,8,12,0.7) 40%, rgba(6,8,12,0.2) 60%, transparent 75%);"></div>

                                <div class="relative w-[52px] text-center shrink-0">
                                    <span class="font-['Exo_2'] text-[10px] font-bold tracking-wide text-[#7a8fa0] leading-tight">
                                        {{ str_pad($first->order, 2, '0', STR_PAD_LEFT) }}–{{ str_pad($last->order, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>

                                <div class="relative w-px h-8 bg-[#2a3545] shrink-0"></div>

                                <div class="relative flex-1 px-4 min-w-0">
                                    <div class="text-xs tracking-[1.5px] uppercase text-[#7a8fa0] mb-0.5">
                                        Series · {{ $epCount }} episodes
                                    </div>
                                    <div class="font-['Exo_2'] text-base font-semibold tracking-wide truncate {{ $allWatched ? 'text-[#3a4f5f]' : 'text-[#f0ece0]' }}">
                                        {{ $item['series_name'] }}
                                        <span class="text-[#7a8fa0] font-normal text-sm">— {{ $epCount }} episodes</span>
                                    </div>
                                    <div class="text-xs text-[#7a8fa0] mt-0.5">
                                        {{ $first->timeline }}
                                        @if($anyWatched) · {{ $watchedCount }}/{{ $epCount }} watched @endif
                                    </div>
                                </div>

                                <div class="relative px-4 shrink-0 text-[#7a8fa0]">
                                    <svg class="w-4 h-4 transition-transform duration-200 {{ $isOpen ? 'rotate-180' : '' }}" viewBox="0 0 16 16" fill="none">
                                        <polyline points="3,6 8,11 13,6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                            @if($isOpen)
                                <div class="border border-[#2a3545] border-t-0 rounded-b-md mb-1.5 overflow-hidden">
                                    @foreach($episodes as $entry)
                                        <div class="relative flex items-center h-14 transition-all duration-150 hover:translate-x-1 {{ !$loop->last ? 'border-b border-[#2a3545]' : '' }}"
                                             wire:key="ep-{{ $entry->id }}">

                                            <div class="absolute inset-0 {{ $entry->watched ? 'brightness-[0.12] saturate-[0.2]' : 'brightness-[0.30] saturate-50' }}"
                                                 style="background-color: {{ $entry->thumbnail_color }}; {{ $entry->thumbnail_url ? 'background-image: url(' . $entry->thumbnail_url . '); background-size: cover; background-position: ' . $entry->thumbnail_position . ';' : '' }}"></div>
                                            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(6,8,12,0.95) 0%, rgba(6,8,12,0.6) 60%, transparent 100%);"></div>

                                            <div class="relative w-6 shrink-0"></div>

                                            <div class="relative w-[46px] text-center shrink-0">
                                                <span class="font-['Exo_2'] text-[10px] font-bold tracking-wide {{ $entry->watched ? 'text-[#2a3f4f]' : 'text-[#7a8fa0]' }}">
                                                    {{ str_pad($entry->order, 2, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </div>

                                            <div class="relative w-px h-7 bg-[#2a3545] shrink-0"></div>

                                            <button class="relative flex-1 px-4 min-w-0 text-left bg-transparent border-none cursor-pointer"
                                                    wire:click="toggleExpanded({{ $entry->id }})">
                                                <div class="flex items-center gap-2 mb-0.5">
                                                    <div class="font-['Exo_2'] text-base font-semibold tracking-wide truncate {{ $entry->watched ? 'text-[#3a4f5f]' : 'text-[#f0ece0]' }}">
                                                        {{ $entry->title }}
                                                    </div>
                                                    <div class="flex items-center gap-1 shrink-0">
                                                        <span class="px-1.5 py-0.5 rounded text-[11px] font-bold tracking-wide bg-[#1a2535] text-[#4a9eca] border border-[#2a3a50]">
                                                            S{{ $entry->season }}
                                                        </span>
                                                        <span class="px-1.5 py-0.5 rounded text-[11px] font-bold tracking-wide bg-[#251a10] text-[#c9a227] border border-[#3a2a10]">
                                                            E{{ $entry->episode }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </button>

                                            <div class="relative flex items-center gap-1.5 px-3 shrink-0 {{ $entry->watched ? 'opacity-30' : '' }}">
                                                <span class="w-1.5 h-1.5 rounded-full shrink-0
                                                    {{ $entry->recommendation === 'must' ? 'bg-[#c9a227]'
                                                    : ($entry->recommendation === 'highly_recommended' ? 'bg-[#9b6dff]'
                                                    : ($entry->recommendation === 'recommended' ? 'bg-[#4a9eca]'
                                                    : 'bg-[#7a8fa0]')) }}"></span>
                                                <span class="text-[13px] tracking-[1.5px] uppercase font-semibold whitespace-nowrap
                                                    {{ $entry->recommendation === 'must' ? 'text-[#c9a227]'
                                                    : ($entry->recommendation === 'highly_recommended' ? 'text-[#9b6dff]'
                                                    : ($entry->recommendation === 'recommended' ? 'text-[#4a9eca]'
                                                    : 'text-[#9aaabb]')) }}">
                                                    @if($entry->recommendation === 'must') Must watch
                                                    @elseif($entry->recommendation === 'highly_recommended') Highly Recommended
                                                    @elseif($entry->recommendation === 'recommended') Recommended
                                                    @else Could skip @endif
                                                </span>
                                            </div>

                                            <div class="relative w-px h-7 bg-[#2a3545] shrink-0"></div>

                                            <button class="relative w-[52px] h-full flex items-center justify-center bg-transparent border-none cursor-pointer shrink-0 group"
                                                    wire:click.stop="toggleWatched({{ $entry->id }})">
                                                <div class="w-[20px] h-[20px] rounded-full border flex items-center justify-center transition-all duration-200
                                                    {{ $entry->watched ? 'bg-[#c9a227] border-[#c9a227]' : 'border-[#7a8fa0] group-hover:border-[#c9a227]' }}">
                                                    @if($entry->watched)
                                                        <svg class="w-2 h-2" viewBox="0 0 10 10" fill="none">
                                                            <polyline points="1.5,5 4,7.5 8.5,2.5" stroke="#0a0c10" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </button>
                                        </div>

                                        @if($expandedId === $entry->id)
                                            <div class="bg-[#0d1218] border-b border-[#2a3545] overflow-hidden">
                                                @if($entry->synopsis)
                                                    <div class="px-5 py-3 pl-[100px] border-b border-[#2a3545]">
                                                        <p class="text-sm text-[#9aaabb] leading-relaxed italic">{{ $entry->synopsis }}</p>
                                                    </div>
                                                @endif

                                                <div class="px-5 py-3 pl-[100px] border-b border-[#2a3545]">
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <span class="text-[11px] tracking-[3px] uppercase text-[#4a9eca]">Before you watch</span>
                                                        <div class="flex-1 h-px bg-[#2a3545]"></div>
                                                    </div>
                                                    @if($entry->before_watch)
                                                        <p class="text-xs text-[#7a8fa0] leading-relaxed">{{ $entry->before_watch }}</p>
                                                    @else
                                                        <p class="text-xs text-[#445060] leading-relaxed italic">Context and things to remember coming soon.</p>
                                                    @endif
                                                </div>

                                                @if($entry->watched)
                                                    <div class="px-5 py-3 pl-[100px]">
                                                        <div class="flex items-center gap-2 mb-2">
                                                            <span class="text-[11px] tracking-[3px] uppercase text-[#c9a227]">After you watch</span>
                                                            <div class="flex-1 h-px bg-[#2a3545]"></div>
                                                            <span class="text-[10px] tracking-[2px] uppercase text-[#556070]">spoilers</span>
                                                        </div>
                                                        @if($entry->after_watch)
                                                            <p class="text-xs text-[#7a8fa0] leading-relaxed">{{ $entry->after_watch }}</p>
                                                        @else
                                                            <p class="text-xs text-[#445060] leading-relaxed italic">Spoiler breakdown and notes coming soon.</p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="px-5 py-3 pl-[100px]">
                                                        <div class="flex items-center gap-2 mb-2">
                                                            <span class="text-[11px] tracking-[3px] uppercase text-[#556070]">After you watch</span>
                                                            <div class="flex-1 h-px bg-[#2a3545]"></div>
                                                            <span class="text-[10px] tracking-[2px] uppercase text-[#556070]">spoilers</span>
                                                        </div>
                                                        <p class="text-xs text-[#445060] leading-relaxed italic">Mark as watched to reveal spoiler notes.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            @empty
                <div class="text-center py-12 text-[#7a8fa0] text-sm tracking-wide">No entries match your filters.</div>
            @endforelse
        </div>
    </div>
    
</div>