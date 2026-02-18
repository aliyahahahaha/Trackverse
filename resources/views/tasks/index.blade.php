<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('tasks.index') }}"
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        TASK HUB
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <a href="{{ route('tasks.index', ['view' => 'list']) }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        LIST VIEW
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
                            <path d="M9 11l3 3l8 -8" />
                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Task Management
                        </h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Track progress and coordinate team
                            deliverables.</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="px-5 py-3 bg-white rounded-2xl border border-base-content/5 shadow-sm">
                        <span
                            class="text-[9px] font-bold uppercase tracking-widest text-base-content/30 block leading-none mb-1.5">Total
                            Tasks</span>
                        <span class="text-sm font-bold text-base-content leading-none">{{ $tasks->total() }} Tasks
                            Found</span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl overflow-hidden">
                <div
                    class="card-header bg-base-200/30 px-6 py-4 border-b border-base-content/5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="size-2 rounded-full bg-primary shadow-[0_0_10px_rgba(var(--p),0.5)]"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-base-content/40">
                            My Tasks</h3>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="overflow-x-auto">
                        <table class="table table-hover align-middle">
                            <thead
                                class="bg-base-200/20 text-base-content/40 uppercase text-[10px] font-black tracking-[0.1em]">
                                <tr>
                                    <th class="py-4 px-6">Task / Description</th>
                                    <th class="py-4 px-4 text-center">Status</th>
                                    <th class="py-4 px-4">Due Date</th>
                                    <th class="py-4 px-4">Project</th>
                                    <th class="py-4 px-4">Assignee</th>
                                    <th class="py-4 px-6 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse($tasks as $task)
                                    <tr class="group hover:bg-base-200/30 transition-all border-b border-base-content/5">
                                        <td class="py-5 px-6">
                                            <div class="flex flex-col min-w-0">
                                                <a href="{{ route('tasks.show', $task) }}"
                                                    class="font-black text-sm text-base-content group-hover:text-primary transition-colors truncate tracking-tight uppercase">
                                                    {{ $task->name }}
                                                </a>
                                                <span
                                                    class="text-xs text-base-content/50 font-medium truncate italic max-w-[300px] mt-0.5">
                                                    {{ Str::limit($task->description, 50) ?: 'No specific details.' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            @if($task->status === 'completed')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-success/30 bg-success/5 text-success shadow-sm">
                                                    <div class="size-1 rounded-full bg-success"></div>
                                                    Completed
                                                </span>
                                            @elseif($task->status === 'in_progress')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-primary/30 bg-primary/5 text-primary shadow-sm">
                                                    <div class="size-1 rounded-full bg-primary"></div>
                                                    In Progress
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-warning/30 bg-warning/5 text-warning shadow-sm">
                                                    <div class="size-1 rounded-full bg-warning"></div>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td
                                            class="py-5 px-4 text-[10px] font-black uppercase tracking-widest text-base-content/50">
                                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td class="py-5 px-4">
                                            <a href="{{ route('projects.show', $task->project) }}"
                                                class="font-black text-[10px] uppercase tracking-widest text-primary hover:text-primary-focus transition-colors">
                                                {{ $task->project->name }}
                                            </a>
                                        </td>
                                        <td class="py-5 px-4">
                                            @if ($task->assignee)
                                                <div class="flex items-center gap-2">
                                                    <div class="avatar">
                                                        <div
                                                            class="w-6 h-6 rounded-full ring-1 ring-base-content/10 overflow-hidden">
                                                            <img src="{{ $task->assignee->profile_photo_url }}" />
                                                        </div>
                                                    </div>
                                                    <span
                                                        class="text-[10px] font-bold text-base-content/70">{{ $task->assignee->name }}</span>
                                                </div>
                                            @else
                                                <span
                                                    class="text-[10px] font-bold text-base-content/30 italic">Unassigned</span>
                                            @endif
                                        </td>
                                        <td class="py-5 px-6 text-end">
                                            <div class="flex items-center justify-end gap-2 isolate">
                                                <!-- View -->
                                                <a href="{{ route('tasks.show', $task) }}"
                                                    class="btn btn-square btn-sm size-8 bg-base-100 text-base-content/40 shadow-sm border border-base-content/10 hover:border-primary hover:text-primary hover:bg-primary/5 transition-all rounded-xl"
                                                    title="View Task">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                </a>

                                                @can('update', $task)
                                                    <!-- Edit -->
                                                    <a href="{{ route('tasks.edit', $task) }}"
                                                        class="btn btn-square btn-sm size-8 bg-base-100 text-base-content/40 shadow-sm border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 transition-all rounded-xl"
                                                        title="Edit Task">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                            <path d="M13.5 6.5l4 4" />
                                                        </svg>
                                                    </a>
                                                @endcan

                                                @can('delete', $task)
                                                    <!-- Delete -->
                                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                        class="inline-block p-0 m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-square btn-sm size-8 bg-base-100 text-base-content/40 shadow-sm border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 transition-all rounded-xl"
                                                            data-confirm="Are you sure you want to delete this task?"
                                                            data-confirm-title="Delete Task" data-confirm-text="Yes, Delete"
                                                            title="Delete Task">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2.5" stroke-linecap="round"
                                                                stroke-linejoin="round">
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
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-12 text-center text-base-content/30 italic font-medium">
                                            No tasks found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-base-content/5">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>