<x-app-layout>
    <x-slot name="header">
        <div class="space-y-6">
            <!-- Back Button & Breadcrumb Row -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('projects.index') }}" 
                       class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                        <span class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">← BACK TO PROJECTS</span>
                    </a>
                </div>

                <div class="h-4 w-px bg-base-content/20"></div>

                <!-- Breadcrumb -->
                <nav class="flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-base-content/40">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('projects.index') }}" class="hover:text-primary transition-colors">Projects</a></li>
                        <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;" class="opacity-30 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg></li>
                        <li class="text-base-content/60">{{ $project->name }}</li>
                    </ol>
                </nav>
            </div>

            <!-- Title & Actions Row -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2">
                <!-- Title Section -->
                <div class="flex items-center gap-4">
                    <div class="size-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary shadow-sm border border-primary/5 ring-4 ring-primary/5 overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 28px; height: 28px;" class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><path d="M12 12l0 .01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg>
                    </div>
                    <div>
                        <h2 class="font-black text-3xl text-base-content tracking-tight leading-none mb-1.5">
                            {{ $project->name }}
                        </h2>
                        <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-wider text-base-content/30">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;" class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 7l0 5l3 3" /></svg>
                            Est. completion: {{ $project->deadline ? $project->deadline->diffForHumans() : 'No deadline set' }}
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('projects.tasks.create', $project) }}"
                        class="btn btn-primary h-11 px-6 rounded-xl font-black uppercase tracking-widest text-[10px] shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Add Task
                    </a>

                    <div class="flex items-center bg-base-100 p-1.5 rounded-2xl border border-base-content/5 shadow-sm gap-1">
                        @can('update', $project)
                            <a href="{{ route('projects.edit', $project) }}" 
                               class="btn btn-square btn-sm btn-ghost hover:bg-warning/10 hover:text-warning transition-all rounded-xl"
                               title="Edit Project">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                            </a>
                        @endcan

                    <a href="{{ route('projects.members.index', $project) }}" 
                       class="btn btn-square btn-sm btn-ghost hover:bg-secondary/10 hover:text-secondary transition-all rounded-xl"
                       title="Manage Members">
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                    </a>

                    @can('delete', $project)
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Archive this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="btn btn-square btn-sm btn-ghost hover:bg-error/10 hover:text-error transition-all rounded-xl"
                                title="Delete Project">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Main Content Area -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- Project Overview Card -->
            <div class="card bg-base-100 border border-base-content/5 shadow-xl shadow-base-content/[0.02] rounded-3xl overflow-hidden">
                <div class="card-body p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="size-2 bg-primary rounded-full animate-pulse"></div>
                            <h3 class="text-xs font-black uppercase tracking-widest text-base-content/40">Project Overview</h3>
                        </div>
                        @include('projects.partials.status-badge', ['status' => $project->status])
                    </div>

                    <p class="text-base leading-relaxed text-base-content/70 font-medium italic">
                        {{ $project->description ?: 'Welcome to ' . $project->name . '. Use this space to coordinate goals, track progress, and manage team deliverables efficiently.' }}
                    </p>

                    <div class="flex flex-wrap items-center gap-3 mt-8 pt-8 border-t border-base-content/5">
                        <!-- Owner Chip -->
                        <div class="flex items-center gap-2 bg-base-200/50 pl-1 pr-3 py-1 rounded-full border border-base-content/5">
                            <div class="avatar">
                                <div class="size-6 rounded-full overflow-hidden border border-primary/20 shadow-sm">
                                    <img src="{{ $project->creator->profile_photo_url }}" alt="{{ $project->creator->name }}" />
                                </div>
                            </div>
                            <span class="text-[10px] font-black uppercase text-base-content/50 tracking-tight">{{ $project->creator->name }}</span>
                        </div>

                        <!-- Date Chip -->
                        <div class="flex items-center gap-2 bg-base-200/50 px-3 py-1.5 rounded-full border border-base-content/5">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;" class="text-primary/60 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                            <span class="text-[10px] font-black uppercase text-base-content/40 tracking-tight">Started {{ $project->created_at->format('M Y') }}</span>
                        </div>

                        <!-- Visibility Chip -->
                        <div class="flex items-center gap-2 bg-base-200/50 px-3 py-1.5 rounded-full border border-base-content/5">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;" class="text-success/60 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M8 11v-5a4 4 0 1 1 8 0" /></svg>
                            <span class="text-[10px] font-black uppercase text-base-content/40 tracking-tight">Active</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="space-y-6">
                <div class="flex items-center justify-between px-2">
                    <div class="flex items-center gap-3">
                        <h3 class="font-black text-xl tracking-tight text-base-content">Tasks</h3>
                        <div class="px-2 py-0.5 bg-secondary/10 text-secondary border border-secondary/10 rounded-lg text-xs font-black">
                            {{ $project->tasks->count() }}
                        </div>
                    </div>
                </div>

                @if($project->tasks->count() > 0)
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($project->tasks as $task)
                            <div class="group bg-base-100 p-5 rounded-2xl border border-base-content/5 shadow-sm hover:shadow-md hover:border-primary/20 transition-all flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="size-11 rounded-xl bg-base-200 flex items-center justify-center text-base-content/20 group-hover:bg-primary/10 group-hover:text-primary transition-all overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3l8 -8" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-black text-base-content group-hover:text-primary transition-colors">{{ $task->name }}</h4>
                                        <div class="flex items-center gap-3 mt-1">
                                            <div class="text-xs font-bold text-base-content/40 flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;" class="text-primary/40 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M15 19l2 2l4 -4" /></svg>
                                                {{ $task->due_date ? $task->due_date->format('M d') : 'No deadline' }}
                                            </div>
                                            <div class="size-1 bg-base-content/10 rounded-full"></div>
                                            @if($task->status === 'completed')
                                                <span class="text-[9px] font-black uppercase tracking-widest text-success">Finished</span>
                                            @else
                                                <span class="text-[9px] font-black uppercase tracking-widest text-warning">Pending</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between md:justify-end gap-3 md:border-l md:border-base-content/5 md:pl-6">
                                    @if($task->assignee)
                                        <div class="flex items-center gap-2 pr-4">
                                            <div class="avatar border-2 border-white shadow-sm rounded-full overflow-hidden">
                                                <div class="size-8">
                                                    <img src="{{ $task->assignee->profile_photo_url }}" alt="{{ $task->assignee->name }}" />
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold text-base-content/60">{{ $task->assignee->name }}</span>
                                        </div>
                                    @endif
                                    
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-square btn-xs btn-ghost hover:bg-primary/10 hover:text-primary transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-base-100 rounded-3xl border border-base-content/5 border-dashed p-12 text-center shadow-sm">
                        <div class="size-14 bg-primary/5 rounded-full flex items-center justify-center mx-auto mb-5 group relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="w-8 h-8 text-primary/20 group-hover:translate-y-[-5px] group-hover:translate-x-[5px] transition-transform duration-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" /><path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" /><path d="M15 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                        </div>
                        <h4 class="text-lg font-black text-base-content mb-2 tracking-tight">No tasks found</h4>
                        <p class="text-xs text-base-content/40 max-w-xs mx-auto leading-relaxed">Let's turn your vision into reality. Break down project goals into clear, actionable tasks.</p>
                        <a href="{{ route('projects.tasks.create', $project) }}" 
                                class="btn btn-primary h-11 px-8 rounded-xl font-black uppercase tracking-widest shadow-lg shadow-primary/20 mt-6">
                            Create Task
                        </a>
                    </div>
                @endif


            </div>
        </div>

        <!-- Sidebar Panel -->
        <div class="lg:col-span-4 space-y-8 sticky top-8">
            <!-- Project Squad Panel -->
            <div class="card bg-base-100 border border-base-content/5 shadow-xl shadow-base-content/[0.02] rounded-3xl overflow-hidden">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-sm font-black text-base-content tracking-tight">Team</h3>
                            <p class="text-[9px] uppercase font-black text-base-content/30 tracking-widest">{{ $project->members->count() }} Members</p>
                        </div>
                        <a href="{{ route('projects.members.index', $project) }}" class="btn btn-xs btn-ghost hover:bg-primary/10 text-primary font-bold border-none rounded-lg px-3 bg-primary/5 transition-all">
                            Manage
                        </a>
                    </div>

                    <div class="space-y-3">
                        @foreach($project->members as $member)
                            <div class="flex items-center gap-3 p-1.5 rounded-xl hover:bg-base-200/50 transition-all group">
                                <div class="avatar">
                                    <div class="size-9 rounded-full overflow-hidden border-2 border-primary/10 p-0.5 group-hover:border-primary transition-colors">
                                        <img src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}" class="rounded-full object-cover" />
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-[11px] font-black text-base-content truncate">{{ $member->name }}</div>
                                    <div class="text-[9px] text-base-content/30 font-bold truncate uppercase tracking-tighter">{{ $member->email }}</div>
                                </div>
                                @if($member->id === $project->created_by)
                                    <div class="badge badge-soft badge-primary badge-xs py-2 px-3 font-black uppercase text-[8px] border-none rounded-full">
                                        Owner
                                    </div>
                                @else
                                    <div class="badge badge-soft badge-neutral badge-xs py-2 px-3 font-black uppercase text-[8px] border-none rounded-full">
                                        Member
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        @if($project->members->isEmpty())
                            <div class="py-6 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="w-8 h-8 text-base-content/10 mb-2 mx-auto flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                                <p class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest">No members</p>
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('projects.members.index', $project) }}" class="btn btn-outline btn-block border-base-content/10 border-2 hover:bg-primary hover:border-primary hover:text-white transition-all rounded-xl mt-6 font-black uppercase tracking-widest text-[9px] h-11">
                        Invite Member
                    </a>
                </div>
            </div>

            <!-- Productivity Stats (Minimal Card) -->
            <div class="bg-primary rounded-3xl p-6 text-primary-content shadow-xl shadow-primary/20 relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-xs font-black uppercase tracking-widest opacity-60 mb-1">Progress</h3>
                    <div class="text-3xl font-black mb-4">
                        {{ $project->tasks->where('status', 'completed')->count() }} / {{ $project->tasks->count() }}
                    </div>
                    <div class="w-full bg-white/20 h-1.5 rounded-full overflow-hidden mb-2">
                        <div class="bg-white h-full transition-all duration-1000" style="width: {{ $project->tasks->count() > 0 ? ($project->tasks->where('status', 'completed')->count() / $project->tasks->count()) * 100 : 0 }}%"></div>
                    </div>
                    <p class="text-[10px] font-bold opacity-60">Tasks completed</p>
                </div>
            </div>
        </div>
    </div>

    @include('projects.partials.task-create-modal')
    @include('projects.partials.modal-fix')
</x-app-layout>