<x-app-layout>
    <x-slot name="header">
        <div class="space-y-6">
            <!-- Top Navigation: Back Button & Breadcrumbs -->
            <div class="flex items-center gap-4">
                <a href="{{ route('projects.show', $task->project) }}"
                    class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                    <span class="text-[10px] uppercase tracking-[0.1em] text-base-content/60 group-hover:text-current">← BACK TO PROJECT</span>
                </a>

                <div class="h-4 w-px bg-base-content/10"></div>

                <nav class="flex items-center text-[10px] font-black uppercase tracking-[0.15em] text-base-content/30">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('projects.index') }}" class="hover:text-base-content transition-colors">Projects</a></li>
                        <li class="opacity-30"><svg viewBox="0 0 24 24" class="size-2.5" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg></li>
                        <li><a href="{{ route('projects.show', $task->project) }}" class="hover:text-base-content transition-colors">{{ $task->project->name }}</a></li>
                        <li class="opacity-30"><svg viewBox="0 0 24 24" class="size-2.5" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg></li>
                        <li class="text-base-content/60">{{ $task->name }}</li>
                    </ol>
                </nav>
            </div>

            <!-- Page Title Section -->
            <div class="flex items-center gap-4">
                <div class="size-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary shadow-sm border border-primary/5 ring-4 ring-primary/5 overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                        <path d="M13.5 6.5l4 4" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-3xl text-base-content tracking-tight leading-none mb-1.5">
                        {{ __('Edit Task') }}
                    </h2>
                    <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-base-content/30">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;" class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 7l0 5l3 3" /></svg>
                        Due: {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No deadline set' }}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="w-full max-w-3xl mx-auto px-4 mt-12 mb-20">
        <div class="card bg-base-100 border border-base-content/5 shadow-2xl shadow-base-content/[0.03] rounded-[2rem] overflow-hidden">
            <!-- Card Header Section -->
            <div class="px-8 pt-8 pb-4">
                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-base-content/30 flex items-center gap-2.5">
                    <div class="size-1.5 bg-base-content/20 rounded-full"></div>
                    Task Details
                </h3>
            </div>

            <div class="card-body p-8 pt-4">
                <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Task Name Section -->
                    <div class="form-control">
                        <label for="name" class="label pb-2.5">
                            <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16" /><path d="M4 12h16" /><path d="M4 18h12" /></svg>
                                Title
                            </span>
                        </label>
                        <input type="text" name="name" id="name"
                            class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-base-content/20 focus:ring-4 focus:ring-base-content/[0.02] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 py-8"
                            value="{{ old('name', $task->name) }}" placeholder="Enter task title..." required>
                    </div>

                    @php
                        $statusOptions = [
                            [
                                'value' => 'pending',
                                'label' => 'Pending',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 text-base-content/40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 7l0 5l3 3" /></svg>'
                            ],
                            [
                                'value' => 'in_progress',
                                'label' => 'Active',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 text-base-content" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a9 9 0 1 0 9 9" /></svg>'
                            ],
                            [
                                'value' => 'completed',
                                'label' => 'Done',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 text-base-content" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10" /></svg>'
                            ]
                        ];
                    @endphp

                    <!-- Status & Assignee Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="form-control">
                            <label class="label pb-2.5">
                                <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9" /><path d="M12 8v4l2 2" /></svg>
                                    Status
                                </span>
                            </label>
                            <x-ui.advance-select name="status" placeholder="Select Status" :multiple="false"
                                :selected="old('status', $task->status)" :options="$statusOptions" />
                        </div>

                        <div class="form-control">
                            <label class="label pb-2.5">
                                <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /></svg>
                                    Assignee
                                </span>
                            </label>
                            <x-ui.advance-select name="assigned_to" placeholder="Select Member"
                                :multiple="false" :selected="$task->assigned_to" :options="$users->map(fn($u) => [
                                    'value' => $u->id,
                                    'label' => $u->name,
                                    'description' => $u->email,
                                    'image' => $u->profile_photo_url
                                ])->toArray()" />
                        </div>
                    </div>

                    <!-- Due Date Section -->
                    <div class="form-control">
                        <label for="due_date" class="label pb-2.5">
                            <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" /></svg>
                                Due Date
                            </span>
                        </label>
                        <input type="datetime-local" name="due_date" id="due_date"
                            class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-base-content/20 focus:ring-4 focus:ring-base-content/[0.02] transition-all font-bold text-sm rounded-2xl py-8"
                            value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d\TH:i') : '') }}">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-10 border-t border-base-content/5">
                        <a href="{{ route('projects.show', $task->project) }}"
                            class="btn btn-ghost font-black uppercase tracking-[0.2em] text-[10px] rounded-xl px-8 h-12 min-h-[48px] border border-transparent hover:bg-base-content/5 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="btn btn-warning px-8 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-warning/20 h-12 min-h-[48px] border-none group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>