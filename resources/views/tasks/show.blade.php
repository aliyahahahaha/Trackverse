<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Breadcrumbs / Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('tasks.index') }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        TASK HUB
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <a href="{{ route('projects.show', $task->project) }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        {{ strtoupper($task->project->name) }}
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        TASK REGISTRY
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
                            <path d="M9 11l3 3l8 -8" />
                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">{{ $task->name }}
                        </h1>
                        <p class="text-[13px] text-base-content/50 font-bold">
                            Assigned to {{ $task->assignee ? $task->assignee->name : 'Unassigned' }} • Deadline:
                            {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No Date' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @if(!auth()->user()->isDirector())
                        @can('update', $task)
                            <a href="{{ route('tasks.edit', $task) }}"
                                class="btn btn-square bg-base-100 text-base-content/70 border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 size-12 rounded-xl shadow-sm transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                    <path d="M13.5 6.5l4 4" />
                                </svg>
                            </a>
                        @endcan
                    @endif
                    @if(!auth()->user()->isDirector())
                        @can('delete', $task)
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-square bg-base-100 text-base-content/70 border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 size-12 rounded-xl shadow-sm transition-all"
                                    data-confirm="Are you sure you want to delete this task? This action is permanent."
                                    data-confirm-title="Delete Task" data-confirm-text="Yes, Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </form>
                        @endcan
                    @endif
                    <a href="{{ route('projects.show', $task->project) }}"
                        class="btn btn-primary h-12 px-6 gap-2 font-bold uppercase text-[10px] tracking-widest shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all rounded-xl border-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Back to Project
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content - Left Side (2 columns) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description Card -->
                <div
                    class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-3xl overflow-hidden">
                    <div class="card-body p-8">
                        <h3
                            class="font-bold text-sm uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                <path d="M12 12l0 .01" />
                                <path d="M3 13a20 20 0 0 0 18 0" />
                            </svg>
                            Description
                        </h3>
                        @if($task->description)
                            <p class="text-base leading-relaxed text-base-content/80">{{ $task->description }}</p>
                        @else
                            <p class="text-sm text-base-content/40 italic">No description provided</p>
                        @endif
                    </div>
                </div>

                <!-- Project Information Card -->
                <div
                    class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-3xl overflow-hidden">
                    <div class="card-body p-8">
                        <h3
                            class="font-bold text-sm uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                <path d="M12 12l0 .01" />
                                <path d="M3 13a20 20 0 0 0 18 0" />
                            </svg>
                            Project Information
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest mb-2">
                                    Project Name</p>
                                <a href="{{ route('projects.show', $task->project) }}"
                                    class="text-lg font-bold text-base-content hover:underline">
                                    {{ $task->project->name }}
                                </a>
                            </div>
                            @if($task->project->description)
                                <div>
                                    <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest mb-2">
                                        Project Description</p>
                                    <p class="text-sm text-base-content/70 leading-relaxed">
                                        {{ Str::limit($task->project->description, 150) }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Right Side (1 column) -->
            <div class="space-y-6">
                <!-- Status & Details Card -->
                <div
                    class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-3xl overflow-hidden">
                    <div class="card-body p-6">
                        <h3
                            class="font-bold text-xs uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 8l0 4" />
                                <path d="M12 16l0 .01" />
                            </svg>
                            Task Details
                        </h3>

                        <div class="space-y-5">
                            <!-- Status -->
                            <div>
                                <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest mb-2">
                                    Status</p>
                                <div
                                    class="inline-flex items-center justify-center px-3 h-6 bg-base-content text-base-100 font-black uppercase text-[10px] tracking-widest rounded-full">
                                    {{ str_replace('_', ' ', $task->status) }}
                                </div>
                            </div>

                            <!-- Due Date -->
                            <div>
                                <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest mb-2">Due
                                    Date</p>
                                @if($task->due_date)
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-base-content/40"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                        </svg>
                                        <p class="font-bold text-sm">{{ $task->due_date->format('M d, Y') }}</p>
                                    </div>
                                    @if($task->due_date->isPast() && $task->status !== 'completed')
                                        <div
                                            class="inline-flex items-center justify-center px-3 h-6 bg-error text-white text-[10px] font-black uppercase tracking-widest rounded-full mt-2">
                                            Overdue</div>
                                    @endif
                                @else
                                    <span class="text-sm text-base-content/40 font-medium">No deadline set</span>
                                @endif
                            </div>

                            <!-- Assigned To -->
                            @if($task->assignee)
                                <div>
                                    <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest mb-2">
                                        Assigned To</p>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="w-10 h-10 rounded-full ring-2 ring-primary/20">
                                                <img src="{{ $task->assignee->profile_photo_url }}"
                                                    alt="{{ $task->assignee->name }}" />
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-bold text-sm">{{ $task->assignee->name }}</p>
                                            <p class="text-xs text-base-content/50">{{ $task->assignee->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest mb-2">
                                        Assigned To</p>
                                    <span class="text-sm text-base-content/40 font-medium">Unassigned</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Timeline Card -->
                <div
                    class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-3xl overflow-hidden">
                    <div class="card-body p-6">
                        <h3
                            class="font-bold text-xs uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 7l0 5l3 3" />
                            </svg>
                            Timeline
                        </h3>

                        <div class="space-y-4">
                            <!-- Created -->
                            <div class="flex items-start gap-3 p-3 rounded-xl bg-base-200/30">
                                <div
                                    class="size-8 rounded-lg bg-base-100 flex items-center justify-center text-base-content/40 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest mb-1">
                                        Created</p>
                                    <p class="font-bold text-xs">{{ $task->created_at->format('M d, Y') }}</p>
                                    <p class="text-[10px] text-base-content/40">{{ $task->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="flex items-start gap-3 p-3 rounded-xl bg-base-200/30">
                                <div
                                    class="size-8 rounded-lg bg-base-100 flex items-center justify-center text-base-content/40 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest mb-1">
                                        Last Updated</p>
                                    <p class="font-bold text-xs">{{ $task->updated_at->format('M d, Y') }}</p>
                                    <p class="text-[10px] text-base-content/40">{{ $task->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>