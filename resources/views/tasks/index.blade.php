<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 py-2">
            <div class="space-y-1">
                <h2 class="font-bold text-2xl text-base-content tracking-tight flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="size-6 text-primary">
                        <path d="M9 11l3 3l8 -8" />
                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                    </svg>
                    {{ __('All Tasks') }}
                </h2>
                <p class="text-xs font-medium text-base-content/50 uppercase tracking-[0.1em]">Manage all tasks
                </p>
            </div>
            <!-- Create Task is usually done within a project context -->
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="card bg-base-100 shadow-sm border border-base-content/5 rounded-2xl overflow-hidden">
                <div
                    class="card-header bg-base-200/30 px-6 py-4 border-b border-base-content/5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="size-2 rounded-full bg-primary shadow-[0_0_10px_rgba(var(--p),0.5)]"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.15em] text-base-content/40 italic">
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
                                                    class="text-xs text-base-content/40 font-medium truncate italic max-w-[300px] mt-0.5">
                                                    {{ Str::limit($task->description, 50) ?: 'No specific details.' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <span class="badge badge-sm font-bold uppercase tracking-wider
                                                                {{ $task->status === 'completed' ? 'badge-success text-success-content' : '' }}
                                                                {{ $task->status === 'in_progress' ? 'badge-info text-info-content' : '' }}
                                                                {{ $task->status === 'pending' ? 'badge-warning text-warning-content' : '' }}
                                                             ">
                                                {{ str_replace('_', ' ', $task->status) }}
                                            </span>
                                        </td>
                                        <td class="py-5 px-4 text-xs font-mono">
                                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td class="py-5 px-4">
                                            <a href="{{ route('projects.show', $task->project) }}"
                                                class="link link-hover text-xs font-bold uppercase tracking-wide text-primary">
                                                {{ $task->project->name }}
                                            </a>
                                        </td>
                                        <td class="py-5 px-4">
                                            @if ($task->assignee)
                                                <div class="flex items-center gap-2">
                                                    <div class="avatar">
                                                        <div class="w-6 h-6 rounded-full ring-1 ring-base-content/10">
                                                            <img src="{{ $task->assignee->profile_photo_url }}" />
                                                        </div>
                                                    </div>
                                                    <span class="text-xs font-bold">{{ $task->assignee->name }}</span>
                                                </div>
                                            @else
                                                <span class="text-xs text-base-content/40 italic">Unassigned</span>
                                            @endif
                                        </td>
                                        <td class="py-5 px-6 text-end">
                                            <div class="flex items-center justify-end gap-2 isolate">
                                                <!-- Edit -->
                                                <a href="{{ route('tasks.edit', $task) }}"
                                                    class="btn btn-square btn-sm bg-base-100 text-base-content/70 shadow-sm border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 transition-all rounded-lg"
                                                    title="Edit Task">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="size-4">
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                    </svg>
                                                </a>
                                                <!-- Delete -->
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                    class="inline-block p-0 m-0"
                                                    onsubmit="return confirm('Delete this task?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-square btn-sm bg-base-100 text-base-content/70 shadow-sm border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 transition-all rounded-lg"
                                                        title="Delete Task">
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