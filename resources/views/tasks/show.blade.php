<x-app-layout>
    <x-slot name="header">
        <div class="space-y-6 pb-4">
            <!-- Back Button & Breadcrumb Row -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('projects.show', $task->project) }}"
                        class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                        <span
                            class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">←
                            BACK TO PROJECT</span>
                    </a>
                </div>

                <div class="h-4 w-px bg-base-content/20"></div>

                <!-- Breadcrumb -->
                <nav class="flex items-center text-[10px] font-black uppercase tracking-widest text-base-content/40">
                    <ul class="flex items-center gap-2">
                        <li><a href="{{ route('projects.index') }}"
                                class="hover:text-primary transition-colors">Projects</a></li>
                        <li class="flex items-center"><span class="mx-1 opacity-20">/</span></li>
                        <li><a href="{{ route('projects.show', $task->project) }}"
                                class="hover:text-primary transition-colors">{{ $task->project->name }}</a></li>
                        <li class="flex items-center"><span class="mx-1 opacity-20">/</span></li>
                        <li class="text-base-content/60">{{ $task->name }}</li>
                    </ul>
                </nav>
            </div>

            <!-- Title & Actions Row -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 overflow-visible">
                <div class="space-y-2">
                    <div class="text-[10px] uppercase font-black tracking-[0.2em] text-base-content/30 ml-1">Task
                        Details</div>
                    <h2
                        class="font-black text-3xl text-base-content tracking-tight leading-none flex items-center gap-3">
                        <div
                            class="size-11 bg-base-content/10 rounded-[1.25rem] flex items-center justify-center text-base-content shadow-sm border border-base-content/5 ring-4 ring-base-content/5 overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 11l3 3l8 -8" />
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                            </svg>
                        </div>
                        {{ $task->name }}
                    </h2>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-2">
                    @can('update', $task)
                        <!-- Edit Button -->
                        <a href="{{ route('tasks.edit', $task) }}"
                            class="btn btn-square btn-sm h-9 w-9 rounded-xl bg-base-100 text-base-content border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 shadow-sm transition-all"
                            title="Edit Task">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>
                        </a>
                    @endcan

                    @can('delete', $task)
                        <!-- Delete Button -->
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                            onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-square btn-sm h-9 w-9 rounded-xl bg-base-100 text-base-content border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 shadow-sm transition-all"
                                title="Delete Task">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </button>
                        </form>
                    @endcan
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
                            class="font-black text-sm uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
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
                            class="font-black text-sm uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
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
                            class="font-black text-xs uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
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
                                <span
                                    class="badge badge-lg bg-base-content text-base-100 font-black uppercase text-[10px] border-none px-4 py-3">
                                    {{ str_replace('_', ' ', $task->status) }}
                                </span>
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
                                        <span
                                            class="badge badge-error badge-sm border-none text-[9px] font-black uppercase tracking-tighter mt-2">Overdue</span>
                                    @endif
                                @else
                                    <span class="text-sm text-base-content/40 font-medium">No deadline set</span>
                                @endif
                            </div>

                            <!-- Assigned To -->
                            @if($task->assignedUser)
                                <div>
                                    <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest mb-2">
                                        Assigned To</p>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="w-10 h-10 rounded-full ring-2 ring-primary/20">
                                                <img src="{{ $task->assignedUser->profile_photo_url }}"
                                                    alt="{{ $task->assignedUser->name }}" />
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-bold text-sm">{{ $task->assignedUser->name }}</p>
                                            <p class="text-xs text-base-content/50">{{ $task->assignedUser->email }}</p>
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
                            class="font-black text-xs uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
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