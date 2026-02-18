<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('projects.show', $project) }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        ← BACK TO PROJECT
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        EDIT PROJECT
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
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Edit Project</h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Update project settings and team
                            configuration for {{ $project->name }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-6 lg:px-10">

        <form action="{{ route('projects.update', $project) }}" method="POST" id="project-edit-form">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Top Section: 2 Columns (Status Info & Team Members) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Current Status Info -->
                    <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm p-6">
                        <div class="flex flex-col gap-6">
                            <div class="space-y-1.5">
                                <h3 class="text-sm font-bold text-base-content">Project Status</h3>
                                <p class="text-[11px] text-base-content/50 font-medium leading-none">Current state and
                                    progress tracking</p>
                            </div>

                            <div
                                class="flex items-center gap-4 bg-base-200/30 p-4 rounded-xl border border-base-content/5">
                                @include('projects.partials.status-badge', ['status' => $project->status])
                                <div>
                                    <p class="text-sm font-bold text-base-content">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </p>
                                    <p class="text-[10px] text-base-content/40 font-bold uppercase tracking-widest">
                                        {{ $project->tasks->count() }} Tasks • {{ $project->members->count() }} Members
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Team Members -->
                    <div
                        class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm p-6 overflow-visible relative z-20">
                        <div class="flex flex-col gap-6">
                            <div class="space-y-1.5">
                                <h3 class="text-sm font-bold text-base-content">Team Configuration</h3>
                                <p class="text-[10px] text-base-content/40 font-medium leading-none">Manage project
                                    collaborators</p>
                            </div>

                            <div class="w-full relative z-50">
                                <x-ui.advance-select name="members" id="members" placeholder="Select team members..."
                                    onchange="syncEditSummary()" :selected="$project->members->pluck('id')->toArray()"
                                    :options="$users->map(fn($u) => [
        'value' => $u->id,
        'label' => $u->name,
        'description' => $u->email,
        'image' => $u->profile_photo_url
    ])->toArray()" />
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
                            <!-- Project Name -->
                            <div class="form-control w-full">
                                <label class="label px-1 pt-0 pb-2">
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-widest text-base-content/30">Project
                                        Name</span>
                                </label>
                                <input type="text" name="name" id="name" required oninput="syncEditSummary()"
                                    placeholder="Enter project name..."
                                    class="input input-lg w-full h-16 bg-base-200/30 border-none rounded-2xl focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-lg placeholder:text-base-content/20 placeholder:font-bold"
                                    value="{{ old('name', $project->name) }}" />
                                @error('name')
                                    <label class="label px-1 pt-2 pb-0">
                                        <span class="text-[10px] text-error font-bold">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-control w-full">
                                <label class="label px-1 pt-0 pb-2">
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-widest text-base-content/30">Project
                                        Description</span>
                                </label>
                                <textarea name="description" id="description" rows="5" oninput="syncEditSummary()"
                                    placeholder="Describe the project objectives and scope..."
                                    class="textarea w-full bg-base-200/30 border-none rounded-2xl focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-medium text-base placeholder:text-base-content/20 placeholder:font-medium resize-none leading-relaxed p-5">{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <label class="label px-1 pt-2 pb-0">
                                        <span class="text-[10px] text-error font-bold">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Status Field -->
                                <div class="form-control">
                                    <label class="label px-1 pt-0 pb-2">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/30">Project
                                            State</span>
                                    </label>
                                    <select name="status" id="status" onchange="syncEditSummary()"
                                        class="select select-lg w-full h-14 bg-base-200/30 border-2 border-base-content/10 hover:border-primary focus:border-primary focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all rounded-2xl font-bold text-sm">
                                        <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }}>
                                            📋 Planning
                                        </option>
                                        <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>
                                            🚀 Active
                                        </option>
                                        <option value="on_hold" {{ old('status', $project->status) == 'on_hold' ? 'selected' : '' }}>
                                            ⏸️ On Hold
                                        </option>
                                        <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>
                                            ✅ Completed
                                        </option>
                                    </select>
                                    @error('status')
                                        <label class="label px-1 pt-2 pb-0">
                                            <span class="text-[10px] text-error font-bold">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div>

                                <!-- Deadline Field -->
                                <div class="form-control">
                                    <label class="label px-1 pt-0 pb-2">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/30">Target
                                            Deadline</span>
                                    </label>
                                    <input type="date" name="deadline" id="deadline" onchange="syncEditSummary()"
                                        class="input input-lg w-full h-14 bg-base-200/30 border-none rounded-2xl focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm"
                                        value="{{ old('deadline', $project->deadline ? $project->deadline->format('Y-m-d') : '') }}" />
                                    @error('deadline')
                                        <label class="label px-1 pt-2 pb-0">
                                            <span class="text-[10px] text-error font-bold">{{ $message }}</span>
                                        </label>
                                    @enderror
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
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Project
                                        ID</span>
                                    <p class="text-sm font-bold text-base-content truncate">#{{ $project->id }}</p>
                                </div>
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Team
                                        Size</span>
                                    <p id="summary-team" class="text-sm font-bold text-base-content truncate">
                                        {{ $project->members->count() }} Members
                                    </p>
                                </div>
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Deadline</span>
                                    <p id="summary-deadline" class="text-sm font-bold text-base-content truncate">
                                        {{ $project->deadline ? $project->deadline->format('M d, Y') : '—' }}
                                    </p>
                                </div>
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Current
                                        State</span>
                                    <p id="summary-status" class="text-sm font-bold text-base-content truncate">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </p>
                                </div>
                                <div class="col-span-2 space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Project
                                        Name</span>
                                    <p id="summary-title" class="text-sm font-bold text-base-content line-clamp-1">
                                        {{ $project->name }}
                                    </p>
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
                            <a href="{{ route('projects.show', $project) }}"
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
            const deadline = document.getElementById('deadline').value;
            const statusSelect = document.getElementById('status');
            const membersSelect = document.getElementById('members');

            document.getElementById('summary-title').textContent = name || '—';

            if (deadline) {
                const date = new Date(deadline);
                document.getElementById('summary-deadline').textContent = date.toLocaleDateString(undefined, {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
            } else {
                document.getElementById('summary-deadline').textContent = '—';
            }

            if (statusSelect) {
                const selectedStatusOption = statusSelect.options[statusSelect.selectedIndex];
                const statusText = selectedStatusOption ? selectedStatusOption.text : 'Planning';

                const summaryStatus = document.getElementById('summary-status');
                if (summaryStatus) {
                    summaryStatus.textContent = statusText;
                }
            }

            if (membersSelect) {
                const count = Array.from(membersSelect.options).filter(opt => opt.selected).length;
                const summaryTeam = document.getElementById('summary-team');
                if (summaryTeam) {
                    summaryTeam.textContent = count + ' Members';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Initialize FlyonUI select components
            if (window.HSStaticMethods) {
                window.HSStaticMethods.autoInit(['select']);
            }

            // Set up event listeners
            const inputs = ['name', 'deadline', 'status', 'members'];
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