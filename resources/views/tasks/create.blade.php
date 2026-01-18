<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('projects.show', $project) }}"
                        class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                        <span
                            class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">←
                            BACK TO PROJECT</span>
                    </a>
                    <div
                        class="badge badge-lg font-bold text-[10px] uppercase tracking-widest bg-base-200/50 text-base-content/50 border-0">
                        New Task</div>
                </div>

                <div class="flex items-center gap-4 px-1">
                    <div
                        class="size-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shadow-sm border border-primary/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 11l3 3l8 -8" />
                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-base-content tracking-tight">Create Task</h1>
                        <p class="text-sm font-medium text-base-content/60 mt-0.5">Add a new task to
                            {{ $project->name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-8">
        <form action="{{ route('projects.tasks.store', $project) }}" method="POST" id="task-form">
            @csrf
            <input type="hidden" name="status" value="pending">

            <div
                class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-[2rem] overflow-hidden">
                <!-- Card Header -->
                <div class="px-8 py-6 border-b border-base-content/5 bg-base-100 flex items-center gap-4">
                    <div
                        class="size-10 rounded-xl bg-primary text-primary-content flex items-center justify-center shadow-lg shadow-primary/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 5h8" />
                            <path d="M13 9h5" />
                            <path d="M13 15h8" />
                            <path d="M13 19h5" />
                            <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-base-content tracking-tight">Task Details</h3>
                        <p class="text-xs font-medium text-base-content/40">Define clear objectives for your squad</p>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-8 space-y-8">
                    <!-- Task Name -->
                    <div class="form-control w-full">
                        <label class="label px-1 pt-0 pb-2">
                            <span class="text-[10px] font-black uppercase tracking-widest text-base-content/30">Task
                                Title</span>
                        </label>
                        <input type="text" name="name" id="name" required placeholder="Briefly state the deliverable..."
                            class="input input-lg w-full h-16 bg-base-200/30 border-none rounded-2xl focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-lg placeholder:text-base-content/20 placeholder:font-bold" />
                    </div>

                    <!-- Description -->
                    <div class="form-control w-full">
                        <label class="label px-1 pt-0 pb-2">
                            <span class="text-[10px] font-black uppercase tracking-widest text-base-content/30">Detailed
                                Context</span>
                        </label>
                        <textarea name="description" id="description" rows="6"
                            placeholder="Describe the expected outcome and any helpful links..."
                            class="textarea w-full bg-base-200/30 border-none rounded-2xl focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-medium text-base placeholder:text-base-content/20 placeholder:font-bold resize-none leading-relaxed p-5"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                        <!-- Due Date -->
                        <div class="form-control w-full">
                            <label class="label px-1 pt-0 pb-2">
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest text-base-content/30">Deadline</span>
                            </label>
                            <input type="date" name="due_date"
                                class="input input-lg w-full h-14 bg-base-200/30 border-none rounded-2xl focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm" />
                        </div>

                        <!-- Assignee -->
                        <div class="form-control w-full">
                            <x-ui.advance-select name="assigned_to" label="ASSIGN TO" placeholder="Draft Assignment"
                                :multiple="false" :options="$project->members->map(fn($m) => [
        'value' => $m->id,
        'label' => $m->name,
        'description' => $m->email,
        'image' => $m->profile_photo_url
    ])->toArray()" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 mt-6">
                <a href="{{ route('projects.show', $project) }}"
                    class="btn bg-base-200 hover:bg-base-300 text-base-content border-none font-bold rounded-xl">
                    Cancel
                </a>
                <button type="submit"
                    class="btn btn-primary h-12 px-10 rounded-xl font-black uppercase tracking-widest text-xs shadow-xl shadow-primary/25 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-4 h-4 flex-shrink-0"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />
                        <path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />
                        <path d="M15 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    </svg>
                    Create Task
                </button>
            </div>
        </form>
    </div>
</x-app-layout>