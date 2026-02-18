<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('projects.index') }}"
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        ACTIVE PROJECTS
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <a href="{{ route('projects.index', ['filter' => 'archived']) }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        ARCHIVED
                    </a>
                </div>
            </div>

            <!-- Main Header Content -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div
                        class="size-16 rounded-[1.5rem] bg-primary shadow-2xl shadow-primary/20 flex items-center justify-center text-primary-content shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Project Hub</h1>
                        <p class="text-[13px] text-base-content/50 font-bold">Manage and track your team's initiatives.
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="px-5 py-3 bg-white rounded-2xl border border-base-content/5 shadow-sm">
                        <span
                            class="text-[9px] font-bold uppercase tracking-widest text-base-content/30 block leading-none mb-1.5">Active
                            Projects</span>
                        <span
                            class="text-sm font-bold text-base-content leading-none">{{ $projects->count() + $joinedProjects->count() }}
                            Active</span>
                    </div>
                    @if(!auth()->user()->isDirector())
                        @can('create', App\Models\Project::class)
                            <a href="{{ route('projects.create') }}"
                                class="btn btn-primary h-12 px-8 gap-3 font-bold uppercase text-[10px] tracking-widest shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all rounded-2xl border-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                NEW PROJECT
                            </a>
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-4">
            <!-- My Projects Section - Visible only to those who can create and NOT Director -->
            @if(!auth()->user()->isDirector())
                @can('create', App\Models\Project::class)
                    <div class="card bg-white border-2 border-slate-200 shadow-md rounded-2xl overflow-hidden mb-6">
                        <div
                            class="card-header bg-slate-50 px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="size-2 rounded-full bg-indigo-500 shadow-[0_0_10px_rgba(79,70,229,0.3)]"></div>
                                <h3 class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 italic">My Projects
                                </h3>
                            </div>
                            <span
                                class="badge badge-sm text-[10px] font-black px-2.5 py-3 border-indigo-100 bg-indigo-50 text-indigo-600">
                                {{ $projects->count() }} ACTIVE
                            </span>
                        </div>
                        <div class="card-body p-0">
                            <div class="overflow-x-auto">
                                <table class="table table-hover align-middle">
                                    <thead
                                        class="bg-slate-50/50 text-slate-400 uppercase text-[10px] font-black tracking-[0.1em]">
                                        <tr>
                                            <th class="py-4 px-6">Project Name</th>
                                            <th class="py-4 px-4 text-center">Status</th>
                                            <th class="py-4 px-4">Team</th>
                                            <th class="py-4 px-4">Tasks</th>
                                            <th class="py-4 px-6 text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        @forelse($projects as $project)
                                            <tr class="group hover:bg-slate-50 transition-all border-b border-slate-100">
                                                <td class="py-5 px-6">
                                                    <div class="flex items-center gap-4">
                                                        <div
                                                            class="size-10 rounded-xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-200 shadow-sm group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all duration-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="size-5">
                                                                <path
                                                                    d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                                                                <path d="M17 17l1.5 -1.5" />
                                                                <path d="M17 11l1.5 1.5" />
                                                                <path d="M19 14l-2 0" />
                                                            </svg>
                                                        </div>
                                                        <div class="flex flex-col min-w-0">
                                                            <span
                                                                class="font-black text-sm text-slate-700 group-hover:text-indigo-600 transition-colors truncate tracking-tight uppercase">
                                                                {{ $project->name }}
                                                            </span>
                                                            <span
                                                                class="text-xs text-slate-400 font-medium italic truncate max-w-[300px] mt-0.5">
                                                                {{ $project->description ?: 'No description.' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-4 text-center">
                                                    @include('projects.partials.status-badge', ['status' => $project->status])
                                                </td>
                                                <td class="py-5 px-4">
                                                    <div class="flex -space-x-2 items-center">
                                                        @foreach($project->members->take(5) as $member)
                                                            <div class="avatar">
                                                                <div
                                                                    class="w-8 h-8 rounded-lg ring-2 ring-white border border-slate-200 overflow-hidden shadow-sm">
                                                                    <img src="{{ $member->profile_photo_url }}"
                                                                        class="w-full h-full object-cover">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="py-5 px-4">
                                                    <div
                                                        class="flex items-center gap-2 text-[10px] font-bold text-slate-500 bg-slate-100 px-2.5 py-1.5 rounded-lg w-fit border border-slate-200">
                                                        <span>{{ $project->tasks->count() }} TASKS</span>
                                                    </div>
                                                </td>
                                                <td class="py-5 px-6 text-end">
                                                    <div class="flex items-center justify-end gap-2 isolate">
                                                        <a href="{{ route('projects.show', $project) }}"
                                                            class="btn btn-square btn-sm bg-base-100 text-base-content/70 shadow-sm border border-base-content/10 hover:border-indigo-600 hover:text-indigo-600 hover:bg-indigo-600/5 transition-all rounded-lg"
                                                            title="View Project">
                                                            <span class="icon-[tabler--eye] size-4"></span>
                                                        </a>
                                                        <a href="{{ route('projects.edit', $project) }}"
                                                            class="btn btn-square btn-sm bg-base-100 text-base-content/70 shadow-sm border border-base-content/10 hover:border-amber-500 hover:text-amber-500 hover:bg-amber-500/5 transition-all rounded-lg"
                                                            title="Edit Project">
                                                            <span class="icon-[tabler--pencil] size-4"></span>
                                                        </a>
                                                        @can('delete', $project)
                                                            <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                                                class="inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-square btn-sm bg-base-100 text-base-content/70 shadow-sm border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 transition-all rounded-lg"
                                                                    data-confirm="Are you sure you want to delete this project? This will permanently remove all associated tasks and data."
                                                                    data-confirm-title="Delete Project" data-confirm-text="Yes, Delete"
                                                                    title="Delete Project">
                                                                    <span class="icon-[tabler--trash] size-4"></span>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="py-12 text-center text-slate-400 italic">No projects found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endcan
            @endif

            <!-- Collaborations Section -->
            <div class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl overflow-hidden">
                <div
                    class="card-header bg-base-200/30 px-6 py-4 border-b border-base-content/5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="size-2 rounded-full bg-secondary shadow-[0_0_10px_rgba(var(--s),0.5)]"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.15em] text-base-content/40 italic">
                            Joined Projects</h3>
                    </div>
                    <span
                        class="badge badge-sm text-[10px] font-black px-2.5 py-3 border-secondary/20 bg-secondary/10 text-secondary">{{ $joinedProjects->count() }}
                        ACTIVE</span>
                </div>
                <div class="card-body p-0">
                    <div class="overflow-x-auto">
                        <table class="table table-hover align-middle">
                            <thead
                                class="bg-base-200/20 text-base-content/40 uppercase text-[10px] font-black tracking-[0.1em]">
                                <tr>
                                    <th class="py-4 px-6">Project Name</th>
                                    <th class="py-4 px-4 text-center">Status</th>
                                    <th class="py-4 px-4">Owner</th>
                                    <th class="py-4 px-4">Team</th>
                                    <th class="py-4 px-6 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse($joinedProjects as $project)
                                    <tr class="group hover:bg-base-200/30 transition-all border-b border-base-content/5">
                                        <td class="py-5 px-6">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="size-10 rounded-xl bg-secondary/5 text-secondary flex items-center justify-center shrink-0 border border-secondary/10 shadow-sm group-hover:bg-secondary group-hover:text-secondary-content transition-all duration-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="size-5">
                                                        <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                                                        <path d="M12 3c1.333 0 2.667 1.333 4 4" />
                                                        <path d="M12 3c-1.333 0 -2.667 1.333 -4 4" />
                                                        <path d="M12 15c1.333 0 2.667 1.333 4 4" />
                                                        <path d="M12 15c-1.333 0 -2.667 1.333 -4 4" />
                                                    </svg>
                                                </div>
                                                <div class="flex flex-col min-w-0">
                                                    <span
                                                        class="font-black text-sm text-base-content group-hover:text-secondary transition-colors truncate tracking-tight uppercase">
                                                        {{ $project->name }}
                                                    </span>
                                                    <span
                                                        class="text-xs text-base-content/40 font-medium truncate italic max-w-[300px] mt-0.5">
                                                        {{ $project->description ?: 'No description.' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-5 px-4 text-center">
                                            @include('projects.partials.status-badge', ['status' => $project->status])
                                        </td>
                                        <td class="py-5 px-4">
                                            <div class="flex items-center gap-2.5 group/owner">
                                                <div
                                                    class="avatar shadow-sm ring-1 ring-base-content/5 rounded-lg overflow-hidden group-hover/owner:ring-secondary/30 transition-all">
                                                    <div class="w-7 h-7">
                                                        <img src="{{ $project->creator->profile_photo_url }}"
                                                            class="w-full h-full object-cover shadow-inner" />
                                                    </div>
                                                </div>
                                                <span
                                                    class="text-xs font-black text-base-content/60 group-hover/owner:text-secondary transition-colors truncate tracking-tight uppercase">{{ $project->creator->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-5 px-4">
                                            <div
                                                class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-base-content/50 bg-base-200/50 px-2.5 py-1.5 rounded-lg w-fit border border-base-content/5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="size-3.5 text-secondary/60">
                                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                                </svg>
                                                <span>{{ $project->members->count() }} <span
                                                        class="hidden sm:inline">Members</span></span>
                                            </div>
                                        </td>
                                        <td class="py-5 px-6 text-end">
                                            <div class="flex items-center justify-end gap-2 isolate">
                                                <!-- View -->
                                                <a href="{{ route('projects.show', $project) }}"
                                                    class="btn btn-square btn-sm bg-base-100 text-base-content/70 shadow-sm border border-base-content/10 hover:border-secondary hover:text-secondary hover:bg-secondary/5 transition-all rounded-lg"
                                                    title="View Project">
                                                    <span class="icon-[tabler--eye] size-4"></span>
                                                </a>

                                                @can('update', $project)
                                                    <a href="{{ route('projects.edit', $project) }}"
                                                        class="btn btn-square btn-sm bg-base-100 text-base-content/70 shadow-sm border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 transition-all rounded-lg"
                                                        title="Edit Project">
                                                        <span class="icon-[tabler--pencil] size-4"></span>
                                                    </a>
                                                @endcan

                                                @can('delete', $project)
                                                    <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-square btn-sm bg-base-100 text-base-content/70 shadow-sm border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 transition-all rounded-lg"
                                                            data-confirm="Are you sure you want to delete this project? This will permanently remove all associated tasks and data."
                                                            data-confirm-title="Delete Project" data-confirm-text="Yes, Delete"
                                                            title="Delete Project">
                                                            <span class="icon-[tabler--trash] size-4"></span>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="py-12 text-center text-base-content/20 italic font-black uppercase tracking-widest text-xs">
                                            No joined projects found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>