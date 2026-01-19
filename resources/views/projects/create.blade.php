<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center justify-between">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('projects.index') }}"
                        class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                        <span
                            class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">←
                            BACK TO PROJECTS</span>
                    </a>
                    <div
                        class="badge badge-lg font-bold text-[10px] uppercase tracking-widest bg-base-200/50 text-base-content/50 border-0">
                        New Project</div>
                </div>

                <div class="flex items-center gap-4 px-1">
                    <div
                        class="size-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shadow-sm border border-primary/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                            <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                            <path d="M12 12l0 .01" />
                            <path d="M3 13a20 20 0 0 0 18 0" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-base-content tracking-tight">Create Project</h1>
                        <p class="text-sm font-medium text-base-content/60 mt-0.5">Start a new project to collaborate
                            with your team.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-6 py-8">
        <form action="{{ route('projects.store') }}" method="POST" id="project-form">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- Left Column: Form -->
                <div class="lg:col-span-8">
                    <div
                        class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-[2rem] overflow-hidden">

                        <!-- Card Header -->
                        <div class="px-8 py-6 border-b border-base-content/5 bg-base-100 flex items-center gap-4">
                            <div
                                class="size-10 rounded-xl bg-primary text-primary-content flex items-center justify-center shadow-lg shadow-primary/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-base-content tracking-tight">Project Details</h3>
                                <p class="text-xs font-medium text-base-content/40">Enter project information</p>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-8 space-y-8">

                            <!-- Project Name Input -->
                            <div class="form-control w-full">
                                <label class="label px-1 pt-0 pb-2">
                                    <span
                                        class="text-[10px] font-black uppercase tracking-widest text-base-content/30">Project
                                        Name</span>
                                </label>
                                <input type="text" name="name" id="name" oninput="updateSummary()"
                                    placeholder="e.g. Website Redesign"
                                    class="input input-lg w-full h-16 bg-base-200/30 border-none rounded-2xl focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-lg placeholder:text-base-content/20 placeholder:font-bold"
                                    required />
                            </div>

                            <!-- Description Input -->
                            <div class="form-control w-full">
                                <label class="label px-1 pt-0 pb-2">
                                    <span
                                        class="text-[10px] font-black uppercase tracking-widest text-base-content/30">Description</span>
                                </label>
                                <textarea name="description" id="description" rows="6" oninput="updateSummary()"
                                    placeholder="Describe the project..."
                                    class="textarea w-full bg-base-200/30 border-none rounded-2xl focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-medium text-base placeholder:text-base-content/20 placeholder:font-bold resize-none leading-relaxed p-5"></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                                <!-- Status Select -->
                                <div class="form-control w-full">
                                    <label class="label px-1 pt-0 pb-2">
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest text-base-content/30">Status</span>
                                    </label>
                                    <div class="relative">
                                        <select name="status" id="status" onchange="updateSummary()"
                                            class="select select-lg w-full h-14 bg-base-200/30 border border-base-content/10 rounded-2xl focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm">
                                            <option value="planning" selected>Planning</option>
                                            <option value="active">Active</option>
                                            <option value="on_hold">On Hold</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Team Members Select -->
                                <div class="form-control w-full">
                                    <x-ui.advance-select name="members" id="members" label="Team Members"
                                        placeholder="Add members..." :multiple="true" :options="$users->map(fn($u) => [
        'value' => $u->id,
        'label' => $u->name,
        'description' => $u->email,
        'image' => $u->profile_photo_url
    ])->toArray()" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end gap-4 mt-6">
                        <a href="{{ route('projects.index') }}"
                            class="btn bg-base-200 hover:bg-base-300 text-base-content border-none font-bold rounded-xl">
                            Cancel
                        </a>
                        <button type="submit"
                            class="btn btn-primary h-12 px-8 rounded-xl font-black uppercase tracking-widest text-xs shadow-xl shadow-primary/25 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            Create Project
                        </button>
                    </div>
                </div>

                <!-- Right Column: Preview -->
                <div class="lg:col-span-4 sticky top-8">
                    <div class="text-[10px] font-black uppercase tracking-[0.2em] text-primary/40 mb-3 px-1">Preview
                    </div>

                    <div
                        class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-[2.5rem] overflow-hidden p-8 min-h-[400px] flex flex-col justify-between relative group">

                        <!-- Decorative top glow -->
                        <div
                            class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-b from-primary/5 to-transparent pointer-events-none opacity-50">
                        </div>

                        <div class="space-y-6 relative z-10">
                            <div class="flex items-start justify-between">
                                <div
                                    class="size-12 rounded-2xl bg-base-200/50 flex items-center justify-center text-primary border border-base-content/5 shadow-sm group-hover:scale-110 transition-transform duration-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                        <path d="M12 12l0 .01" />
                                        <path d="M3 13a20 20 0 0 0 18 0" />
                                    </svg>
                                </div>
                                <div
                                    class="badge badge-sm bg-base-200 border-0 text-[10px] font-black uppercase tracking-widest text-base-content/30">
                                    Preview Mode</div>
                            </div>

                            <div class="space-y-2">
                                <h4 id="preview-name"
                                    class="text-2xl font-black text-base-content/20 italic leading-tight break-words transition-all">
                                    Project Name Needed</h4>
                                <p id="preview-description"
                                    class="text-sm text-base-content/20 font-medium italic leading-relaxed break-words transition-all line-clamp-4">
                                    Project description will appear here...</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mt-8 pt-8 border-t border-base-content/5 relative z-10">
                            <div
                                class="bg-base-200/30 rounded-2xl p-4 text-center border border-base-content/5 transition-colors hover:bg-base-200/50">
                                <div class="text-[9px] font-black uppercase tracking-widest text-base-content/30 mb-2">
                                    Status</div>
                                <div id="preview-status"
                                    class="badge badge-lg border-0 bg-base-300 text-base-content/40 font-bold uppercase text-[10px] px-3 shadow-sm">
                                    Planning</div>
                            </div>
                            <div
                                class="bg-base-200/30 rounded-2xl p-4 text-center border border-base-content/5 transition-colors hover:bg-base-200/50">
                                <div class="text-[9px] font-black uppercase tracking-widest text-base-content/30 mb-2">
                                    Team</div>
                                <div id="preview-members" class="text-xs font-bold text-base-content/30 italic">No
                                    Members</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        function updateSummary() {
            const name = document.getElementById('name').value;
            const desc = document.getElementById('description').value;
            const statusEl = document.getElementById('status');
            const statusValue = statusEl.value;
            const membersEl = document.getElementById('members');

            // Update Preview Name
            const pName = document.getElementById('preview-name');
            if (name) {
                pName.textContent = name;
                pName.className = 'text-2xl font-black text-base-content leading-tight break-words transition-all';
            } else {
                pName.textContent = 'Project Name Needed';
                pName.className = 'text-2xl font-black text-base-content/20 italic leading-tight break-words transition-all';
            }

            // Update Preview Desc
            const pDesc = document.getElementById('preview-description');
            if (desc) {
                pDesc.textContent = desc;
                pDesc.className = 'text-sm text-base-content/70 font-medium leading-relaxed break-words transition-all line-clamp-4';
            } else {
                pDesc.textContent = 'Project description will appear here...';
                pDesc.className = 'text-sm text-base-content/20 font-medium italic leading-relaxed break-words transition-all';
            }

            // Update Preview Status
            const pStatus = document.getElementById('preview-status');
            const pStatusText = statusEl.options[statusEl.selectedIndex].text;
            pStatus.textContent = pStatusText;

            pStatus.className = 'badge badge-lg border-0 font-bold uppercase text-[10px] px-3 shadow-sm transition-all';

            if (statusValue === 'active') {
                pStatus.classList.add('bg-success/10', 'text-success', 'shadow-success/20');
            } else if (statusValue === 'planning') {
                pStatus.classList.add('bg-primary/10', 'text-primary', 'shadow-primary/20');
            } else if (statusValue === 'on_hold') {
                pStatus.classList.add('bg-warning/10', 'text-warning');
            } else if (statusValue === 'completed') {
                pStatus.classList.add('bg-base-content', 'text-base-100');
            } else {
                pStatus.classList.add('bg-base-300', 'text-base-content/40');
            }

            // Update Members
            const pMembers = document.getElementById('preview-members');
            // Check if Tom Select is used (it replaces the original select)
            let memberCount = 0;
            if (membersEl.tomselect) {
                memberCount = membersEl.tomselect.items.length;
            } else {
                memberCount = Array.from(membersEl.selectedOptions).filter(opt => opt.value).length;
            }

            if (memberCount > 0) {
                pMembers.textContent = `${memberCount} Member${memberCount > 1 ? 's' : ''}`;
                pMembers.className = 'text-xs font-black text-base-content transition-all';
            } else {
                pMembers.textContent = 'No Members';
                pMembers.className = 'text-xs font-bold text-base-content/30 italic transition-all';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Helper to handle both native and TomSelect changes
            const membersEl = document.getElementById('members');
            if (membersEl) {
                // If Tom select is initialized later, we might need a MutationObserver or a delay.
                // For now, let's assume standard event listeners or our advance-select component handles it.
                // advance-select usually fires 'change' on the original select.
                membersEl.addEventListener('change', updateSummary);
            }

            // Initial update
            setTimeout(updateSummary, 100);
        });
    </script>
</x-app-layout>