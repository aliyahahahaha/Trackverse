<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('projects.show', $task->project) }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        ← BACK TO PROJECT
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        EDIT TASK
                    </div>
                </div>
            </div>

            <!-- Main Title Content -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div
                        class="size-16 rounded-[1.5rem] bg-primary shadow-2xl shadow-primary/20 flex items-center justify-center text-primary-content shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Edit Task</h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Update parameters for task registry
                            item #{{ $task->id }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-6 lg:px-10">

        <form action="{{ route('tasks.update', $task) }}" method="POST" id="task-edit-form">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Top Section: 2 Columns (Context & Member) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Project Info (Context) -->
                    <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm p-6">
                        <div class="flex flex-col gap-6">
                            <div class="space-y-1.5">
                                <h3 class="text-sm font-bold text-base-content">Project Origin</h3>
                                <p class="text-[11px] text-base-content/50 font-medium leading-none">This task belongs
                                    to the following initiative</p>
                            </div>

                            <div
                                class="flex items-center gap-4 bg-base-200/30 p-4 rounded-xl border border-base-content/5">
                                <div
                                    class="size-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-base-content">{{ $task->project->name }}</p>
                                    <p class="text-[10px] text-base-content/40 font-bold uppercase tracking-widest">
                                        {{ $task->project->status }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assign To Member -->
                    <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm p-6 overflow-visible relative z-20">
                        <div class="flex flex-col gap-6">
                            <div class="space-y-1.5">
                                <h3 class="text-sm font-bold text-base-content">Personnel</h3>
                                <p class="text-[10px] text-base-content/40 font-medium leading-none">Modify the primary
                                    assignee for this task</p>
                            </div>

                            <div class="w-full relative">
                                @if(auth()->user()->hasPermission('edit_tasks'))
                                    <x-ui.advance-select name="assigned_to" id="assigned_to"
                                        placeholder="Select team member..." :multiple="false" :selected="$task->assigned_to"
                                        :options="$users->map(fn($u) => [
                                            'value' => $u->id,
                                            'label' => $u->name . ' (' . strtoupper($u->current_status) . ')',
                                            'description' => strtoupper($u->current_status) . ' • ' . $u->email,
                                            'image' => $u->profile_photo_url
                                        ])->toArray()" />
                                @else
                                    <div class="p-4 bg-base-200/50 border border-base-content/5 rounded-xl flex items-center gap-3 opacity-60 cursor-not-allowed">
                                        @if($task->assignee)
                                            <div class="size-8 rounded-full overflow-hidden">
                                                <img src="{{ $task->assignee->profile_photo_url }}" class="object-cover size-full">
                                            </div>
                                            <div>
                                                <div class="font-bold text-sm">{{ $task->assignee->name }}</div>
                                                <div class="text-[10px] text-base-content/50 font-bold uppercase">{{ $task->assignee->current_status }}</div>
                                            </div>
                                        @else
                                            <span class="text-sm font-bold text-base-content/40">No assignee</span>
                                        @endif
                                        <input type="hidden" id="assigned_to" value="{{ $task->assigned_to }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Section: Main Content Card -->
                <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-base-content/5">
                        <h3
                            class="text-sm font-bold text-base-content italic text-primary/60 uppercase tracking-widest mb-6">
                            01. Core Modifications</h3>

                        <div class="space-y-8">
                            <!-- Task Name -->
                            <div class="form-control w-full">
                                <label class="label px-1 pt-0 pb-2">
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-widest text-base-content/30">Task
                                        Title</span>
                                </label>
                                <input type="text" name="name" id="name" required oninput="syncEditSummary()"
                                    placeholder="Briefly state the deliverable..."
                                    {{ auth()->user()->hasPermission('edit_tasks') ? '' : 'disabled' }}
                                    class="input input-lg w-full h-16 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-bold text-lg placeholder:text-base-content/20 placeholder:font-bold {{ auth()->user()->hasPermission('edit_tasks') ? 'bg-base-200/30 focus:bg-base-100' : 'bg-base-200/50 opacity-60 cursor-not-allowed' }}"
                                    value="{{ old('name', $task->name) }}" />
                            </div>

                            <!-- Description Input -->
                            <div class="form-control w-full">
                                <label class="label px-1 pt-0 pb-2">
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-widest text-base-content/30">Description</span>
                                </label>
                                <textarea name="description" id="description" rows="5"
                                    placeholder="Describe the task instructions..."
                                    {{ auth()->user()->hasPermission('edit_tasks') ? '' : 'disabled' }}
                                    class="textarea w-full border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-base placeholder:text-base-content/30 placeholder:font-medium resize-none leading-relaxed p-5 {{ auth()->user()->hasPermission('edit_tasks') ? 'bg-base-200/30 focus:bg-base-100' : 'bg-base-200/50 opacity-60 cursor-not-allowed' }}">{{ old('description', $task->description) }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Status Field -->
                                <div class="form-control">
                                    <label class="label px-1 pt-0 pb-2">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/30">Current
                                            State</span>
                                    </label>
                                    <select name="status" id="status" onchange="syncEditSummary()"
                                        class="select select-lg w-full h-14 bg-base-200/30 border-2 border-base-content/10 hover:border-primary focus:border-primary focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all rounded-2xl font-bold text-sm">
                                        <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                                            ⏳ Pending
                                        </option>
                                        <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>
                                            🔄 In Progress
                                        </option>
                                        <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>
                                            ✅ Completed
                                        </option>
                                    </select>
                                </div>

                                <!-- Due Date Field -->
                                <div class="form-control">
                                    <label class="label px-1 pt-0 pb-2">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/30">Registry
                                            Deadline</span>
                                    </label>
                                    <input type="datetime-local" name="due_date" id="due_date"
                                        onchange="syncEditSummary()"
                                        {{ auth()->user()->hasPermission('edit_tasks') ? '' : 'disabled' }}
                                        class="input input-lg w-full h-14 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm {{ auth()->user()->hasPermission('edit_tasks') ? 'bg-base-200/30 focus:bg-base-100' : 'bg-base-200/50 opacity-60 cursor-not-allowed' }}"
                                        value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d\TH:i') : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary & Final CTA -->
                <div class="card bg-base-200/30 rounded-[2rem] p-8 ring-1 ring-base-content/5 mt-10">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-10">
                        <div class="flex-grow">
                            <h3
                                class="text-sm font-bold text-base-content uppercase tracking-widest mb-6 italic text-primary/60 flex items-center gap-3">
                                <span class="size-2 rounded-full bg-primary animate-pulse"></span>
                                Change Summary
                            </h3>
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-12">
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Task
                                        ID</span>
                                    <p class="text-sm font-bold text-base-content truncate">#{{ $task->id }}</p>
                                </div>
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Assignee</span>
                                    <p id="summary-assignee" class="text-sm font-bold text-base-content truncate">—</p>
                                </div>
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Deadline</span>
                                    <p id="summary-deadline" class="text-sm font-bold text-base-content truncate">—</p>
                                </div>
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Current State</span>
                                    <p id="summary-status" class="text-sm font-bold text-base-content truncate">Pending</p>
                                </div>
                                <div class="col-span-2 space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">New
                                        Title</span>
                                    <p id="summary-title" class="text-sm font-bold text-base-content line-clamp-1">—</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-center lg:items-end gap-3 min-w-[240px]">
                            <button type="submit"
                                class="btn btn-primary btn-lg rounded-2xl w-full px-12 group shadow-2xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all h-16 border-0">
                                <span class="flex items-center gap-3 font-bold uppercase tracking-widest text-[10px]">
                                    SAVE CHANGES
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="size-4 group-hover:translate-x-1 transition-transform"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12l14 0" />
                                        <path d="M13 18l6 -6" />
                                        <path d="M13 6l6 6" />
                                    </svg>
                                </span>
                            </button>
                            <a href="{{ route('projects.show', $task->project) }}"
                                class="btn bg-[#1e293b] hover:bg-[#334155] h-12 w-full rounded-2xl border-none transition-all">
                                <span class="font-bold uppercase text-[10px] tracking-widest text-white">CANCEL</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function syncEditSummary() {
            const name = document.getElementById('name').value;
            const deadline = document.getElementById('due_date').value;
            const assigneeSelect = document.getElementById('assigned_to');
            const statusSelect = document.getElementById('status');

            document.getElementById('summary-title').textContent = name || '—';

            if (deadline) {
                const date = new Date(deadline);
                document.getElementById('summary-deadline').textContent = date.toLocaleDateString(undefined, {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            } else {
                document.getElementById('summary-deadline').textContent = '—';
            }

            if (assigneeSelect) {
                const selectedOption = assigneeSelect.options[assigneeSelect.selectedIndex];
                const assigneeName = (selectedOption && selectedOption.value) ? selectedOption.text : '—';
                document.getElementById('summary-assignee').textContent = assigneeName;

                // LOGIC REMOVED: Auto update to 'In Progress' is disabled.
            }

            if (statusSelect) {
                const selectedStatusOption = statusSelect.options[statusSelect.selectedIndex];
                const statusText = selectedStatusOption ? selectedStatusOption.text : 'Pending';
                
                const summaryStatus = document.getElementById('summary-status');
                if (summaryStatus) {
                    summaryStatus.textContent = statusText;
                    
                    // Style the status in summary
                    summaryStatus.classList.remove('text-warning', 'text-primary', 'text-success');
                    if (statusSelect.value === 'completed') summaryStatus.classList.add('text-success');
                    else if (statusSelect.value === 'in_progress') summaryStatus.classList.add('text-primary');
                    else summaryStatus.classList.add('text-warning');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Initialize FlyonUI select components
            if (window.HSStaticMethods) {
                window.HSStaticMethods.autoInit(['select']);
            }

            // Set up event listeners
            const inputs = ['name', 'due_date', 'assigned_to', 'status'];
            inputs.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', syncEditSummary);
                    el.addEventListener('change', syncEditSummary);
                }
            });
            
            // Initial summary update
            setTimeout(syncEditSummary, 500);
        });
    </script>
</x-app-layout>