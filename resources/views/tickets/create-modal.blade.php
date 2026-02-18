<div id="ticket-create-modal" class="overlay modal overlay-open:opacity-100 hidden" role="dialog" tabindex="-1">
    <div class="modal-dialog overlay-open:opacity-100">
        <div class="modal-content overflow-hidden border border-base-content/5 shadow-2xl rounded-3xl bg-base-100">
            <div
                class="card-header bg-base-100 border-b border-base-200/50 px-6 py-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div
                        class="size-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary shadow-sm border border-primary/10">
                        <span class="icon-[tabler--ticket] size-6"></span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-base-content">Submit New Ticket</h3>
                        <p class="text-[10px] uppercase font-bold tracking-widest text-base-content/40">Report an issue
                            or
                            request support</p>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-circle btn-ghost" data-overlay="#ticket-create-modal">
                    <span class="icon-[tabler--x] size-5"></span>
                </button>
            </div>

            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <!-- Project Selection -->
                    <div class="form-control">
                        <x-ui.advance-select name="project_id" id="modal_project_id" label="RELATED PROJECT"
                            placeholder="Select Project" :multiple="false" onchange="filterModalMembers()" required
                            :options="$projects->map(fn($p) => [
                                'value' => $p->id, 
                                'label' => $p->name, 
                                'description' => $p->client_name ?? 'Internal Project', 
                                'icon' => '<span class=\" icon-[tabler--briefcase] size-5 text-primary\"></span>'
                            ])->toArray()"
                            />
                    </div>

                    <!-- Assign To Member -->
                    <div class="form-control">
                        <x-ui.advance-select name="assigned_to" id="modal_assigned_to" label="ASSIGN TO"
                            placeholder="Select Member" :multiple="false" required :options="[]" />

                        <!-- Escalation Toggle -->
                        <div
                            class="bg-base-200/30 rounded-xl p-2.5 mt-2 flex items-center justify-between border border-base-content/5">
                            <span
                                class="text-[9px] font-bold uppercase text-base-content/40 pl-1 tracking-widest">Emergency
                                Escalation?</span>
                            <input type="checkbox" id="modal_escalate" class="switch switch-primary switch-sm"
                                onchange="toggleModalEscalation()" />
                        </div>
                    </div>
                </div>

                <!-- Title -->
                <div class="form-control mb-5">
                    <label class="label pb-1.5 pt-0">
                        <span
                            class="text-[10px] uppercase font-bold tracking-widest text-base-content/50 flex items-center gap-1.5 ml-1">
                            <span class="icon-[tabler--edit-circle] size-3.5"></span>
                            ISSUE TITLE
                        </span>
                    </label>
                    <input type="text" name="title" required
                        class="input input-lg w-full bg-base-200/50 border-none focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm rounded-xl placeholder:font-medium placeholder:text-base-content/20"
                        placeholder="What's the issue?">
                </div>

                <!-- Description -->
                <div class="form-control mb-6">
                    <label class="label pb-1.5 pt-0">
                        <span
                            class="text-[10px] uppercase font-bold tracking-widest text-base-content/50 flex items-center gap-1.5 ml-1">
                            <span class="icon-[tabler--align-left] size-3.5"></span>
                            DETAILED DESCRIPTION
                        </span>
                    </label>
                    <textarea name="description" rows="4" required
                        class="textarea textarea-lg w-full bg-base-200/50 border-none focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm rounded-xl placeholder:font-medium placeholder:text-base-content/20 min-h-[100px]"
                        placeholder="Describe the issue in detail..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Priority -->
                    <div class="form-control">
                        <x-ui.advance-select name="priority" label="PRIORITY LEVEL" placeholder="Select Priority"
                            :multiple="false" required :selected="'medium'" :options="[
        ['value' => 'low', 'label' => 'Low Priority', 'icon' => '<span class=\"icon-[tabler--circle-check] size-5 text-success\"></span>'],
        ['value' => 'medium', 'label' => 'Medium Priority', 'icon' => '<span class=\"icon-[tabler--alert-circle] size-5 text-warning\"></span>'],
        ['value' => 'high', 'label' => 'High Priority', 'icon' => '<span class=\"icon-[tabler--alert-triangle] size-5 text-error animate-pulse\"></span>'],
    ]" />
                    </div>

                    <!-- Category -->
                    <div class="form-control">
                        <x-ui.advance-select name="category" label="CATEGORY" placeholder="Select Category"
                            :multiple="false" required :options="[
                                ['value' => 'Bug', 'label' => 'Bug Report', 'icon' => '<span class=\"
                            icon-[tabler--bug] size-5 text-error\"></span>'],
                            ['value' => 'Feature Request', 'label' => 'Feature Request', 'icon' => '<span
                                class=\"icon-[tabler--star] size-5 text-warning\"></span>'],
                            ['value' => 'Technical Support', 'label' => 'Technical Support', 'icon' => '<span
                                class=\"icon-[tabler--headset] size-5 text-info\"></span>'],
                            ['value' => 'Other', 'label' => 'Other', 'icon' => '<span
                                class=\"icon-[tabler--dots-circle-horizontal] size-5 text-neutral\"></span>'],
                            ]"
                            />
                    </div>
                </div>

                <!-- Attachment -->
                <div class="form-control mb-8">
                    <label class="label pb-1.5 pt-0">
                        <span
                            class="text-[10px] uppercase font-bold tracking-widest text-base-content/50 flex items-center gap-1.5 ml-1">
                            <span class="icon-[tabler--paperclip] size-3.5"></span>
                            ATTACH EVIDENCE (OPTIONAL)
                        </span>
                    </label>
                    <label
                        class="flex flex-col items-center justify-center w-full h-28 border border-base-content/10 border-dashed rounded-2xl cursor-pointer bg-base-200/30 hover:bg-base-200/50 transition-all group/upload">
                        <div class="flex flex-col items-center justify-center py-4">
                            <span
                                class="icon-[tabler--cloud-upload] size-7 text-base-content/20 group-hover/upload:text-primary transition-colors mb-2"></span>
                            <p class="text-[10px] font-bold uppercase text-base-content/40 tracking-widest">Select
                                files
                                for upload</p>
                            <p class="text-[9px] text-base-content/20 mt-1">Images, PDF, DOC (Max 10MB)</p>
                        </div>
                        <input type="file" name="attachment" class="hidden" accept="image/*,.pdf,.doc,.docx" />
                    </label>
                </div>

                <div class="pt-6 flex items-center justify-end gap-3 border-t border-base-content/5">
                    <button type="button"
                        class="btn btn-ghost font-bold uppercase tracking-widest text-[10px] rounded-xl px-6"
                        data-overlay="#ticket-create-modal">Discard</button>
                    <button type="submit"
                        class="btn btn-primary px-10 rounded-xl font-bold uppercase tracking-widest shadow-lg shadow-primary/20">
                        <span class="icon-[tabler--send] size-4"></span>
                        Launch Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function filterModalMembers() {
        const projectSelect = document.getElementById('modal_project_id');
        const memberSelect = document.getElementById('modal_assigned_to');
        const escalateCheckbox = document.getElementById('modal_escalate');

        if (!projectSelect.value) return;

        // Since we upgraded to advance-select, we need to find the project in our local data
        const projectsData = @json($projects->keyBy('id'));
        const selectedProject = projectsData[projectSelect.value];
        const members = selectedProject ? selectedProject.members : [];

        // Clear current options
        memberSelect.innerHTML = '<option value="">Select Member</option>';

        const usersSource = escalateCheckbox.checked ? (window.allSystemUsers || []) : members;

        usersSource.forEach(user => {
            const status = (user.current_status || 'available').toLowerCase();

            if (!escalateCheckbox.checked && status !== 'available') {
                return;
            }

            const option = document.createElement('option');
            option.value = user.id;

            let statusLabel = 'AVAILABLE';
            if (status === 'on_leave' || status === 'away') statusLabel = 'ON LEAVE';
            else if (status === 'busy') statusLabel = 'BUSY';
            else if (status === 'available') statusLabel = 'AVAILABLE';

            // Add data-select-option for premium look
            const avatar = user.profile_photo_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=random`;
            option.setAttribute('data-select-option', JSON.stringify({
                description: `${statusLabel} • ${user.email}`,
                icon: `<img class="w-full h-full object-cover" src="${avatar}" />`
            }));

            option.text = user.name + ` (${statusLabel})`;
            memberSelect.appendChild(option);
        });

        // Re-initialize FlyonUI Select for assigned_to
        if (window.HSSelect) {
            const selectInstance = HSSelect.getInstance(memberSelect);
            if (selectInstance) {
                selectInstance.destroy();
            }
            new HSSelect(memberSelect);
        }
    }

    function toggleModalEscalation() {
        filterModalMembers();
    }
</script>
