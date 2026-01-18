@extends('layouts.app')

@section('content')
    <!-- Dashboard Header -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-base-content">
                Welcome back, {{ auth()->user()->name }}!
            </h1>
            <p class="text-base-content/60 mt-1">
                Here's what's happening with your projects today.
            </p>
        </div>
        <div class="text-end hidden sm:block">
            <p class="text-sm font-medium text-base-content/50 uppercase tracking-widest">{{ now()->format('l, F j, Y') }}</p>
        </div>
    </div>

    <!-- Announcements Slider Section -->
    @if($announcements->count() > 0)
        <!-- Push Swiper Assets -->
        @push('styles')
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
            <style>
                .announcement-swiper {
                    padding: 0 0 50px 0 !important;
                    overflow: visible !important;
                }
                .announcement-card {
                    background: #ffffff;
                    border-radius: 28px;
                    border: 1px solid rgba(0,0,0,0.04);
                    box-shadow: 0 10px 30px -10px rgba(0,0,0,0.04);
                    overflow: hidden;
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                }
                .announcement-swiper .swiper-pagination {
                    bottom: 0px !important;
                    display: flex;
                    justify-content: center;
                    gap: 10px;
                }
                .announcement-swiper .swiper-pagination-bullet {
                    width: 32px;
                    height: 5px;
                    border-radius: 10px;
                    background: #e2e8f0;
                    opacity: 1;
                    transition: all 0.3s ease;
                    margin: 0 !important;
                }
                .announcement-swiper .swiper-pagination-bullet-active {
                    background: #3b82f6;
                    width: 50px;
                }
                .nav-btn {
                    width: 48px;
                    height: 48px;
                    border-radius: 50%;
                    background: #ffffff;
                    border: 1px solid #f1f5f9;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
                    color: #64748b;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    position: absolute;
                    top: 50%;
                    transform: translateY(-50%);
                    z-index: 30;
                    transition: all 0.3s ease;
                    cursor: pointer;
                }
                .nav-btn:hover {
                    background: #3b82f6;
                    color: #ffffff;
                    border-color: #3b82f6;
                    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.25);
                    transform: translateY(-50%) scale(1.05);
                }
                .nav-btn-prev { left: 10px; }
                .nav-btn-next { right: 10px; }
                .nav-btn.swiper-button-disabled {
                    opacity: 0;
                    pointer-events: none;
                }
                @media (max-width: 1024px) {
                    .nav-btn { display: none; }
                }
            </style>
        @endpush

        <div class="mb-10 relative max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6 flex flex-col gap-1">
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Announcements</h2>
                <div class="h-1 w-12 bg-blue-500 rounded-full"></div>
            </div>

            <div class="relative px-2 sm:px-0">
                <div class="swiper announcement-swiper">
                    <div class="swiper-wrapper">
                        @foreach($announcements as $announcement)
                            <div class="swiper-slide h-auto">
                                <div class="announcement-card h-full p-8 sm:p-12">
                                    <div class="flex flex-col lg:flex-row gap-8 items-center">
                                        
                                        <!-- LEFT COLUMN: Information Panel -->
                                        <div class="flex-1 flex flex-col justify-center gap-6 text-left order-last lg:order-first min-w-0 w-full">
                                            <!-- Top Badges -->
                                            <div class="flex items-center gap-3">
                                                @if($announcement->type === 'success')
                                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest border shadow-sm"
                                                          style="background-color: #f0fdf4; color: #15803d; border-color: #dcfce7;">
                                                        <div class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #22c55e;"></div>
                                                        Success
                                                    </span>
                                                @elseif($announcement->type === 'warning')
                                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest border shadow-sm"
                                                          style="background-color: #fefce8; color: #a16207; border-color: #fef9c3;">
                                                        <div class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #eab308;"></div>
                                                        Warning
                                                    </span>
                                                @elseif($announcement->type === 'error')
                                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest border shadow-sm"
                                                          style="background-color: #fef2f2; color: #b91c1c; border-color: #fee2e2;">
                                                        <div class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #ef4444;"></div>
                                                        Critical
                                                    </span>
                                                @else
                                                    <!-- Default / Info -->
                                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest border shadow-sm"
                                                          style="background-color: #eff6ff; color: #1d4ed8; border-color: #dbeafe;">
                                                        <div class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #3b82f6;"></div>
                                                        Information
                                                    </span>
                                                @endif
                                                <span class="inline-flex px-3 py-1.5 bg-slate-50 text-slate-500 rounded-lg text-[10px] font-black uppercase tracking-widest border border-slate-100 shadow-sm">
                                                    {{ $announcement->created_at->format('M d, Y') }}
                                                </span>
                                            </div>

                                            <!-- Content Body -->
                                            <div class="space-y-3">
                                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-800 tracking-tight leading-tight transition-colors hover:text-blue-600 cursor-default line-clamp-2">
                                                    {{ $announcement->title }}
                                                </h3>
                                                <p class="text-slate-500 text-base leading-relaxed line-clamp-3 font-medium max-w-3xl">
                                                    {{ $announcement->content }}
                                                </p>
                                            </div>

                                            <!-- Link & Meta -->
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-5 pt-1">
                                                <a href="{{ route('announcements.index') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 border-none text-white px-6 h-10 rounded-lg flex items-center justify-center gap-2 w-fit font-black text-[10px] uppercase tracking-widest transition-all shadow-md shadow-blue-500/20 active:scale-95 group">
                                                    Read More
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" /></svg>
                                                </a>
                                                <div class="flex items-center gap-2 text-slate-400">
                                                    <div class="p-1 bg-slate-100 rounded-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 7l0 5l3 3" /></svg>
                                                    </div>
                                                    <span class="text-[9px] font-black uppercase tracking-widest opacity-60">Posted {{ $announcement->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- RIGHT COLUMN: Poster Panel (Strict Fixed Dimensions - Moderate Size) -->
                                        <div class="shrink-0 order-first lg:order-last">
                                            <!-- Unified Strict Container -->
                                            <div class="relative rounded-2xl overflow-hidden shadow-lg border border-slate-100 group bg-slate-50" 
                                                 style="width: 280px; height: 180px; min-width: 280px; max-width: 280px;">
                                                
                                                @if($announcement->image_path)
                                                    <img src="{{ Storage::url($announcement->image_path) }}" 
                                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                                        alt="Broadcast Image">
                                                @else
                                                    <div class="absolute inset-0 w-full h-full border-2 border-dashed border-slate-200 bg-slate-50/50 flex flex-col items-center justify-center gap-3 text-slate-300 transition-colors hover:border-blue-200 hover:bg-blue-50/30">
                                                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 transition-transform group-hover:scale-110 group-hover:text-blue-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 8h.01" /><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" /></svg>
                                                        </div>
                                                        <span class="text-[9px] font-black uppercase tracking-widest opacity-60 group-hover:text-blue-400">No poster available</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Slider Navigation -->
                <div class="nav-btn nav-btn-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 6l-6 6l6 6" /></svg>
                </div>
                <div class="nav-btn nav-btn-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg>
                </div>

                <!-- Slider Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const swiper = new Swiper('.announcement-swiper', {
                        slidesPerView: 1,
                        loop: true,
                        autoplay: {
                            delay: 4000,
                            disableOnInteraction: false,
                            pauseOnMouseEnter: true,
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.nav-btn-next',
                            prevEl: '.nav-btn-prev',
                        },
                        effect: 'slide',
                        speed: 1200,
                        grabCursor: true,
                        spaceBetween: 30,
                    });
                });
            </script>
        @endpush
    @endif

    <!-- Base Layout Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl">
            <div class="card-body p-5 flex flex-row items-center gap-4">
                <div class="size-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>
                </div>
                <div>
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-base-content/40">Projects</h3>
                    <p class="text-2xl font-black text-base-content leading-none mt-1">{{ $totalProjects }}</p>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl">
            <div class="card-body p-5 flex flex-row items-center gap-4">
                <div class="size-12 rounded-xl bg-success/10 text-success flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2l4-4" /><circle cx="12" cy="12" r="9" /></svg>
                </div>
                <div>
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-base-content/40">Active</h3>
                    <p class="text-2xl font-black text-base-content leading-none mt-1">{{ $activeProjects }}</p>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl">
            <div class="card-body p-5 flex flex-row items-center gap-4">
                <div class="size-12 rounded-xl bg-warning/10 text-warning flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v2" /><path d="M12 20v2" /><path d="M4.93 4.93l1.41 1.41" /><path d="M17.66 17.66l1.41 1.41" /><path d="M2 12h2" /><path d="M20 12h2" /><path d="M6.34 17.66l-1.41 1.41" /><path d="M19.07 4.93l-1.41 1.41" /></svg>
                </div>
                <div>
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-base-content/40">Tasks</h3>
                    <p class="text-2xl font-black text-base-content leading-none mt-1">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl">
            <div class="card-body p-5 flex flex-row items-center gap-4">
                <div class="size-12 rounded-xl bg-error/10 text-error flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                </div>
                <div>
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-base-content/40">Pending</h3>
                    <p class="text-2xl font-black text-base-content leading-none mt-1">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Recent Projects Table -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between px-1">
                <div class="flex items-center gap-3">
                    <div class="size-2 rounded-full bg-primary shadow-sm"></div>
                    <h2 class="text-[10px] font-black uppercase tracking-widest text-base-content/40 italic">Recent Projects</h2>
                </div>
                <a href="{{ route('projects.index') }}" class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">All Projects</a>
            </div>
            <div class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl overflow-hidden">
                <div class="card-body p-0">
                    <div class="overflow-x-auto">
                        <table class="table table-hover align-middle">
                            <thead class="bg-base-200/20 text-base-content/40 uppercase text-[10px] font-black tracking-widest">
                                <tr>
                                    <th class="py-4 px-6">Project Name</th>
                                    <th class="py-4 px-4 text-center">Status</th>
                                    <th class="py-4 px-4 text-end">Created</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse($recentProjects as $project)
                                    <tr class="group hover:bg-base-200/30 transition-all border-b border-base-content/5">
                                        <td class="py-4 px-6">
                                            <a href="{{ route('projects.show', $project) }}" class="font-black text-base-content group-hover:text-primary transition-colors tracking-tight uppercase">
                                                {{ $project->name }}
                                            </a>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            @include('projects.partials.status-badge', ['status' => $project->status])
                                        </td>
                                        <td class="py-4 px-6 text-end text-xs font-medium text-base-content/40 italic">
                                            {{ $project->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-12 text-center text-base-content/30 italic font-medium">No recent projects found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Tasks Sidebar -->
        <div class="space-y-4">
            <div class="flex items-center gap-3 px-1">
                <div class="size-2 rounded-full bg-warning shadow-sm"></div>
                <h2 class="text-[10px] font-black uppercase tracking-widest text-base-content/40 italic">Upcoming Tasks</h2>
            </div>
            <div class="space-y-3">
                @forelse($upcomingTasks as $task)
                    <a href="{{ route('tasks.show', $task) }}" class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl hover:translate-x-1 transition-all group">
                        <div class="card-body p-4 flex flex-col gap-2">
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-black text-primary/60 uppercase tracking-widest truncate max-w-[120px]">{{ $task->project->name }}</span>
                                <span class="badge badge-warning badge-outline badge-xs text-[8px] font-black px-1.5">{{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}</span>
                            </div>
                            <h4 class="font-bold text-base-content tracking-tight leading-tight group-hover:text-primary transition-colors">{{ $task->title }}</h4>
                        </div>
                    </a>
                @empty
                    <div class="card bg-base-200/10 border border-dashed border-base-content/10 rounded-2xl p-10 text-center">
                        <p class="text-[10px] font-black text-base-content/20 uppercase tracking-widest">No pending tasks</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection