<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('leaderboard.index') }}"
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        RANKINGS
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        STATISTICS
                    </div>
                </div>
            </div>

            <!-- Main Header Content -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div
                        class="size-16 rounded-[1.5rem] bg-primary shadow-2xl shadow-primary/20 flex items-center justify-center text-primary-content shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 21l8 0" />
                            <path d="M12 17l0 4" />
                            <path d="M7 4l10 0" />
                            <path d="M17 4v8a5 5 0 0 1 -10 0v-8" />
                            <path d="M5 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M19 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Leaderboard</h1>
                        <p class="text-[13px] text-base-content/50 font-bold">
                            Track project performance and squad contributions.
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="px-5 py-3 bg-white rounded-2xl border border-base-content/5 shadow-sm">
                        <span
                            class="text-[9px] font-bold uppercase tracking-widest text-base-content/30 block leading-none mb-1.5">Participants</span>
                        <span class="text-sm font-bold text-base-content leading-none">{{ $participantsCount ?? 0 }}
                            Members Ranked</span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-10">
        {{-- Filter Section (Now on Top) --}}
        <div class="card bg-base-100 border border-base-content/10 shadow-md rounded-2xl overflow-hidden">
            <div class="card-body p-6">
                <form method="GET" action="{{ route('leaderboard.index') }}" id="filterForm"
                    class="flex flex-col md:flex-row gap-4 items-start md:items-end">
                    <div class="form-control w-full md:w-48">
                        <label class="label pb-1">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-primary italic">View
                                Range</span>
                        </label>
                        <select name="view" id="viewSelect"
                            class="select select-bordered select-sm h-11 w-full bg-base-200/50 border-none rounded-xl focus:ring-2 focus:ring-primary/20 font-bold transition-all"
                            onchange="handleViewChange()">
                            <option value="monthly" {{ $view === 'monthly' ? 'selected' : '' }}>📅 Monthly</option>
                            <option value="weekly" {{ $view === 'weekly' ? 'selected' : '' }}>📆 Weekly</option>
                            <option value="all-time" {{ $view === 'all-time' ? 'selected' : '' }}>🌟 All Time</option>
                        </select>
                    </div>

                    <div class="form-control w-full md:w-56" id="monthPickerContainer"
                        style="display: {{ $view === 'monthly' ? 'block' : 'none' }}">
                        <label class="label pb-1">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-primary italic">Registry
                                Month</span>
                        </label>
                        <input type="month" name="month" id="monthPicker" value="{{ $month }}"
                            class="input input-bordered input-sm h-11 w-full bg-base-200/50 border-none rounded-xl focus:ring-2 focus:ring-primary/20 font-bold transition-all"
                            onchange="document.getElementById('filterForm').submit()">
                    </div>
                </form>

                <div
                    class="mt-4 p-4 bg-primary/5 rounded-2xl border border-primary/10 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 7v5l3 3" />
                        </svg>
                        <p class="text-xs font-bold text-primary italic uppercase tracking-widest">
                            Processing performance for: <span
                                class="text-base-content opacity-60">{{ $periodText }}</span>
                        </p>
                    </div>
                    <div class="hidden md:flex items-center gap-2">
                        <div class="size-2 rounded-full bg-success animate-pulse"></div>
                        <span class="text-[9px] font-bold text-success uppercase tracking-tighter">Live Dataset</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Elite Podium Section --}}
        @if($topThree && $topThree->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-end max-w-5xl mx-auto pt-10">
                {{-- 2nd Place --}}
                @if(isset($topThree[1]))
                    <div class="order-2 md:order-1">
                        <div class="flex flex-col items-center text-center">
                            <div class="relative mb-6">
                                <div class="size-24 rounded-3xl overflow-hidden ring-4 ring-slate-200/50 shadow-2xl">
                                    <img src="{{ $topThree[1]['user']->profile_photo_url }}" class="w-full h-full object-cover">
                                </div>
                                <div
                                    class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-slate-400 text-white font-black text-xs px-3 py-1 rounded-full shadow-lg">
                                    2nd</div>
                            </div>
                            <h3 class="font-bold text-base-content text-lg leading-tight uppercase tracking-tight">
                                {{ $topThree[1]['user']->name }}
                            </h3>
                            <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-[0.2em] mt-2">
                                {{ number_format($topThree[1]['total_points']) }} XP EARNED
                            </p>

                            {{-- Podium Stats (Added) --}}
                            <div class="flex items-center gap-4 mt-3 opacity-60">
                                <div class="flex flex-col items-center">
                                    <span
                                        class="text-[10px] font-black text-base-content">{{ $topThree[1]['tasks_completed'] }}</span>
                                    <span
                                        class="text-[8px] font-bold text-base-content/40 uppercase tracking-tighter">Tasks</span>
                                </div>
                                <div class="w-px h-4 bg-base-content/10"></div>
                                <div class="flex flex-col items-center">
                                    <span
                                        class="text-[10px] font-black text-base-content">{{ $topThree[1]['tickets_completed'] }}</span>
                                    <span
                                        class="text-[8px] font-bold text-base-content/40 uppercase tracking-tighter">Tickets</span>
                                </div>
                                <div class="w-px h-4 bg-base-content/10"></div>
                                <div class="flex flex-col items-center">
                                    <span class="text-[10px] font-black text-base-content">{{ $topThree[1]['remarks'] }}</span>
                                    <span
                                        class="text-[8px] font-bold text-base-content/40 uppercase tracking-tighter">Remarks</span>
                                </div>
                            </div>

                            <div
                                class="w-full h-32 bg-slate-400/10 border-x border-t border-slate-400/20 rounded-t-3xl mt-6 flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-10 text-slate-400 opacity-20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                                    <path d="M12 15l3.4 5.89l1.59 -3.23l3.51 .05l-2.5 -4.71" />
                                    <path d="M12 15l-3.4 5.89l-1.59 -3.23l-3.51 .05l2.5 -4.71" />
                                    <path d="M10 9l2 2l4 -4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- 1st Place --}}
                @if(isset($topThree[0]))
                    <div class="order-1 md:order-2">
                        <div class="flex flex-col items-center text-center">
                            <div class="relative mb-8 scale-110">
                                <div class="absolute -top-8 left-1/2 -translate-x-1/2 animate-bounce">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-10 text-amber-400" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z" />
                                    </svg>
                                </div>
                                <div
                                    class="size-32 rounded-[2rem] overflow-hidden ring-4 ring-amber-400/50 shadow-[0_20px_50px_rgba(251,191,36,0.2)]">
                                    <img src="{{ $topThree[0]['user']->profile_photo_url }}" class="w-full h-full object-cover">
                                </div>
                                <div
                                    class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-amber-400 text-amber-900 font-black text-sm px-5 py-1.5 rounded-full shadow-xl">
                                    1st</div>
                            </div>
                            <h3 class="font-black text-base-content text-2xl leading-tight uppercase tracking-tighter">
                                {{ $topThree[0]['user']->name }}
                            </h3>
                            <p class="text-xs font-bold text-amber-500 uppercase tracking-[0.2em] mt-2">
                                {{ number_format($topThree[0]['total_points']) }} XP EARNED
                            </p>

                            {{-- Podium Stats (Added) --}}
                            <div class="flex items-center gap-6 mt-4">
                                <div class="flex flex-col items-center">
                                    <span
                                        class="text-xs font-black text-base-content">{{ $topThree[0]['tasks_completed'] }}</span>
                                    <span
                                        class="text-[9px] font-bold text-base-content/40 uppercase tracking-tighter">Tasks</span>
                                </div>
                                <div class="w-px h-6 bg-base-content/10"></div>
                                <div class="flex flex-col items-center">
                                    <span
                                        class="text-xs font-black text-base-content">{{ $topThree[0]['tickets_completed'] }}</span>
                                    <span
                                        class="text-[9px] font-bold text-base-content/40 uppercase tracking-tighter">Tickets</span>
                                </div>
                                <div class="w-px h-6 bg-base-content/10"></div>
                                <div class="flex flex-col items-center">
                                    <span class="text-xs font-black text-base-content">{{ $topThree[0]['remarks'] }}</span>
                                    <span
                                        class="text-[9px] font-bold text-base-content/40 uppercase tracking-tighter">Remarks</span>
                                </div>
                            </div>

                            <div
                                class="w-full h-48 bg-amber-400/10 border-x border-t border-amber-400/20 rounded-t-[3rem] mt-8 flex flex-col items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-t from-amber-400/5 to-transparent"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-16 text-amber-400 opacity-40"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 21l8 0" />
                                    <path d="M12 17l0 4" />
                                    <path d="M7 4l10 0" />
                                    <path d="M17 4v8a5 5 0 0 1 -10 0v-8" />
                                    <path d="M5 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M19 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- 3rd Place --}}
                @if(isset($topThree[2]))
                    <div class="order-3 md:order-3">
                        <div class="flex flex-col items-center text-center">
                            <div class="relative mb-6">
                                <div class="size-20 rounded-3xl overflow-hidden ring-4 ring-orange-200/50 shadow-xl">
                                    <img src="{{ $topThree[2]['user']->profile_photo_url }}" class="w-full h-full object-cover">
                                </div>
                                <div
                                    class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-orange-400 text-white font-black text-xs px-3 py-1 rounded-full shadow-lg">
                                    3rd</div>
                            </div>
                            <h3 class="font-bold text-base-content text-base leading-tight uppercase tracking-tight">
                                {{ $topThree[2]['user']->name }}
                            </h3>
                            <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-[0.2em] mt-2">
                                {{ number_format($topThree[2]['total_points']) }} XP EARNED
                            </p>

                            {{-- Podium Stats (Added) --}}
                            <div class="flex items-center gap-4 mt-3 opacity-60">
                                <div class="flex flex-col items-center">
                                    <span
                                        class="text-[10px] font-black text-base-content">{{ $topThree[2]['tasks_completed'] }}</span>
                                    <span
                                        class="text-[8px] font-bold text-base-content/40 uppercase tracking-tighter">Tasks</span>
                                </div>
                                <div class="w-px h-4 bg-base-content/10"></div>
                                <div class="flex flex-col items-center">
                                    <span
                                        class="text-[10px] font-black text-base-content">{{ $topThree[2]['tickets_completed'] }}</span>
                                    <span
                                        class="text-[8px] font-bold text-base-content/40 uppercase tracking-tighter">Tickets</span>
                                </div>
                                <div class="w-px h-4 bg-base-content/10"></div>
                                <div class="flex flex-col items-center">
                                    <span class="text-[10px] font-black text-base-content">{{ $topThree[2]['remarks'] }}</span>
                                    <span
                                        class="text-[8px] font-bold text-base-content/40 uppercase tracking-tighter">Remarks</span>
                                </div>
                            </div>
                            <div
                                class="w-full h-24 bg-orange-400/10 border-x border-t border-orange-400/20 rounded-t-3xl mt-6 flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-8 text-orange-400 opacity-20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 4v10" />
                                    <path d="M12 14a4 4 0 1 0 0 8a4 4 0 0 0 0 -8z" />
                                    <path d="M12 14l4 -4l4 4" />
                                    <path d="M12 14l-4 -4l-4 4" />
                                    <path d="M16 4l-4 4l-4 -4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        {{-- Main Rankings List (Screenshot Match) --}}
        <div class="card bg-base-100 border border-base-content/10 shadow-xl rounded-2xl overflow-hidden mt-8">
            {{-- Card Header --}}
            <div class="px-8 py-6 border-b border-base-content/5 flex items-center justify-between bg-base-200/20">
                <div class="flex items-center gap-3">
                    <div class="size-6 bg-primary/10 rounded-md flex items-center justify-center text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 6h9" />
                            <path d="M11 12h9" />
                            <path d="M11 18h9" />
                            <path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" />
                            <path d="M4 10a2 2 0 1 0 4 0c0 -1 -1 -1.5 -2 -2h2" />
                            <path d="M6 3v3" />
                            <path d="M4 3a2 2 0 0 1 2 2v1" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-black text-base-content uppercase tracking-widest">All Rankings</h3>
                </div>
                <div class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest">
                    {{ $participantsCount }} participants
                </div>
            </div>

            <div class="divide-y divide-base-content/5">
                @php
                    $highestPoints = count($rankings) > 0 ? $rankings[0]['total_points'] : 0;
                @endphp
                @forelse ($rankings as $index => $entry)
                    @if($index < 3) @continue @endif
                    <div
                        class="px-8 py-6 hover:bg-base-200/30 transition-all group flex items-center justify-between {{ auth()->id() === $entry['user']->id ? 'bg-primary/[0.02]' : '' }}">
                        <div class="flex items-center gap-8">
                            {{-- Rank Number --}}
                            <div class="w-10 text-center">
                                <span class="text-sm font-black text-base-content/20">#{{ $index + 1 }}</span>
                            </div>

                            {{-- Member Info --}}
                            <div class="flex items-center gap-5">
                                <div class="avatar">
                                    <div
                                        class="size-14 rounded-full ring-2 ring-base-content/5 group-hover:ring-primary/20 transition-all overflow-hidden p-0.5">
                                        <img src="{{ $entry['user']->profile_photo_url }}"
                                            class="rounded-full object-cover">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div
                                        class="font-black text-base-content text-sm uppercase tracking-tight group-hover:text-primary transition-colors flex items-center gap-3">
                                        {{ $entry['user']->name }}
                                        @if(auth()->id() === $entry['user']->id)
                                            <span
                                                class="badge badge-primary badge-xs py-1.5 px-2 font-black text-[8px] tracking-tighter uppercase">YOU</span>
                                        @endif
                                    </div>

                                    {{-- Sub Stats Grid --}}
                                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                                        <div class="flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 text-primary/40"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 11l3 3l8 -8" />
                                                <path
                                                    d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                            </svg>
                                            <span
                                                class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest"><span
                                                    class="text-base-content">{{ $entry['tasks_completed'] }}</span>
                                                tasks</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 text-amber-500/40"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M15 5l0 2" />
                                                <path d="M15 11l0 2" />
                                                <path d="M15 17l0 2" />
                                                <path
                                                    d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                                            </svg>
                                            <span
                                                class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest"><span
                                                    class="text-base-content">{{ $entry['tickets_completed'] }}</span>
                                                tickets</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 text-info/40"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                                                <path d="M12 12l0 .01" />
                                                <path d="M9 12l0 .01" />
                                                <path d="M15 12l0 .01" />
                                            </svg>
                                            <span
                                                class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest"><span
                                                    class="text-base-content">{{ $entry['remarks'] }}</span> remarks</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Total Points --}}
                        <div class="flex flex-col items-end">
                            <div class="flex flex-col items-end">
                                <span
                                    class="text-2xl font-black text-base-content tracking-tighter leading-none">{{ number_format($entry['total_points']) }}</span>
                                <span
                                    class="text-[9px] font-bold uppercase tracking-widest text-base-content/20 mt-1">Points</span>
                            </div>
                            @if($index > 0)
                                <div class="text-[9px] font-bold text-base-content/30 mt-1 uppercase tracking-tighter">
                                    -{{ number_format($highestPoints - $entry['total_points']) }} from #1
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-32 text-center opacity-25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-16 mb-4 block mx-auto" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            <path d="M14.5 16.05a3.5 3.5 0 0 0 -5 0" />
                            <path d="M9 10l.01 0" />
                            <path d="M15 10l.01 0" />
                        </svg>
                        <p class="font-black uppercase tracking-[0.3em] text-xs">Awaiting data initialization</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function handleViewChange() {
                const select = document.getElementById('viewSelect');
                const monthPicker = document.getElementById('monthPickerContainer');
                if (select.value === 'monthly') {
                    monthPicker.style.display = 'block';
                } else {
                    monthPicker.style.display = 'none';
                    document.getElementById('filterForm').submit();
                }
            }
        </script>
    @endpush
</x-app-layout>