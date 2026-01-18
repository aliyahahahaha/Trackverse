<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 py-2">
            <div class="space-y-1">
                <h2 class="font-bold text-2xl text-base-content tracking-tight flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="size-6 text-primary">
                        <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    </svg>
                    {{ __('Projects') }}
                </h2>
                <p class="text-xs font-medium text-base-content/50 uppercase tracking-[0.1em]">Manage your projects</p>
            </div>
            <a href="{{ route('projects.create') }}"
                class="btn btn-primary h-11 px-6 font-bold shadow-lg shadow-primary/20 flex items-center gap-2 rounded-xl transition-all hover:scale-[1.02]">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                    class="size-5">
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                New Project
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-4">
            <!-- My Projects Section -->
            <div class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl overflow-hidden">
                <div
                    class="card-header bg-base-200/30 px-6 py-4 border-b border-base-content/5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="size-2 rounded-full bg-primary shadow-[0_0_10px_rgba(var(--p),0.5)]"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.15em] text-base-content/40 italic">My
                            Projects</h3>
                    </div>
                    <span
                        class="badge badge-sm text-[10px] font-black px-2.5 py-3 border-primary/20 bg-primary/10 text-primary">{{ $projects->count() }}
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
                                    <th class="py-4 px-4">Team</th>
                                    <th class="py-4 px-4">Tasks</th>
                                    <th class="py-4 px-6 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse($projects as $project)
                                    <tr class="group hover:bg-base-200/30 transition-all border-b border-base-content/5">
                                        <td class="py-5 px-6">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="size-10 rounded-xl bg-primary/5 text-primary flex items-center justify-center shrink-0 border border-primary/10 shadow-sm group-hover:bg-primary group-hover:text-primary-content transition-all duration-300">
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
                                                        class="font-black text-sm text-base-content group-hover:text-primary transition-colors truncate tracking-tight uppercase">
                                                        {{ $project->name }}
                                                    </span>
                                                    <span
                                                        class="text-xs text-base-content/40 font-medium truncate italic max-w-[300px] mt-0.5">
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
                                                    <div class="avatar group/avatar">
                                                        <div
                                                            class="w-8 h-8 rounded-lg ring-2 ring-base-100 border border-base-content/5 overflow-hidden shrink-0 shadow-sm transition-transform hover:-translate-y-1 hover:z-10">
                                                            <img src="{{ $member->profile_photo_url }}"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if($project->members->count() > 4)
                                                    <div
                                                        class="w-7 h-7 rounded-full ring-2 ring-base-100 bg-base-200 flex items-center justify-center text-[9px] font-bold text-base-content/40 shrink-0">
                                                        +{{ $project->members->count() - 4 }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-5 px-4">
                                            <div
                                                class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-base-content/50 bg-base-200/50 px-2.5 py-1.5 rounded-lg w-fit border border-base-content/5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="size-3.5 text-primary/60">
                                                    <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                                    <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                                    <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                                    <path d="M11 6l9 0" />
                                                    <path d="M11 12l9 0" />
                                                    <path d="M11 18l9 0" />
                                                </svg>
                                                <span>{{ $project->tasks->count() }} <span
                                                        class="hidden sm:inline">Tasks</span></span>
                                            </div>
                                        </td>
                                        <td class="py-5 px-6 text-end">
                                            <div class="flex items-center justify-end gap-2 isolate">
                                                <!-- View -->
                                                <a href="{{ route('projects.show', $project) }}"
                                                    class="btn btn-square btn-sm bg-base-100 text-base-content shadow-sm border border-base-content/10 hover:border-primary hover:text-primary hover:bg-primary/5 transition-all rounded-lg"
                                                    title="View Project">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="size-4">
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                </a>

                                                <!-- Edit -->
                                                <a href="{{ route('projects.edit', $project) }}"
                                                    class="btn btn-square btn-sm bg-base-100 text-base-content shadow-sm border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 transition-all rounded-lg"
                                                    title="Edit Project">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="size-4">
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                    </svg>
                                                </a>

                                                <!-- Delete -->
                                                <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                                    class="inline-block p-0 m-0"
                                                    onsubmit="return confirm('Delete this project? This action is irreversible.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-square btn-sm bg-base-100 text-base-content shadow-sm border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 transition-all rounded-lg"
                                                        title="Delete Project">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="size-4">
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center text-base-content/30 italic font-medium">
                                            No projects found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
                                                    class="btn btn-square btn-sm bg-base-100 text-base-content shadow-sm border border-base-content/10 hover:border-secondary hover:text-secondary hover:bg-secondary/5 transition-all rounded-lg"
                                                    title="View Project">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="size-4">
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                </a>
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