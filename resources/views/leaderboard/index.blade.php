@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        {{-- Modern Header Section - Absolute Match with Announcements --}}
        <div class="mb-10 pl-1">
            <div class="flex flex-col space-y-4">
                {{-- Breadcrumbs / Badge Header --}}
                <div class="flex items-center gap-3">
                    <div class="badge badge-lg font-bold text-[10px] uppercase tracking-widest border-0" 
                         style="background-color: rgba(124, 58, 237, 0.1); color: #7c3aed; height: 1.75rem; padding: 0 0.75rem;">
                        Performance</div>
                    <div class="h-4 w-px" style="background-color: rgba(15, 23, 42, 0.1);"></div>
                    <span class="text-[10px] font-bold uppercase tracking-widest" style="color: rgba(15, 23, 42, 0.4);">
                        Stats & Rankings</span>
                </div>

                {{-- Main Title & Icon --}}
                <div class="flex items-center gap-4">
                    <div class="size-12 rounded-2xl flex items-center justify-center" 
                         style="background-color: #7c3aed; box-shadow: 0 10px 15px -3px rgba(124, 58, 237, 0.3);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6 test-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #ffffff;">
                            <path d="M6 9h6v6h-6z" />
                            <path d="M18 9h-3v6h3z" />
                            <path d="M12 3l-9 4.5v3l9 4.5l9 -4.5v-3z" />
                            <path d="M12 15v6" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight leading-tight" style="color: #0f172a;">Leaderboard</h1>
                        <p class="text-sm font-medium mt-0.5" style="color: rgba(15, 23, 42, 0.6);">
                            Recognizing the excellence and dedication of our top team members.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Filter Section - Standardized --}}
        <div class="card bg-white border-2 border-slate-200 shadow-md rounded-2xl overflow-hidden">
            <div class="card-body p-6">
                <form method="GET" action="{{ route('leaderboard.index') }}" id="filterForm"
                    class="flex flex-col md:flex-row gap-4 items-start md:items-end">
                    {{-- View Type Dropdown --}}
                    <div class="form-control w-full md:w-48">
                        <label class="label pb-1">
                            <span
                                class="label-text text-xs font-black uppercase tracking-wider text-blue-700 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M12 7v5l3 3" />
                                </svg>
                                View
                            </span>
                        </label>
                        <select name="view" id="viewSelect"
                            class="select select-bordered select-sm h-11 w-full bg-slate-50 border-slate-200 focus:border-slate-400 font-semibold transition-all"
                            onchange="handleViewChange()">
                            <option value="monthly" {{ $view === 'monthly' ? 'selected' : '' }}>📅 Monthly</option>
                            <option value="weekly" {{ $view === 'weekly' ? 'selected' : '' }}>📆 Weekly</option>
                            <option value="all-time" {{ $view === 'all-time' ? 'selected' : '' }}>🌟 All Time</option>
                        </select>
                    </div>

                    {{-- Month Picker (only show for monthly view) --}}
                    <div class="form-control w-full md:w-56" id="monthPickerContainer"
                        style="display: {{ $view === 'monthly' ? 'block' : 'none' }}">
                        <label class="label pb-1">
                            <span
                                class="label-text text-xs font-black uppercase tracking-wider text-blue-700 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <path d="M16 2v4M8 2v4M3 10h18" />
                                </svg>
                                Month
                            </span>
                        </label>
                        <input type="month" name="month" id="monthPicker" value="{{ $month }}"
                            class="input input-bordered input-sm h-11 w-full bg-slate-50 border-slate-200 focus:border-slate-400 font-semibold transition-all"
                            onchange="document.getElementById('filterForm').submit()">
                    </div>

                    {{-- Submit Button (hidden, auto-submit on change) --}}
                    <button type="submit" class="hidden">Filter</button>
                </form>

                {{-- Period Display --}}
                <div
                    class="mt-4 flex items-center gap-2 text-sm bg-white/60 backdrop-blur-sm rounded-lg px-4 py-2 border border-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-blue-600" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 6v6l4 2" />
                    </svg>
                    <span class="text-blue-700 font-semibold">Showing leaderboard for: <span
                            class="font-black text-blue-900">{{ $periodText }}</span></span>
                </div>
            </div>
        </div>

        {{-- Your Performance Card - Standardized --}}
        @if($myStats)
            <div class="relative overflow-hidden rounded-2xl bg-white border-2 border-slate-200 shadow-md p-5 mb-6">
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="size-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-900 border border-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-slate-400" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-black uppercase tracking-widest text-slate-900">Your Performance</h3>
                    </div>
                    <div class="flex flex-wrap gap-3 items-end">
                        <div class="bg-white rounded-xl px-5 py-3 border border-slate-100 shadow-sm min-w-[140px]">
                            <div class="text-[9px] font-black uppercase tracking-[0.15em] text-slate-400 mb-1">Your Rank</div>
                            <div class="text-3xl font-black text-slate-900 leading-none">#{{ $myRank }}</div>
                        </div>
                        <div class="bg-white rounded-xl px-5 py-3 border border-slate-100 shadow-sm min-w-[140px]">
                            <div class="text-[9px] font-black uppercase tracking-[0.15em] text-slate-400 mb-1">Total Points</div>
                            <div class="text-3xl font-black text-slate-900 leading-none">{{ $myStats['total_points'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Top Performers Section --}}
        <div class="space-y-6">
            {{-- Section Title - Standardized --}}
            <div
                class="relative overflow-hidden rounded-xl bg-white p-4 shadow-md border-2 border-slate-200">
                <div class="absolute inset-0 bg-black/5"></div>
                <div class="relative z-10 flex items-center gap-3">
                    <div
                        class="size-8 bg-black/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-black/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-900" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9h6v6h-6z" />
                            <path d="M18 9h-3v6h3z" />
                            <path d="M12 3l-9 4.5v3l9 4.5l9 -4.5v-3z" />
                            <path d="M12 15v6" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900">🏆 Top Performers</h2>
                </div>
                <div class="absolute -right-8 -top-8 size-32 bg-white/20 rounded-full blur-2xl"></div>
            </div>

            {{-- Podium Container --}}
            <div class="w-full max-w-5xl mx-auto">
                {{-- Desktop: Podium Layout --}}
                <div class="hidden md:flex items-end justify-center gap-6">
                    {{-- #2 Position (Left - Silver) --}}
                    @if($topThree->count() >= 2)
                        @php $second = $topThree[1]; @endphp
                        <div class="flex flex-col items-center w-full max-w-xs">
                            {{-- Performer Card --}}
                            <div class="w-full bg-white rounded-[2.5rem] shadow-xl p-8 mb-3 relative border border-slate-100 min-h-[360px]">
                                {{-- Rank Indicator --}}
                                <div class="absolute top-6 left-6 z-10 flex items-center gap-1.5">
                                    <div class="size-9 rounded-full flex items-center justify-center shadow-md border" style="background-color: #ffffff; color: #0f172a; border-color: #f1f5f9;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="currentColor" style="color: #94a3b8;">
                                            <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z" />
                                        </svg>
                                    </div>
                                    <span class="text-xl font-black text-slate-900">2</span>
                                </div>

                                {{-- Avatar --}}
                                <div class="flex justify-center mt-4 mb-4">
                                    <div class="avatar">
                                        <div class="w-28 h-28 rounded-full border-4 border-slate-50 shadow-inner flex items-center justify-center overflow-hidden" style="background-color: #f1f5f9;">
                                            @if($second['user']->profile_photo_url)
                                                <img src="{{ $second['user']->profile_photo_url }}" alt="{{ $second['user']->name }}" class="object-cover" />
                                            @else
                                                <span class="text-3xl font-black text-slate-400">{{ substr($second['user']->name, 0, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Name --}}
                                <h3 class="text-center font-black text-xs text-slate-600 uppercase tracking-widest px-2 leading-tight mb-1">
                                    {{ $second['user']->name }}</h3>

                                {{-- Points --}}
                                <div class="text-center">
                                    <div class="text-4xl font-black text-slate-900">{{ $second['total_points'] }}</div>
                                    <div class="text-[10px] text-slate-400 uppercase tracking-[0.2em] font-black mt-1">Points</div>
                                </div>

                                {{-- Stats Chips --}}
                                <div class="flex flex-wrap gap-1.5 justify-center mt-6">
                                    <div class="badge h-7 border px-2.5 gap-1.5 rounded-lg shadow-sm" style="background-color: #ecfdf5; color: #065f46; border-color: #10b981;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="color: #10b981;">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span class="font-black text-[11px]">{{ $second['tasks_completed'] }}</span>
                                    </div>
                                    <div class="badge h-7 border px-2.5 gap-1.5 rounded-lg shadow-sm" style="background-color: #fffbeb; color: #92400e; border-color: #f59e0b;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;">
                                            <path d="M2 9V5.2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2V9"></path>
                                            <path d="M2 15v3.8a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V15"></path>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                        </svg>
                                        <span class="font-black text-[11px]">{{ $second['tickets_completed'] }}</span>
                                    </div>
                                    <div class="badge h-7 border px-2.5 gap-1.5 rounded-lg shadow-sm" style="background-color: #eff6ff; color: #1e40af; border-color: #3b82f6;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <span class="font-black text-[11px]">{{ $second['remarks'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- #1 Position (Center - Gold) --}}
                    @if($topThree->count() >= 1)
                        @php $first = $topThree[0]; @endphp
                        <div class="flex flex-col items-center w-full max-w-xs">
                            {{-- Performer Card --}}
                            <div class="w-full bg-white rounded-[2.5rem] shadow-xl p-8 mb-3 relative border-2 border-slate-300 min-h-[360px]">
                                {{-- Rank Indicator --}}
                                <div class="absolute top-6 left-6 z-10 flex items-center gap-2">
                                    <div class="size-11 rounded-full flex items-center justify-center shadow-md border" style="background-color: #fef3c7; color: #d97706; border-color: #fde68a;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V19H7v2h10v-2h-4v-3.1a5.01 5.01 0 0 0 3.61-2.96C19.08 10.63 21 8.55 21 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z" />
                                        </svg>
                                    </div>
                                    <span class="text-3xl font-black text-slate-900">1</span>
                                </div>

                                {{-- Avatar / Initials --}}
                                <div class="flex justify-center mt-6 mb-6">
                                    <div class="avatar shadow-2xl rounded-full">
                                        <div class="w-40 h-40 rounded-full border-[6px] border-white flex items-center justify-center overflow-hidden" style="background-color: #f9a8d4;">
                                            @if($first['user']->profile_photo_url)
                                                <img src="{{ $first['user']->profile_photo_url }}" alt="{{ $first['user']->name }}" class="object-cover" />
                                            @else
                                                <span class="text-5xl font-black text-slate-900">{{ substr($first['user']->name, 0, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Name --}}
                                <h3 class="text-center font-black text-xs text-slate-600 uppercase tracking-widest px-2 leading-tight mb-2">
                                    {{ $first['user']->name }}</h3>

                                {{-- Points --}}
                                <div class="text-center">
                                    <div class="text-5xl font-black text-slate-900">{{ $first['total_points'] }}</div>
                                    <div class="text-[10px] text-slate-400 uppercase tracking-[0.2em] font-black mt-1">Points</div>
                                </div>

                                {{-- Stats Chips --}}
                                <div class="flex flex-wrap gap-1.5 justify-center mt-8">
                                    <div class="badge h-7 border px-3 gap-1.5 rounded-lg shadow-md" style="background-color: #ecfdf5; color: #065f46; border-color: #10b981;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="color: #10b981;">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span class="font-black text-[11px]">{{ $first['tasks_completed'] }}</span>
                                    </div>
                                    <div class="badge h-7 border px-3 gap-1.5 rounded-lg shadow-md" style="background-color: #fffbeb; color: #92400e; border-color: #f59e0b;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;">
                                            <path d="M2 9V5.2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2V9"></path>
                                            <path d="M2 15v3.8a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V15"></path>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                        </svg>
                                        <span class="font-black text-[11px]">{{ $first['tickets_completed'] }}</span>
                                    </div>
                                    <div class="badge h-7 border px-3 gap-1.5 rounded-lg shadow-md" style="background-color: #eff6ff; color: #1e40af; border-color: #3b82f6;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <span class="font-black text-[11px]">{{ $first['remarks'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- #3 Position (Right - Bronze) --}}
                    @if($topThree->count() >= 3)
                        @php $third = $topThree[2]; @endphp
                        <div class="flex flex-col items-center w-full max-w-xs">
                            {{-- Performer Card --}}
                            <div class="w-full bg-white rounded-[2.5rem] shadow-xl p-8 mb-3 relative border border-slate-100 min-h-[360px]">
                                {{-- Rank Indicator --}}
                                <div class="absolute top-6 left-6 z-10 flex items-center gap-1.5">
                                    <div class="size-9 rounded-full flex items-center justify-center shadow-md border" style="background-color: #ffffff; color: #0f172a; border-color: #f1f5f9;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="currentColor" style="color: #f59e0b;">
                                            <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z" />
                                        </svg>
                                    </div>
                                    <span class="text-xl font-black text-slate-900">3</span>
                                </div>

                                {{-- Avatar --}}
                                <div class="flex justify-center mt-4 mb-4">
                                    <div class="avatar">
                                        <div class="w-28 h-28 rounded-full border-4 border-slate-50 shadow-inner flex items-center justify-center overflow-hidden" style="background-color: #ccfbf1;">
                                            @if($third['user']->profile_photo_url)
                                                <img src="{{ $third['user']->profile_photo_url }}" alt="{{ $third['user']->name }}" class="object-cover" />
                                            @else
                                                <span class="text-3xl font-black text-slate-400">{{ substr($third['user']->name, 0, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Name --}}
                                <h3 class="text-center font-black text-xs text-slate-600 uppercase tracking-widest px-2 leading-tight mb-1">{{ $third['user']->name }}</h3>

                                {{-- Points --}}
                                <div class="text-center">
                                    <div class="text-4xl font-black text-slate-900">{{ $third['total_points'] }}</div>
                                    <div class="text-[10px] text-slate-400 uppercase tracking-[0.2em] font-black mt-1">Points</div>
                                </div>

                                {{-- Stats Chips --}}
                                <div class="flex flex-wrap gap-1.5 justify-center mt-6">
                                    <div class="badge h-7 border px-2.5 gap-1.5 rounded-lg shadow-sm" style="background-color: #ecfdf5; color: #065f46; border-color: #10b981;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="color: #10b981;">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span class="font-black text-[11px]">{{ $third['tasks_completed'] }}</span>
                                    </div>
                                    <div class="badge h-7 border px-2.5 gap-1.5 rounded-lg shadow-sm" style="background-color: #fffbeb; color: #92400e; border-color: #f59e0b;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;">
                                            <path d="M2 9V5.2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2V9"></path>
                                            <path d="M2 15v3.8a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V15"></path>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                        </svg>
                                        <span class="font-black text-[11px]">{{ $third['tickets_completed'] }}</span>
                                    </div>
                                    <div class="badge h-7 border px-2.5 gap-1.5 rounded-lg shadow-sm" style="background-color: #eff6ff; color: #1e40af; border-color: #3b82f6;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <span class="font-black text-[11px]">{{ $third['remarks'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Mobile: Stacked Layout --}}
                <div class="md:hidden space-y-4">
                    {{-- #1 First --}}
                    @if($topThree->count() >= 1)
                        @php $first = $topThree[0]; @endphp
                        <div class="bg-white rounded-3xl shadow-xl p-5 relative" style="border: 2px solid #fcd34d;">
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                                <div
                                    class="size-12 rounded-full flex items-center justify-center text-slate-900 font-extrabold text-xl border-4 border-white shadow-lg" style="background-color: #fbbf24;">
                                    1</div>
                            </div>
                            <div class="flex items-center gap-4 mt-6">
                                <div class="avatar">
                                    <div class="w-18 h-18 rounded-full border-4" style="border-color: #fde68a; background-color: #f9a8d4; display: flex; align-items: center; justify-center; overflow: hidden;">
                                        @if($first['user']->profile_photo_url)
                                            <img src="{{ $first['user']->profile_photo_url }}" alt="{{ $first['user']->name }}"
                                                class="object-cover" />
                                        @else
                                            <span class="text-2xl font-black text-slate-900">{{ substr($first['user']->name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-black text-slate-900 uppercase text-xs">{{ $first['user']->name }}</h3>
                                    <div class="text-3xl font-black text-slate-900">{{ $first['total_points'] }} <span
                                            class="text-xs text-slate-500">pts</span></div>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-1.5 mt-3">
                                <div class="badge badge-sm border-0 font-bold" style="background-color: #1e293b; color: #ffffff;">
                                    <span style="color: #10b981; margin-right: 4px;">✓</span> {{ $first['tasks_completed'] }} tasks
                                </div>
                                <div class="badge badge-sm border-0 font-bold" style="background-color: #1e293b; color: #ffffff;">
                                    <span style="color: #f59e0b; margin-right: 4px;">🎫</span> {{ $first['tickets_completed'] }} tickets
                                </div>
                                <div class="badge badge-sm border-0 font-bold" style="background-color: #dbeafe; color: #1d4ed8;">
                                    {{ $first['remarks'] }} remarks
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- #2 Second --}}
                    @if($topThree->count() >= 2)
                        @php $second = $topThree[1]; @endphp
                        <div class="bg-white rounded-3xl shadow-lg p-5 relative" style="border: 2px solid #e2e8f0;">
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                                <div
                                    class="size-10 rounded-full flex items-center justify-center text-slate-900 font-black border-4 border-white shadow-md" style="background-color: #e2e8f0;">
                                    2</div>
                            </div>
                            <div class="flex items-center gap-4 mt-4">
                                <div class="avatar">
                                    <div class="w-16 h-16 rounded-full border-4" style="border-color: #f1f5f9; background-color: #f1f5f9; display: flex; align-items: center; justify-center; overflow: hidden;">
                                        @if($second['user']->profile_photo_url)
                                            <img src="{{ $second['user']->profile_photo_url }}" alt="{{ $second['user']->name }}"
                                                class="object-cover" />
                                        @else
                                            <span class="text-xl font-black text-slate-400">{{ substr($second['user']->name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-black text-slate-900 uppercase text-xs">{{ $second['user']->name }}</h3>
                                    <div class="text-2xl font-black text-slate-900">{{ $second['total_points'] }} <span
                                            class="text-xs text-slate-500">pts</span></div>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-1.5 mt-3">
                                <div class="badge badge-sm border-0 font-bold" style="background-color: #1e293b; color: #ffffff;">
                                    <span style="color: #10b981; margin-right: 4px;">✓</span> {{ $second['tasks_completed'] }} tasks
                                </div>
                                <div class="badge badge-sm border-0 font-bold" style="background-color: #1e293b; color: #ffffff;">
                                    <span style="color: #f59e0b; margin-right: 4px;">🎫</span> {{ $second['tickets_completed'] }} tickets
                                </div>
                                <div class="badge badge-sm border-0 font-bold" style="background-color: #dbeafe; color: #1d4ed8;">
                                    {{ $second['remarks'] }} remarks
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- #3 Third --}}
                    @if($topThree->count() >= 3)
                        @php $third = $topThree[2]; @endphp
                        <div class="bg-white border-2 border-orange-200 rounded-3xl shadow-lg p-5 relative">
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                                <div
                                    class="size-10 rounded-full bg-orange-200 flex items-center justify-center text-orange-900 font-black border-4 border-white shadow-md">
                                    3</div>
                            </div>
                            <div class="flex items-center gap-4 mt-4">
                                <div class="avatar">
                                    <div class="w-16 h-16 rounded-full border-4 border-orange-100">
                                        <img src="{{ $third['user']->profile_photo_url }}" alt="{{ $third['user']->name }}"
                                            class="object-cover" />
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-black text-slate-900 uppercase text-xs">{{ $third['user']->name }}</h3>
                                    <div class="text-2xl font-black text-slate-900">{{ $third['total_points'] }} <span
                                            class="text-xs text-slate-500">pts</span></div>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-1.5 mt-3">
                                <div class="badge badge-sm bg-pink-100 text-pink-700 border-0 font-bold">{{ $third['tasks_completed'] }}
                                    tasks</div>
                                <div class="badge badge-sm bg-amber-100 text-amber-700 border-0 font-bold">
                                    {{ $third['tickets_completed'] }} tickets</div>
                                <div class="badge badge-sm bg-blue-100 text-blue-700 border-0 font-bold">{{ $third['remarks'] }} remarks
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- All Rankings Section --}}
        <div class="card bg-base-100 border-2 border-indigo-200 shadow-xl overflow-hidden">
            <div class="card-body p-0">
                {{-- Header - Enhanced --}}
                <div
                    class="flex items-center justify-between p-5 bg-gradient-to-r from-indigo-300 via-purple-300 to-pink-300 border-b-2 border-indigo-200">
                    <div class="flex items-center gap-3">
                        <div
                            class="size-8 bg-black/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-black/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-900" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M9 12l.01 0" />
                                <path d="M13 12l2 0" />
                                <path d="M9 16l.01 0" />
                                <path d="M13 16l2 0" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900">📊 All Rankings</h3>
                    </div>
                    <div class="badge border font-bold" style="background-color: #eef2ff; color: #4338ca; border-color: #818cf8;">
                        {{ $participantsCount }} participants</div>
                </div>

                {{-- Rankings List --}}
                <div class="divide-y divide-base-content/5">
                    @foreach($rankings->slice(3) as $index => $ranking)
                        @php
                            $rank = $index + 1;
                            $isCurrentUser = $ranking['user']->id === auth()->id();
                            $pointsDiff = $rank > 1 ? $rankings[0]['total_points'] - $ranking['total_points'] : 0;
                        @endphp

                        <div @class([
                            'flex items-center gap-4 p-4 hover:bg-base-200/50 transition-colors',
                            'bg-warning/5 border-l-4 border-warning' => $isCurrentUser
                        ])>
                            {{-- Rank Number --}}
                            <div class="flex-shrink-0 w-12 text-center">
                                <span @class([
                                    'text-lg font-black',
                                    'text-warning' => $rank <= 3,
                                    'text-base-content/50' => $rank > 3
                                ])>#{{ $rank }}</span>
                            </div>

                            {{-- Avatar & Name --}}
                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                <div class="avatar">
                                    <div
                                        class="w-10 h-10 rounded-full ring ring-base-content/10 ring-offset-base-100 ring-offset-1">
                                        <img src="{{ $ranking['user']->profile_photo_url }}"
                                            alt="{{ $ranking['user']->name }}" />
                                    </div>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-black text-slate-900 truncate tracking-tight">{{ $ranking['user']->name }}</h4>
                                    @if($isCurrentUser)
                                        <span class="text-[10px] px-2 py-0.5 rounded-full font-black uppercase tracking-wider border shadow-sm" style="background-color: #fffbeb; color: #92400e; border-color: #f59e0b;">You</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Stats Chips --}}
                            <div class="hidden lg:flex items-center gap-2 flex-wrap">
                                <div class="badge badge-sm border gap-1" style="background-color: #ecfdf5; color: #065f46; border-color: #10b981;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #10b981;">
                                        <path d="M9 11l3 3l8 -8" />
                                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                    </svg>
                                    {{ $ranking['tasks_completed'] }} tasks
                                </div>
                                <div class="badge badge-sm border gap-1" style="background-color: #fffbeb; color: #92400e; border-color: #f59e0b;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;">
                                        <path d="M15 5l0 2" />
                                        <path d="M15 11l0 2" />
                                        <path d="M15 17l0 2" />
                                        <path
                                            d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                                    </svg>
                                    {{ $ranking['tickets_completed'] }} tickets
                                </div>
                                <div class="badge badge-sm border gap-1" style="background-color: #eff6ff; color: #1e40af; border-color: #3b82f6;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;">
                                        <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9z" />
                                        <path d="M12 12l0 .01" />
                                        <path d="M8 12l0 .01" />
                                        <path d="M16 12l0 .01" />
                                    </svg>
                                    {{ $ranking['remarks'] }} remarks
                                </div>
                            </div>

                            {{-- Points & Difference --}}
                            <div class="flex-shrink-0 text-right">
                                <div class="text-2xl font-black text-slate-900 leading-none">{{ $ranking['total_points'] }}</div>
                                <div class="text-[10px] text-slate-500 uppercase tracking-widest font-black mt-1">Points</div>
                                @if($pointsDiff > 0)
                                    <div class="text-[10px] text-red-500 font-bold mt-1">-{{ $pointsDiff }} from #1</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function handleViewChange() {
                const viewSelect = document.getElementById('viewSelect');
                const monthPickerContainer = document.getElementById('monthPickerContainer');
                const filterForm = document.getElementById('filterForm');

                // Show/hide month picker based on view type
                if (viewSelect.value === 'monthly') {
                    monthPickerContainer.style.display = 'block';
                } else {
                    monthPickerContainer.style.display = 'none';
                    // Auto-submit for weekly and all-time
                    filterForm.submit();
                }
            }
        </script>
    @endpush
@endsection