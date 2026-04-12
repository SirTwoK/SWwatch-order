<div>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <div class="flex items-center justify-between flex-wrap gap-6 mb-8 pb-6 border-b border-[#1a2030]">
            @auth
<div class="relative flex items-center gap-3">

    {{-- User badge --}}
    <button
        wire:click="toggleUserMenu"
        class="flex items-center gap-2 px-3 py-1.5 rounded-md border border-[#1a2030]
               bg-[#0a0c10] hover:border-[#2a3545] transition-all duration-150">

        <div class="w-2 h-2 rounded-full bg-[#c9a227] shadow-[0_0_8px_rgba(201,162,39,0.6)]"></div>

        <span class="text-xs tracking-[1.5px] uppercase text-[#8a9aaa]">
            {{ auth()->user()->name ?? auth()->user()->email }}
        </span>

        {{-- arrow --}}
        <svg class="w-3 h-3 text-[#556070]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    {{-- Dropdown --}}
    @if($userMenuOpen)
        {{-- click outside blocker --}}
        <div
            wire:click="closeUserMenu"
            class="fixed inset-0 z-10"></div>

        <div class="absolute right-0 top-10 z-20 w-44 bg-[#0a0c10]
                    border border-[#1a2030] rounded-md overflow-hidden shadow-lg">

            {{-- logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full text-left px-4 py-2 text-xs uppercase tracking-[2px]
                           text-[#556070] hover:bg-[#1a2030] hover:text-[#c9a227]
                           transition-colors">
                    Logout
                </button>
            </form>

        </div>
    @endif

</div>
@endauth
            <div>
                <h1 class="font-['Exo_2'] text-3xl font-extrabold tracking-[4px] uppercase text-[#f0ece0]">★ Star Wars</h1>
                <p class="text-xs tracking-[2px] uppercase text-[#556070] mt-1">Chronological Watch Order</p>
            </div>
            <div class="min-w-[220px]">
                <div class="flex justify-between text-sm text-[#556070] mb-1.5">
                    <span>{{ $stats['watched'] }} / {{ $stats['total'] }} watched</span>
                    <span>{{ $stats['percent'] }}%</span>
                </div>
                <div class="h-[3px] bg-[#1a2030] rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-[#c9a227] to-[#f0d060] rounded-full transition-all duration-500"
                         style="width: {{ $stats['percent'] }}%"></div>
                </div>
            </div>
        </div>

            {{-- Controls --}}
            <div class="flex flex-wrap gap-4 items-start justify-between mb-7">
                <div class="flex flex-col gap-2.5 flex-1">
                    <div class="flex items-center gap-2.5 flex-wrap">
                        <span class="text-xs tracking-[2px] uppercase text-[#556070]">Show</span>
                        <div class="flex gap-1 flex-wrap">
                            @foreach([
                                ['all', 'All', ''],
                                ['must', 'Must Watch', 'must'],
                                ['recommended', 'Recommended', 'rec'],
                                ['skip', 'Could Skip', 'skip'],
                            ] as [$val, $label, $type])
                                <button wire:click="$set('filterRecommendation', '{{ $val }}')"
                                        class="px-3 py-1 border rounded-full text-xs font-semibold tracking-wide uppercase cursor-pointer transition-all duration-150
                                        {{ $filterRecommendation === $val
                                            ? ($type === 'must' ? 'bg-[#2a1f08] border-[#c9a227] text-[#c9a227]'
                                            : ($type === 'rec'  ? 'bg-[#0a1f2a] border-[#4a9eca] text-[#4a9eca]'
                                            : ($type === 'skip' ? 'bg-[#1a1f25] border-[#3a4a55] text-[#8a9aaa]'
                                            : 'bg-[#1a2535] border-[#2a3a50] text-[#c8c4b4]')))
                                            : 'border-[#1a2030] text-[#556070] hover:border-[#2a3545] hover:text-[#8a9aaa]' }}">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Collapsible legend --}}
                    <div>
                        <button wire:click="toggleLegend"
                                class="flex items-center gap-2 text-[10px] tracking-[2px] uppercase text-[#3a4555] hover:text-[#556070] transition-colors">
                            <svg class="w-3 h-3 transition-transform duration-200 {{ $legendOpen ? 'rotate-180' : '' }}" viewBox="0 0 16 16" fill="none">
                                <polyline points="3,6 8,11 13,6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            What do these mean?
                        </button>

                        @if($legendOpen)
                            <div class="mt-3 border border-[#1a2030] rounded-md overflow-hidden">
                                <div class="grid grid-cols-4 divide-x divide-[#1a2030]">
                                    <div class="px-4 py-3">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="w-2 h-2 rounded-full bg-[#c9a227] shrink-0"></span>
                                            <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#c9a227]">Must Watch</span>
                                        </div>
                                        <p class="text-xs text-[#556070] leading-relaxed">Essential to the story. Skipping these will leave you lost or miss major character moments that pay off later.</p>
                                    </div>
                                    <div class="px-4 py-3">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="w-2 h-2 rounded-full bg-[#9b6dff] shrink-0"></span>
                                            <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#9b6dff]">Highly Recommended</span>
                                        </div>
                                        <p class="text-xs text-[#556070] leading-relaxed">Worth your time. Expands the lore, develops characters, or adds context that enriches the must-watch content.</p>
                                    </div>
                                    <div class="px-4 py-3">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="w-2 h-2 rounded-full bg-[#4a9eca] shrink-0"></span>
                                            <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#4a9eca]">Recommended</span>
                                        </div>
                                        <p class="text-xs text-[#556070] leading-relaxed">Has some bearing on the story and characters but mostly just fun Star Wars. Watch if you're enjoying the ride.</p>
                                    </div>
                                    <div class="px-4 py-3">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="w-2 h-2 rounded-full bg-[#556070] shrink-0"></span>
                                            <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#8a9aaa]">Could Skip</span>
                                        </div>
                                        <p class="text-xs text-[#556070] leading-relaxed">Filler or self-contained. Fine for completionists but skipping won't affect your experience.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="flex items-center gap-2 cursor-pointer select-none text-sm text-[#556070]">
                        <input type="checkbox" wire:model.live="hideWatched" class="hidden peer">
                        <div class="w-8 h-[18px] bg-[#1a2030] border border-[#2a3040] rounded-full relative transition-colors duration-200 peer-checked:bg-[#2a1f08] peer-checked:border-[#c9a227]">
                            <div class="w-3 h-3 bg-[#556070] rounded-full absolute top-[2px] left-[2px] transition-all duration-200 peer-checked:left-[18px] peer-checked:bg-[#c9a227]"></div>
                        </div>
                        <span>Hide watched</span>
                    </label>
                    <button wire:click="resetProgress"
                            class="bg-transparent border border-[#1a2030] rounded text-[#556070] text-xs font-semibold tracking-widest uppercase px-3 py-1 cursor-pointer transition-all hover:border-[#2a3545] hover:text-[#8a9aaa]">
                        Reset
                    </button>
                </div>
            </div>

        {{-- Watch List --}}
        <div class="flex flex-col">
            @forelse ($entries as $eraLabel => $group)
                <div class="mb-2">
                    <div class="flex items-center gap-3 my-6">
                        <span class="flex-1 h-px bg-[#1a2030]"></span>
                        <span class="text-[11px] tracking-[3px] uppercase text-[#556070] whitespace-nowrap">{{ $eraLabel }}</span>
                        <span class="flex-1 h-px bg-[#1a2030]"></span>
                    </div>

                    @foreach ($group as $item)

                        @if ($item['type'] === 'film')
                            {{-- ── Film bar ── --}}
                            @php $entry = $item['entry']; @endphp
                            <div class="relative flex items-center h-24 rounded-md overflow-hidden mb-1.5 transition-transform duration-150 hover:translate-x-1"
                                wire:key="film-{{ $entry->id }}">

                                <div class="absolute inset-0 transition-all duration-200 {{ $entry->watched ? 'brightness-[0.15] saturate-[0.2]' : 'brightness-[0.30] saturate-75' }}"
                                    style="background-color: {{ $entry->thumbnail_color }}; {{ $entry->thumbnail_url ? 'background-image: url(' . $entry->thumbnail_url . '); background-size: 100%; background-position: ' . $entry->thumbnail_position . ';' : '' }}"></div>
                                {{-- <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(8,10,15,0.85) 0%, rgba(8,10,15,0.40) 60%, transparent 100%);"></div> --}}
                                <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(8,10,15,1) 0%, rgba(8,10,15,1) 25%, rgba(8,10,15,0.7) 40%, rgba(8,10,15,0.2) 60%, transparent 75%);"></div>
                                <div class="relative w-[52px] text-center shrink-0">
                                    <span class="font-['Exo_2'] text-xs font-bold tracking-wide {{ $entry->watched ? 'text-[#1f2a35]' : 'text-[#556070]' }}">
                                        {{ str_pad($entry->order, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>

                                <div class="relative w-px h-8 bg-[#1a2030] shrink-0"></div>

                                <button class="relative flex-1 px-4 min-w-0 text-left bg-transparent border-none cursor-pointer"
                                        wire:click="toggleExpanded({{ $entry->id }})">
                                    <div class="text-xs tracking-[1.5px] uppercase {{ $entry->watched ? 'text-[#1a2530]' : 'text-[#556070]' }} mb-0.5">Film</div>
                                    <div class="font-['Exo_2'] text-base font-semibold tracking-wide truncate {{ $entry->watched ? 'text-[#2a3545]' : 'text-[#f0ece0]' }}">{{ $entry->title }}</div>
                                    <div class="text-xs text-[#556070] mt-0.5">{{ $entry->timeline }} · {{ $entry->formatted_duration }}</div>
                                </button>

                                <div class="relative flex items-center gap-1.5 px-4 shrink-0 {{ $entry->watched ? 'opacity-20' : '' }}">
                                    <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $entry->recommendation === 'must' ? 'bg-[#c9a227]' : ($entry->recommendation === 'recommended' ? 'bg-[#4a9eca]' : 'bg-[#556070]') }}"></span>
                                    <span class="text-xs tracking-[1.5px] uppercase font-semibold whitespace-nowrap {{ $entry->recommendation === 'must' ? 'text-[#c9a227]' : ($entry->recommendation === 'recommended' ? 'text-[#4a9eca]' : 'text-[#556070]') }}">
                                        @if($entry->recommendation === 'must') Must watch
                                        @elseif($entry->recommendation === 'recommended') Recommended
                                        @else Could skip @endif
                                    </span>
                                </div>

                                <div class="relative w-px h-8 bg-[#1a2030] shrink-0"></div>

                                <button class="relative w-[52px] h-full flex items-center justify-center bg-transparent border-none cursor-pointer shrink-0 group"
                                        wire:click="toggleWatched({{ $entry->id }})">
                                    <div class="w-[22px] h-[22px] rounded-full border flex items-center justify-center transition-all duration-200 {{ $entry->watched ? 'bg-[#c9a227] border-[#c9a227]' : 'border-[#556070] group-hover:border-[#c9a227]' }}">
                                        @if($entry->watched)
                                            <svg class="w-2.5 h-2.5" viewBox="0 0 10 10" fill="none">
                                                <polyline points="1.5,5 4,7.5 8.5,2.5" stroke="#0a0c10" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                            </div>

                            @if($expandedId === $entry->id)
                                <div class="bg-[#0d1018] border border-[#1a2030] border-t-0 rounded-b-md -mt-1.5 mb-1.5 overflow-hidden">

                                    {{-- Synopsis --}}
                                    @if($entry->synopsis)
                                        <div class="px-6 py-4 pl-[70px] border-b border-[#1a2030]">
                                            <p class="text-sm text-[#8a9aaa] leading-relaxed italic">{{ $entry->synopsis }}</p>
                                        </div>
                                    @endif

                                    {{-- Before watch --}}
                                    <div class="px-6 py-4 pl-[70px] border-b border-[#1a2030]">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="text-[15px] tracking-[3px] uppercase text-[#4a9eca]">Before you watch</span>
                                            <div class="flex-1 h-px bg-[#1a2030]"></div>
                                        </div>
                                        @if($entry->before_watch)
                                            <p class="text-xs text-[#556070] leading-relaxed">{{ $entry->before_watch }}</p>
                                        @else
                                            <p class="text-xs text-[#2a3545] leading-relaxed italic">Context and things to remember coming soon.</p>
                                        @endif
                                    </div>

                                    {{-- After watch — only if watched --}}
                                    @if($entry->watched)
                                        <div class="px-6 py-4 pl-[70px]">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-[15px] tracking-[3px] uppercase text-[#c9a227]">After you watch</span>
                                                <div class="flex-1 h-px bg-[#1a2030]"></div>
                                                <span class="text-[15px] tracking-[2px] uppercase text-[#3a4555]">spoilers</span>
                                            </div>
                                            @if($entry->after_watch)
                                                <p class="text-xs text-[#556070] leading-relaxed">{{ $entry->after_watch }}</p>
                                            @else
                                                <p class="text-xs text-[#2a3545] leading-relaxed italic">Spoiler breakdown and notes coming soon.</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="px-6 py-4 pl-[70px]">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-[15px] tracking-[3px] uppercase text-[#3a4555]">After you watch</span>
                                                <div class="flex-1 h-px bg-[#1a2030]"></div>
                                                <span class="text-[15px] tracking-[2px] uppercase text-[#3a4555]">spoilers</span>
                                            </div>
                                            <p class="text-xs text-[#2a3545] leading-relaxed italic">Mark as watched to reveal spoiler notes.</p>
                                        </div>
                                    @endif

                                </div>
                            @endif

                        @else
                            {{-- ── Series group banner ── --}}
                            @php
                                $episodes   = $item['episodes'];
                                $first      = $episodes[0];
                                $last       = $episodes[count($episodes) - 1];
                                $groupKey   = $item['series_name'] . '-' . $first->order;
                                $isOpen     = in_array($groupKey, $expandedGroups);
                                $epCount    = count($episodes);
                                $watchedCount = collect($episodes)->where('watched', true)->count();
                                $allWatched = $watchedCount === $epCount;
                                $anyWatched = $watchedCount > 0;
                            @endphp

                            {{-- Group banner --}}
                            <div class="relative flex items-center h-24 rounded-md {{ $isOpen ? 'rounded-b-none' : '' }} overflow-hidden mb-1.5 transition-transform duration-150 hover:translate-x-1 cursor-pointer"
                                wire:key="group-{{ $groupKey }}"
                                wire:click="toggleGroup('{{ $groupKey }}')">

                                <div class="absolute inset-0 {{ $allWatched ? 'brightness-[0.15] saturate-[0.2]' : 'brightness-[0.45] saturate-75' }}"
                                    style="
                                        background-color: {{ $first->thumbnail_color }};
                                        {{ $item['group_thumbnail'] ? 'background-image: url(' . $item['group_thumbnail'] . '); background-size: 85% auto; background-repeat: no-repeat; background-position: ' . ($item['group_thumbnail_position'] ?? 'center') . ';' : '' }}
                                    "></div>

                                {{-- Left-to-right fade + hard right cutoff --}}
                                <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(8,10,15,1) 0%, rgba(8,10,15,1) 25%, rgba(8,10,15,0.7) 40%, rgba(8,10,15,0.2) 60%, transparent 75%);"></div>
                              

                                {{-- Order range --}}
                                <div class="relative w-[52px] text-center shrink-0">
                                    <span class="font-['Exo_2'] text-[10px] font-bold tracking-wide text-[#556070] leading-tight">
                                        {{ str_pad($first->order, 2, '0', STR_PAD_LEFT) }}–{{ str_pad($last->order, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>

                                <div class="relative w-px h-8 bg-[#1a2030] shrink-0"></div>

                                {{-- Title + meta --}}
                                <div class="relative flex-1 px-4 min-w-0">
                                    <div class="text-xs tracking-[1.5px] uppercase text-[#556070] mb-0.5">
                                        Series · {{ $epCount }} episodes
                                    </div>
                                    <div class="font-['Exo_2'] text-base font-semibold tracking-wide truncate {{ $allWatched ? 'text-[#2a3545]' : 'text-[#f0ece0]' }}">
                                        {{ $item['series_name'] }}
                                        <span class="text-[#556070] font-normal text-sm">
                                            — {{ $epCount }} episodes
                                        </span>
                                    </div>
                                    <div class="text-xs text-[#556070] mt-0.5">
                                        {{ $first->timeline }}
                                        @if($anyWatched) · {{ $watchedCount }}/{{ $epCount }} watched @endif
                                    </div>
                                </div>

                                {{-- Expand indicator --}}
                                <div class="relative px-4 shrink-0 text-[#556070]">
                                    <svg class="w-4 h-4 transition-transform duration-200 {{ $isOpen ? 'rotate-180' : '' }}" viewBox="0 0 16 16" fill="none">
                                        <polyline points="3,6 8,11 13,6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <div class="relative w-px h-8 bg-[#1a2030] shrink-0"></div>

                                {{-- Group watched indicator --}}
                                
                            </div>

                            {{-- Expanded episodes --}}
                            @if($isOpen)
                                <div class="border border-[#1a2030] border-t-0 rounded-b-md mb-1.5 overflow-hidden">
                                    @foreach($episodes as $entry)
                                        <div class="relative flex items-center h-14 transition-all duration-150 hover:translate-x-1 {{ !$loop->last ? 'border-b border-[#1a2030]' : '' }}"
                                            wire:key="ep-{{ $entry->id }}">

                                            {{-- Indented bg --}}
                                            <div class="absolute inset-0 {{ $entry->watched ? 'brightness-[0.12] saturate-[0.2]' : 'brightness-[0.30] saturate-50' }}"
                                                style="background-color: {{ $entry->thumbnail_color }}; {{ $entry->thumbnail_url ? 'background-image: url(' . $entry->thumbnail_url . '); background-size: cover; background-position: ' . $entry->thumbnail_position . ';' : '' }}"></div>
                                            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(8,10,15,0.9) 0%, rgba(8,10,15,0.5) 70%, transparent 100%);"></div>

                                            {{-- Indent spacer --}}
                                            <div class="relative w-6 shrink-0"></div>

                                            {{-- Episode number --}}
                                            <div class="relative w-[46px] text-center shrink-0">
                                                <span class="font-['Exo_2'] text-[10px] font-bold tracking-wide {{ $entry->watched ? 'text-[#1f2a35]' : 'text-[#556070]' }}">
                                                    {{ str_pad($entry->order, 2, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </div>

                                            <div class="relative w-px h-7 bg-[#1a2030] shrink-0"></div>

                                            {{-- Info --}}
                                            <button class="relative flex-1 px-4 min-w-0 text-left bg-transparent border-none cursor-pointer" wire:click="toggleExpanded({{ $entry->id }})">
                                                <div class="flex items-center gap-2 mb-0.5">
                                                    <div class="font-['Exo_2'] text-base font-semibold tracking-wide truncate {{ $entry->watched ? 'text-[#2a3545]' : 'text-[#f0ece0]' }}">
                                                        {{ $entry->title }}
                                                    </div>
                                                    <div class="flex items-center gap-1 shrink-0">
                                                        <span class="px-1.5 py-0.5 rounded text-[15px] font-bold tracking-wide bg-[#1a2535] text-[#4a9eca] border border-[#2a3a50]">
                                                            S{{ $entry->season }}
                                                        </span>
                                                        <span class="px-1.5 py-0.5 rounded text-[15px] font-bold tracking-wide bg-[#251a10] text-[#c9a227] border border-[#3a2a10]">
                                                            E{{ $entry->episode }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </button>

                                            {{-- Badge --}}
                                            <div class="relative flex items-center gap-1.5 px-3 shrink-0 {{ $entry->watched ? 'opacity-20' : '' }}">
                                                <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $entry->recommendation === 'must' ? 'bg-[#c9a227]' : ($entry->recommendation === 'recommended' ? 'bg-[#4a9eca]' : 'bg-[#556070]') }}"></span>
                                                <span class="text-[10px] tracking-[1.5px] uppercase font-semibold whitespace-nowrap {{ $entry->recommendation === 'must' ? 'text-[#c9a227]' : ($entry->recommendation === 'recommended' ? 'text-[#4a9eca]' : 'text-[#556070]') }}">
                                                    @if($entry->recommendation === 'must') Must watch
                                                    @elseif($entry->recommendation === 'recommended') Recommended
                                                    @else Could skip @endif
                                                </span>
                                            </div>

                                            <div class="relative w-px h-7 bg-[#1a2030] shrink-0"></div>

                                            {{-- Watched toggle --}}
                                            <button class="relative w-[52px] h-full flex items-center justify-center bg-transparent border-none cursor-pointer shrink-0 group"
                                                    wire:click.stop="toggleWatched({{ $entry->id }})">
                                                <div class="w-[20px] h-[20px] rounded-full border flex items-center justify-center transition-all duration-200
                                                    {{ $entry->watched ? 'bg-[#c9a227] border-[#c9a227]' : 'border-[#556070] group-hover:border-[#c9a227]' }}">
                                                    @if($entry->watched)
                                                        <svg class="w-2 h-2" viewBox="0 0 10 10" fill="none">
                                                            <polyline points="1.5,5 4,7.5 8.5,2.5" stroke="#0a0c10" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </button>
                                        </div>

                                        {{-- Synopsis --}}
                                        @if($expandedId === $entry->id)
                                            <div class="bg-[#080c12] border-b border-[#1a2030] overflow-hidden">

                                                @if($entry->synopsis)
                                                    <div class="px-5 py-3 pl-[100px] border-b border-[#1a2030]">
                                                        <p class="text-sm text-[#8a9aaa] leading-relaxed italic">{{ $entry->synopsis }}</p>
                                                    </div>
                                                @endif

                                                <div class="px-5 py-3 pl-[100px] border-b border-[#1a2030]">
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <span class="text-[13px] tracking-[3px] uppercase text-[#4a9eca]">Before you watch</span>
                                                        <div class="flex-1 h-px bg-[#111820]"></div>
                                                    </div>
                                                    @if($entry->before_watch)
                                                        <p class="text-xs text-[#556070] leading-relaxed">{{ $entry->before_watch }}</p>
                                                    @else
                                                        <p class="text-xs text-[#2a3545] leading-relaxed italic">Context and things to remember coming soon.</p>
                                                    @endif
                                                </div>

                                                @if($entry->watched)
                                                    <div class="px-5 py-3 pl-[100px]">
                                                        <div class="flex items-center gap-2 mb-2">
                                                            <span class="text-[13px] tracking-[3px] uppercase text-[#c9a227]">After you watch</span>
                                                            <div class="flex-1 h-px bg-[#111820]"></div>
                                                            <span class="text-[13px] tracking-[2px] uppercase text-[#3a4555]">spoilers</span>
                                                        </div>
                                                        @if($entry->after_watch)
                                                            <p class="text-xs text-[#556070] leading-relaxed">{{ $entry->after_watch }}</p>
                                                        @else
                                                            <p class="text-xs text-[#2a3545] leading-relaxed italic">Spoiler breakdown and notes coming soon.</p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="px-5 py-3 pl-[100px]">
                                                        <div class="flex items-center gap-2 mb-2">
                                                            <span class="text-[13px] tracking-[3px] uppercase text-[#3a4555]">After you watch</span>
                                                            <div class="flex-1 h-px bg-[#111820]"></div>
                                                            <span class="text-[13px] tracking-[2px] uppercase text-[#3a4555]">spoilers</span>
                                                        </div>
                                                        <p class="text-xs text-[#2a3545] leading-relaxed italic">Mark as watched to reveal spoiler notes.</p>
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
                <div class="text-center py-12 text-[#556070] text-sm tracking-wide">No entries match your filters.</div>
            @endforelse
        </div>

        {{-- Legend
        <div class="flex gap-6 flex-wrap mt-8 pt-5 border-t border-[#1a2030]">
            <div class="flex items-center gap-1.5 text-xs text-[#556070]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#c9a227] shrink-0"></span> Must watch
            </div>
            <div class="flex items-center gap-1.5 text-xs text-[#556070]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#4a9eca] shrink-0"></span> Recommended
            </div>
            <div class="flex items-center gap-1.5 text-xs text-[#556070]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#556070] shrink-0"></span> Could skip
            </div>
        </div> --}}
    </div>
</div>