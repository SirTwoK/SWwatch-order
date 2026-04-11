<div>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <div class="flex items-center justify-between flex-wrap gap-6 mb-8 pb-6 border-b border-[#1a2030]">
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

                    @foreach ($group as $entry)
                        <div class="relative flex items-center h-16 rounded-md overflow-hidden mb-1.5 transition-transform duration-150 hover:translate-x-1"
                             wire:key="entry-{{ $entry->id }}">

                            <div class="absolute inset-0 transition-all duration-200 {{ $entry->watched ? 'brightness-[0.15] saturate-[0.2]' : 'brightness-[0.45] saturate-75' }}"
                                style="background-image: url('{{ $entry->thumbnail_url }}'); background-size: cover; background-position: {{ $entry->thumbnail_position }};"

                            <div class="absolute inset-0"
                                 style="background: linear-gradient(90deg, rgba(8,10,15,0.85) 0%, rgba(8,10,15,0.40) 60%, transparent 100%);"></div>

                            <div class="relative w-[52px] text-center shrink-0">
                                <span class="font-['Exo_2'] text-xs font-bold tracking-wide {{ $entry->watched ? 'text-[#1f2a35]' : 'text-[#556070]' }}">
                                    {{ str_pad($entry->order, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>

                            <div class="relative w-px h-8 bg-[#1a2030] shrink-0"></div>

                            <button class="relative flex-1 px-4 min-w-0 text-left bg-transparent border-none cursor-pointer"
                                    wire:click="toggleExpanded({{ $entry->id }})">
                                <div class="text-xs tracking-[1.5px] uppercase {{ $entry->watched ? 'text-[#1a2530]' : 'text-[#556070]' }} mb-0.5">
                                    @if($entry->type === 'series')
                                        {{ $entry->series_name }} · S{{ $entry->season }} E{{ $entry->episode }}
                                    @else
                                        Film
                                    @endif
                                </div>
                                <div class="font-['Exo_2'] text-base font-semibold tracking-wide truncate transition-colors duration-200 {{ $entry->watched ? 'text-[#2a3545]' : 'text-[#f0ece0]' }}">
                                    {{ $entry->title }}
                                </div>
                                <div class="text-xs text-[#556070] mt-0.5">
                                    {{ $entry->timeline }} · {{ $entry->formatted_duration }}
                                </div>
                            </button>

                            <div class="relative flex items-center gap-1.5 px-4 shrink-0 {{ $entry->watched ? 'opacity-20' : '' }}">
                                <span class="w-1.5 h-1.5 rounded-full shrink-0
                                    {{ $entry->recommendation === 'must' ? 'bg-[#c9a227]' : ($entry->recommendation === 'recommended' ? 'bg-[#4a9eca]' : 'bg-[#556070]') }}">
                                </span>
                                <span class="text-xs tracking-[1.5px] uppercase font-semibold whitespace-nowrap
                                    {{ $entry->recommendation === 'must' ? 'text-[#c9a227]' : ($entry->recommendation === 'recommended' ? 'text-[#4a9eca]' : 'text-[#556070]') }}">
                                    @if($entry->recommendation === 'must') Must watch
                                    @elseif($entry->recommendation === 'recommended') Recommended
                                    @else Could skip
                                    @endif
                                </span>
                            </div>

                            <div class="relative w-px h-8 bg-[#1a2030] shrink-0"></div>

                            <button class="relative w-[52px] h-full flex items-center justify-center bg-transparent border-none cursor-pointer shrink-0 group"
                                    wire:click="toggleWatched({{ $entry->id }})">
                                <div class="w-[22px] h-[22px] rounded-full border flex items-center justify-center transition-all duration-200
                                    {{ $entry->watched ? 'bg-[#c9a227] border-[#c9a227]' : 'border-[#556070] group-hover:border-[#c9a227]' }}">
                                    @if($entry->watched)
                                        <svg class="w-2.5 h-2.5" viewBox="0 0 10 10" fill="none">
                                            <polyline points="1.5,5 4,7.5 8.5,2.5"
                                                      stroke="#0a0c10" stroke-width="1.5"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    @endif
                                </div>
                            </button>
                        </div>

                        @if($expandedId === $entry->id && $entry->synopsis)
                            <div class="bg-[#0d1018] border border-[#1a2030] border-t-0 rounded-b-md px-5 py-3.5 -mt-1.5 mb-1.5 pl-[70px]"
                                 wire:key="synopsis-{{ $entry->id }}">
                                <p class="text-sm text-[#8a9aaa] leading-relaxed italic">{{ $entry->synopsis }}</p>
                            </div>
                        @endif

                    @endforeach
                </div>
            @empty
                <div class="text-center py-12 text-[#556070] text-sm tracking-wide">
                    No entries match your filters.
                </div>
            @endforelse
        </div>

        {{-- Legend --}}
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
        </div>
    </div>
</div>