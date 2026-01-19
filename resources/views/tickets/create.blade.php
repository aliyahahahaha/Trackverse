<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 lg:px-10 py-12">
        <!-- Header Section -->
        <header class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('tickets.index') }}"
                        class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                        <span
                            class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">←
                            BACK TO TICKETS</span>
                    </a>
                    <div class="h-5 w-px bg-base-content/10"></div>
                    <span class="text-[10px] font-bold text-base-content/40 uppercase tracking-[0.2em]">Ticket
                        Details</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-base-content tracking-tight flex items-center gap-3">
                        <div class="size-12 rounded-xl flex items-center justify-center bg-primary/10 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </div>
                        Create Ticket
                    </h1>
                    <p class="text-sm text-base-content/60 font-bold mt-2 ml-1">Create a new ticket for your team.</p>
                </div>
            </div>
        </header>

        <script>
            window.allSystemUsers = @json($allUsers);
        </script>

        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Top Section: 2 Columns (Project & Member) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Project Selection -->
                    <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm p-6">
                        <div class="flex flex-col gap-6">
                            <div class="space-y-1.5">
                                <h3 class="text-sm font-bold text-base-content">Project</h3>
                                <p class="text-[11px] text-base-content/50 font-medium leading-none">Select the project
                                </p>
                            </div>

                            @php
                                $projectOptions = $projects->map(fn($p) => [
                                    'value' => $p->id,
                                    'label' => $p->name,
                                    'description' => $p->status,
                                    'icon' => '<div class="size-5 rounded flex items-center justify-center bg-primary/10 text-primary"><svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /></svg></div>'
                                ])->toArray();
                            @endphp
                            <x-ui.advance-select name="project_id" id="modal_project_id"
                                placeholder="Choose a project..." :options="$projectOptions" :multiple="false" />
                        </div>
                    </div>

                    <!-- Assign To Member -->
                    <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm p-6">
                        <div class="flex flex-col gap-6">
                            <div id="assignee-container" class="flex flex-col gap-3">
                                <div class="flex items-center justify-between">
                                    <div class="space-y-1">
                                        <h3 class="text-sm font-bold text-base-content">Assignee</h3>
                                        <p class="text-[10px] text-base-content/40 font-medium leading-none">Choose who
                                            will handle this</p>
                                    </div>
                                    <!-- Smart Assignment Toggle -->
                                    <div
                                        class="flex items-center gap-2 bg-base-200/50 px-2 pointer-events-auto shadow-sm py-1 rounded-lg border border-base-content/5">
                                        <div class="flex flex-col items-end mr-1">
                                            <span
                                                class="text-[8px] font-bold text-base-content/40 uppercase tracking-tighter">Smart</span>
                                            <span
                                                class="text-[8px] text-primary font-black italic leading-none">Escalate</span>
                                        </div>
                                        <input type="checkbox" id="modal_escalate"
                                            class="toggle toggle-primary toggle-xs"
                                            onchange="toggleModalEscalation()" />
                                    </div>
                                </div>

                                <div id="assignee-select-wrapper" class="w-full relative min-h-[40px]">
                                    <x-ui.advance-select name="assigned_to" id="modal_assigned_to"
                                        placeholder="Choose team member..." :options="[]" :multiple="false" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Section: Main Content Card -->
                <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-base-content/5">
                        <h3
                            class="text-sm font-bold text-base-content italic text-primary/60 uppercase tracking-[0.2em] mb-3">
                            01. Ticket Details</h3>
                        <div class="space-y-6">
                            <!-- Title -->
                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Ticket
                                    Title</label>
                                <input type="text" name="title" required
                                    class="input bg-base-200/30 border-base-content/10 w-full rounded-xl transition-all font-bold text-base placeholder:text-base-content/20 focus:bg-base-100 focus:border-primary focus:ring-4 focus:ring-primary/5"
                                    placeholder="Enter title..." />
                            </div>

                            <!-- Description -->
                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Description</label>
                                <textarea name="description" rows="6" required
                                    class="textarea bg-base-200/30 border-base-content/10 w-full rounded-2xl transition-all font-medium text-sm leading-relaxed resize-none focus:bg-base-100 focus:border-primary focus:ring-4 focus:ring-primary/5 h-48"
                                    placeholder="Provide detailed description..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3
                            class="text-sm font-bold text-base-content italic text-success/60 uppercase tracking-[0.2em] mb-4">
                            02. Priority & Classification</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                            <!-- Priority Levels -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between mb-2">
                                    <label
                                        class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Priority</label>
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-[10px] text-base-content/30 italic">Active selection:</span>
                                        <span id="priority-display"
                                            class="badge badge-sm badge-warning font-bold uppercase text-[9px] tracking-widest h-5">medium</span>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    @foreach(['low' => ['color' => 'success', 'desc' => 'Minor issue, low impact'], 'medium' => ['color' => 'warning', 'desc' => 'Standard priority issue'], 'high' => ['color' => 'error', 'desc' => 'Critical blocker, immediate action']] as $val => $data)
                                        <label
                                            class="relative flex items-center p-4 pr-10 rounded-2xl ring-1 ring-base-content/5 cursor-pointer hover:bg-base-200/30 transition-all peer-checked:bg-{{ $data['color'] }}/5 peer-checked:ring-{{ $data['color'] }}/30 group has-[:checked]:bg-{{ $data['color'] }}/5 has-[:checked]:ring-{{ $data['color'] }}/30 overflow-hidden">
                                            <input type="radio" name="priority" value="{{ $val }}" {{ $val === 'medium' ? 'checked' : '' }} class="peer hidden" />
                                            <div class="flex items-center gap-4 w-full">
                                                <div
                                                    class="relative size-5 rounded-full ring-2 ring-base-content/10 flex items-center justify-center p-1 transition-all group-hover:ring-{{ $data['color'] }}/50 peer-checked:ring-{{ $data['color'] }} group-has-[:checked]:ring-{{ $data['color'] }}">
                                                    <div
                                                        class="size-full rounded-full bg-{{ $data['color'] }} scale-0 peer-checked:scale-100 group-has-[:checked]:scale-100 transition-transform shadow-lg shadow-{{ $data['color'] }}/50">
                                                    </div>
                                                </div>
                                                <div class="flex items-center justify-between flex-grow">
                                                    <div>
                                                        <p class="text-sm font-bold text-base-content capitalize">{{ $val }}
                                                            Priority</p>
                                                        <p class="text-[10px] text-base-content/40 font-medium mt-0.5">
                                                            {{ $data['desc'] }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="badge badge-{{ $data['color'] }} badge-xs h-1 font-bold rounded-full w-8 opacity-20">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Selected Check Mark -->
                                            <div
                                                class="absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-has-[:checked]:opacity-100 transition-opacity text-{{ $data['color'] }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="4"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Category & Attachment -->
                            <div class="space-y-6">
                                <div class="space-y-3">
                                    <label
                                        class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Category</label>
                                    @php
                                        $categoryOptions = [
                                            ['value' => 'Bug', 'label' => 'Bug Report', 'icon' => '<div class="size-5 rounded flex items-center justify-center text-[10px] bg-error/10 text-error font-black italic">!</div>'],
                                            ['value' => 'Feature Request', 'label' => 'Feature Request', 'icon' => '<div class="size-5 rounded flex items-center justify-center text-[10px] bg-info/10 text-info font-black italic">+</div>'],
                                            ['value' => 'Technical Support', 'label' => 'Technical Support', 'icon' => '<div class="size-5 rounded flex items-center justify-center text-[10px] bg-warning/10 text-warning font-black italic">?</div>'],
                                            ['value' => 'Other', 'label' => 'Other', 'icon' => '<div class="size-5 rounded flex items-center justify-center text-[10px] bg-base-content/10 text-base-content font-black italic">•</div>']
                                        ];
                                    @endphp
                                    <x-ui.advance-select name="category" placeholder="Choose category..."
                                        :options="$categoryOptions" :multiple="false" />
                                </div>

                                <div class="space-y-3">
                                    <label
                                        class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Attachments</label>
                                    <label for="attachment"
                                        class="flex flex-col items-center justify-center w-full h-32 bg-base-200/20 border-2 border-base-content/10 border-dashed rounded-2xl cursor-pointer hover:bg-base-100 hover:border-primary/40 transition-all group/upload relative overflow-hidden"
                                        id="attachment-area">
                                        <div class="flex flex-col items-center justify-center space-y-2"
                                            id="attachment-placeholder">
                                            <div
                                                class="size-8 rounded-xl bg-base-100 flex items-center justify-center text-base-content/20 group-hover/upload:text-primary transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                    <path d="M7 9l5 -5l5 5" />
                                                    <path d="M12 4l0 12" />
                                                </svg>
                                            </div>
                                            <p
                                                class="text-[11px] font-bold text-base-content/40 uppercase tracking-widest">
                                                Upload Files</p>
                                        </div>
                                        <div class="hidden flex-col items-center justify-center"
                                            id="attachment-preview">
                                            <div
                                                class="size-8 rounded-xl bg-success/10 text-success flex items-center justify-center mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                            <p class="text-[11px] font-bold text-base-content truncate px-4"
                                                id="filename-display"></p>
                                        </div>
                                        <input type="file" name="attachment" id="attachment" class="hidden"
                                            accept="image/*,.pdf,.doc,.docx" onchange="updateFileName(this)" />
                                    </label>
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
                                Summary
                            </h3>
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-12">
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-[0.2em] italic leading-none">Project</span>
                                    <p id="summary-project" class="text-sm font-bold text-base-content truncate">—</p>
                                </div>
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-[0.2em] italic leading-none">Assignee</span>
                                    <p id="summary-member" class="text-sm font-bold text-base-content truncate">—</p>
                                </div>
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-[0.2em] italic leading-none">Priority</span>
                                    <div><span id="summary-priority"
                                            class="badge badge-sm font-bold uppercase text-[9px] tracking-widest h-5 py-0 border-0">—</span>
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-[0.2em] italic leading-none">Category</span>
                                    <p id="summary-category" class="text-xs font-bold text-base-content">—</p>
                                </div>
                                <div class="col-span-2 space-y-1.5">
                                    <span
                                        class="text-[9px] font-bold text-base-content/30 uppercase tracking-[0.2em] italic leading-none">Title</span>
                                    <p id="summary-title" class="text-sm font-bold text-base-content line-clamp-1">—</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-center lg:items-end gap-3 min-w-[240px]">
                            <button type="submit"
                                class="btn btn-primary btn-lg rounded-2xl w-full px-12 group shadow-2xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all h-16 border-0">
                                <span class="flex items-center gap-3 font-black uppercase tracking-[0.2em] text-xs">
                                    Create Ticket
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
                            <p class="text-[10px] font-bold text-base-content/30 italic">Please review before creating
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Dynamic Member Filtering Script -->
    <script>
        // Store project and system user data
        const projectsData = @json($projects->keyBy('id')->toArray());
        window.allSystemUsers = @json($allUsers);

        function filterModalMembers() {
            const pEl = document.getElementById('modal_project_id');
            const mEl = document.getElementById('modal_assigned_to');
            const eEl = document.getElementById('modal_escalate');

            if (!pEl || !mEl || !window.HSSelect) return;

            const pId = pEl.value;

            // Clear existing options
            mEl.innerHTML = '<option value="">Choose team member...</option>';

            if (pId && projectsData[pId]) {
                const project = projectsData[pId];
                const members = project.members ? (Array.isArray(project.members) ? project.members : Object.values(project.members)) : [];
                const source = (eEl && eEl.checked) ? (window.allSystemUsers || []) : members;

                source.forEach(user => {
                    if (!user || !user.id) return;
                    const opt = document.createElement('option');
                    opt.value = user.id;
                    opt.text = user.name || 'Unknown';
                    const avatar = user.profile_photo_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(opt.text)}&background=random`;
                    opt.setAttribute('data-select-option', JSON.stringify({
                        description: user.email || '',
                        icon: `<img class="w-full h-full object-cover rounded" src="${avatar}" />`
                    }));
                    if (user.today_availability) {
                        const s = user.today_availability.status;
                        if (s === 'medical_leave') opt.text += ' (Leave)';
                        else if (s === 'vacation') opt.text += ' (Vacation)';
                        else if (s === 'present') opt.text += ' (Available)';
                    }
                    mEl.appendChild(opt);
                });
            }

            // Refresh the UI
            refreshMemberSelect();
        }

        function refreshMemberSelect() {
            const el = document.getElementById('modal_assigned_to');
            if (!el || !window.HSSelect) return;

            try {
                // 1. Destroy existing instance completely
                const instance = HSSelect.getInstance(el);
                if (instance) {
                    instance.destroy();
                }

                // 2. Remove all generated UI elements (siblings of the select)
                const parent = el.parentNode;
                if (parent) {
                    const siblings = Array.from(parent.children).filter(c => c !== el);
                    siblings.forEach(s => s.remove());
                }

                // 3. Get the configuration
                const configStr = el.getAttribute('data-select');
                const config = configStr ? JSON.parse(configStr) : {};

                // 4. Make sure the select is visible for initialization
                el.classList.remove('hidden');
                el.style.display = '';

                // 5. Reinitialize with a slight delay to ensure DOM is ready
                setTimeout(() => {
                    const newInstance = new HSSelect(el, config);
                    
                    // 6. Add manual handlers to ensure dropdown works properly
                    setTimeout(() => {
                        const toggle = parent.querySelector('.advance-select-toggle, button[data-hs-select-toggle]');
                        const menu = parent.querySelector('.advance-select-menu, .hs-select-menu');
                        
                        if (toggle && menu) {
                            // Add toggle click handler
                            toggle.addEventListener('click', function(e) {
                                const isHidden = menu.classList.contains('hidden') || 
                                               getComputedStyle(menu).display === 'none';
                                
                                if (isHidden) {
                                    menu.classList.remove('hidden');
                                    menu.style.display = 'block';
                                    menu.style.opacity = '1';
                                    menu.style.visibility = 'visible';
                                    toggle.setAttribute('aria-expanded', 'true');
                                } else {
                                    menu.classList.add('hidden');
                                    menu.style.display = 'none';
                                    toggle.setAttribute('aria-expanded', 'false');
                                }
                            });
                            
                            // Handle option clicks
                            const options = menu.querySelectorAll('.advance-select-option, [data-value]');
                            options.forEach(option => {
                                option.addEventListener('click', function(e) {
                                    const value = this.getAttribute('data-value');
                                    if (value) {
                                        el.value = value;
                                        el.dispatchEvent(new Event('change', { bubbles: true }));
                                        
                                        // Close the menu
                                        menu.classList.add('hidden');
                                        menu.style.display = 'none';
                                        toggle.setAttribute('aria-expanded', 'false');
                                        
                                        // Update summary
                                        if (typeof syncSummary === 'function') syncSummary();
                                    }
                                });
                            });
                            
                            // Close dropdown when clicking outside
                            document.addEventListener('click', function closeDropdown(e) {
                                if (!parent.contains(e.target)) {
                                    menu.classList.add('hidden');
                                    menu.style.display = 'none';
                                    toggle.setAttribute('aria-expanded', 'false');
                                }
                            });
                        }
                        
                        // Update summary
                        if (typeof syncSummary === 'function') syncSummary();
                    }, 100);
                }, 150);
            } catch (err) {
                console.error('Refresh error:', err);
            }
        }

        function toggleModalEscalation() { filterModalMembers(); }

        function updateFileName(input) {
            const placeholder = document.getElementById('attachment-placeholder');
            const preview = document.getElementById('attachment-preview');
            const display = document.getElementById('filename-display');
            const area = document.getElementById('attachment-area');

            if (input.files && input.files[0]) {
                display.textContent = input.files[0].name;
                placeholder.classList.add('hidden');
                preview.classList.remove('hidden');
                preview.classList.add('flex');
                area.classList.add('border-success/30', 'bg-success/5');
            } else {
                placeholder.classList.remove('hidden');
                preview.classList.add('hidden');
                area.classList.remove('border-success/30', 'bg-success/5');
            }
        }

        function syncSummary() {
            const titleInput = document.querySelector('input[name="title"]');
            document.getElementById('summary-title').textContent = titleInput.value || '—';

            const projectSelect = document.getElementById('modal_project_id');
            const pSelected = projectSelect.options[projectSelect.selectedIndex];
            document.getElementById('summary-project').textContent = (pSelected && pSelected.value) ? pSelected.text : '—';

            const memberSelect = document.getElementById('modal_assigned_to');
            const summaryMember = document.getElementById('summary-member');
            if (memberSelect && summaryMember) {
                const mSelected = memberSelect.options[memberSelect.selectedIndex];
                summaryMember.textContent = (mSelected && mSelected.value) ? mSelected.text : '—';
            }

            const categorySelect = document.querySelector('select[name="category"]');
            const cSelected = categorySelect.options[categorySelect.selectedIndex];
            document.getElementById('summary-category').textContent = (cSelected && cSelected.value) ? cSelected.text : '—';

            const selectedPriority = document.querySelector('input[name="priority"]:checked');
            const summaryPriority = document.getElementById('summary-priority');
            if (selectedPriority) {
                summaryPriority.textContent = selectedPriority.value;
                summaryPriority.className = 'badge badge-sm font-bold uppercase text-[9px] tracking-widest h-5 py-0 border-0 badge-' +
                    (selectedPriority.value === 'low' ? 'success' : (selectedPriority.value === 'medium' ? 'warning' : 'error'));
                document.getElementById('priority-display').textContent = selectedPriority.value;
                document.getElementById('priority-display').className = 'badge badge-sm font-bold uppercase text-[9px] tracking-widest h-5 py-0 border-0 badge-' +
                    (selectedPriority.value === 'low' ? 'success' : (selectedPriority.value === 'medium' ? 'warning' : 'error'));
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const projectSelect = document.getElementById('modal_project_id');
            if (projectSelect) {
                projectSelect.addEventListener('change', filterModalMembers);
            }

            document.querySelectorAll('input, select').forEach(el => {
                el.addEventListener('change', syncSummary);
                el.addEventListener('input', syncSummary);
            });
            setTimeout(syncSummary, 500);
        });
    </script>
</x-app-layout>