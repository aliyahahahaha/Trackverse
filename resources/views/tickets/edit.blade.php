<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('tickets.show', $ticket) }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        ← BACK TO TICKET
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        EDIT TICKET
                    </div>
                </div>
            </div>

            <!-- Main Title Content -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="size-16 rounded-[1.5rem] bg-primary shadow-2xl shadow-primary/20 flex items-center justify-center text-primary-content shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Edit Ticket</h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Modify parameters for incident registry item #{{ $ticket->id }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-6 lg:px-10">

        <form action="{{ route('tickets.update', $ticket) }}" method="POST" enctype="multipart/form-data" id="ticket-edit-form">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Top Section: 2 Columns (Context & Member) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Project Info (Context) -->
                    <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm p-6">
                        <div class="flex flex-col gap-6">
                            <div class="space-y-1.5">
                                <h3 class="text-sm font-bold text-base-content">Ticket Origin</h3>
                                <p class="text-[11px] text-base-content/50 font-medium leading-none">This incident is logged under the following project</p>
                            </div>

                            <div class="flex items-center gap-4 bg-base-200/30 p-4 rounded-xl border border-base-content/5">
                                <div class="size-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-base-content">{{ $ticket->project->name }}</p>
                                    <p class="text-[10px] text-base-content/40 font-bold uppercase tracking-widest">{{ $ticket->project->status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assign To Member -->
                    <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm p-6">
                        <div class="flex flex-col gap-6">
                            <div class="space-y-1.5">
                                <h3 class="text-sm font-bold text-base-content">Primary Fixer</h3>
                                <p class="text-[10px] text-base-content/40 font-medium leading-none">Modify the assigned squad member for this ticket</p>
                            </div>

                            <div class="w-full relative">
                                <x-ui.advance-select name="assigned_to" id="assigned_to" placeholder="Select team member..."
                                    :multiple="false" :selected="[$ticket->assigned_to]" :options="$ticket->project->members->map(fn($m) => [
                                        'value' => $m->id,
                                        'label' => $m->name . ' (' . strtoupper($m->current_status) . ')',
                                        'description' => strtoupper($m->current_status) . ' • ' . $m->email,
                                        'image' => $m->profile_photo_url
                                    ])->toArray()" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Section: Main Content Card -->
                <div class="card bg-base-100 rounded-2xl ring-1 ring-base-content/5 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-base-content/5">
                        <h3 class="text-sm font-bold text-base-content italic text-primary/60 uppercase tracking-widest mb-3">
                            01. Core Details</h3>
                        <div class="space-y-6">
                            <!-- Title -->
                            <div class="space-y-3">
                                <label class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Ticket Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $ticket->title) }}" required
                                    class="input bg-base-200/30 border-base-content/10 w-full rounded-xl transition-all font-bold text-base placeholder:text-base-content/20 placeholder:font-black focus:bg-base-100 focus:border-primary focus:ring-4 focus:ring-primary/5"
                                    placeholder="Enter title..." />
                            </div>

                            <!-- Description -->
                            <div class="space-y-3">
                                <label class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Description</label>
                                <textarea name="description" id="description" rows="6" required
                                    class="textarea bg-base-200/30 border-base-content/10 w-full rounded-2xl transition-all font-medium text-sm leading-relaxed resize-none focus:bg-base-100 focus:border-primary focus:ring-4 focus:ring-primary/5 h-48 placeholder:text-base-content/20 placeholder:font-black"
                                    placeholder="Provide detailed description...">{{ old('description', $ticket->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-sm font-bold text-base-content italic text-success/60 uppercase tracking-widest mb-4">
                            02. Status & Classification</h3>
                        
                        <!-- Status Field -->
                        <div class="mb-10">
                             <label class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest mb-3 block">Current Status</label>
                             <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach(['open', 'in_progress', 'resolved', 'closed'] as $st)
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="status" value="{{ $st }}" class="peer hidden" {{ $ticket->status == $st ? 'checked' : '' }}>
                                        <div class="px-4 py-3 rounded-xl bg-base-200/30 border border-base-content/5 text-center font-bold text-xs uppercase tracking-wider text-base-content/50 hover:bg-base-200 transition-all peer-checked:bg-primary peer-checked:text-white peer-checked:shadow-lg peer-checked:shadow-primary/30 peer-checked:border-primary">
                                            {{ str_replace('_', ' ', $st) }}
                                        </div>
                                    </label>
                                @endforeach
                             </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                            <!-- Priority Levels -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Priority</label>
                                </div>
                                <div class="space-y-3">
                                    @foreach(['low' => ['color' => 'success', 'desc' => 'Minor issue, low impact'], 'medium' => ['color' => 'warning', 'desc' => 'Standard priority issue'], 'high' => ['color' => 'error', 'desc' => 'Critical blocker, immediate action']] as $val => $data)
                                        <label class="relative flex items-center p-4 pr-10 rounded-2xl ring-1 ring-base-content/5 cursor-pointer hover:bg-base-200/30 transition-all peer-checked:bg-{{ $data['color'] }}/5 peer-checked:ring-{{ $data['color'] }}/30 group has-[:checked]:bg-{{ $data['color'] }}/5 has-[:checked]:ring-{{ $data['color'] }}/30 overflow-hidden">
                                            <input type="radio" name="priority" value="{{ $val }}" {{ $ticket->priority === $val ? 'checked' : '' }} class="peer hidden" />
                                            <div class="flex items-center gap-4 w-full">
                                                <div class="relative size-5 rounded-full ring-2 ring-base-content/10 flex items-center justify-center p-1 transition-all group-hover:ring-{{ $data['color'] }}/50 peer-checked:ring-{{ $data['color'] }} group-has-[:checked]:ring-{{ $data['color'] }}">
                                                    <div class="size-full rounded-full bg-{{ $data['color'] }} scale-0 peer-checked:scale-100 group-has-[:checked]:scale-100 transition-transform shadow-lg shadow-{{ $data['color'] }}/50"></div>
                                                </div>
                                                <div class="flex items-center justify-between flex-grow">
                                                    <div>
                                                        <p class="text-sm font-bold text-base-content capitalize">{{ $val }} Priority</p>
                                                        <p class="text-[10px] text-base-content/40 font-medium mt-0.5">{{ $data['desc'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Category & Attachment -->
                            <div class="space-y-6">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Category</label>
                                    @php
                                        $categoryOptions = [
                                            ['value' => 'Bug', 'label' => 'Bug Report', 'icon' => '<div class="size-5 rounded flex items-center justify-center text-[10px] bg-error/10 text-error font-bold italic">!</div>'],
                                            ['value' => 'Feature Request', 'label' => 'Feature Request', 'icon' => '<div class="size-5 rounded flex items-center justify-center text-[10px] bg-info/10 text-info font-bold italic">+</div>'],
                                            ['value' => 'Technical Support', 'label' => 'Technical Support', 'icon' => '<div class="size-5 rounded flex items-center justify-center text-[10px] bg-warning/10 text-warning font-bold italic">?</div>'],
                                            ['value' => 'Other', 'label' => 'Other', 'icon' => '<div class="size-5 rounded flex items-center justify-center text-[10px] bg-base-content/10 text-base-content font-bold italic">•</div>']
                                        ];
                                    @endphp
                                    <x-ui.advance-select name="category" id="category" placeholder="Choose category..."
                                        :options="$categoryOptions" :multiple="false" :selected="[$ticket->category]" />
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Attachments</label>
                                    <div class="flex flex-col gap-4">
                                        @if($ticket->attachment_path)
                                            <div class="flex items-center gap-3 p-4 bg-primary/5 rounded-2xl border border-primary/10">
                                                <span class="icon-[tabler--file-check] size-5 text-primary"></span>
                                                <div>
                                                    <p class="text-xs font-bold text-base-content">Existing attachment detected</p>
                                                    <p class="text-[10px] text-base-content/40 font-medium">Uploading a new file will replace it</p>
                                                </div>
                                            </div>
                                        @endif
                                        <label for="attachment" class="flex flex-col items-center justify-center w-full h-32 bg-base-200/20 border-2 border-base-content/10 border-dashed rounded-2xl cursor-pointer hover:bg-base-100 hover:border-primary/40 transition-all group/upload relative overflow-hidden" id="attachment-area">
                                            <div class="flex flex-col items-center justify-center space-y-2" id="attachment-placeholder">
                                                <div class="size-8 rounded-xl bg-base-100 flex items-center justify-center text-base-content/20 group-hover/upload:text-primary transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" />
                                                    </svg>
                                                </div>
                                                <p class="text-[11px] font-bold text-base-content/40 uppercase tracking-widest">Update File</p>
                                            </div>
                                            <div class="hidden flex-col items-center justify-center" id="attachment-preview">
                                                <div class="size-8 rounded-xl bg-success/10 text-success flex items-center justify-center mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10" /></svg>
                                                </div>
                                                <p class="text-[11px] font-bold text-base-content truncate px-4" id="filename-display"></p>
                                            </div>
                                            <input type="file" name="attachment" id="attachment" class="hidden" accept="image/*,.pdf,.doc,.docx" onchange="updateTicketFileName(this)" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary & Final CTA -->
                <div class="card bg-base-200/30 rounded-[2rem] p-8 ring-1 ring-base-content/5 mt-10">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-10">
                        <div class="flex-grow">
                            <h3 class="text-sm font-bold text-base-content uppercase tracking-widest mb-6 italic text-primary/60 flex items-center gap-3">
                                <span class="size-2 rounded-full bg-primary animate-pulse"></span>
                                Incident Change Summary
                            </h3>
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-12">
                                <div class="space-y-1.5">
                                    <span class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Registry #</span>
                                    <p class="text-sm font-bold text-base-content truncate">#{{ $ticket->id }}</p>
                                </div>
                                <div class="space-y-1.5">
                                    <span class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Assignee</span>
                                    <p id="summary-assignee" class="text-sm font-bold text-base-content truncate">—</p>
                                </div>
                                <div class="space-y-1.5">
                                     <span class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Priority</span>
                                     <div>
                                         <span id="summary-priority" class="badge badge-sm font-bold uppercase text-[9px] tracking-widest h-5 py-0 border-0 badge-{{ $ticket->priority == 'low' ? 'success' : ($ticket->priority == 'medium' ? 'warning' : 'error') }}">{{ $ticket->priority }}</span>
                                     </div>
                                </div>
                                <div class="space-y-1.5">
                                    <span class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Category</span>
                                    <p id="summary-category" class="text-sm font-bold text-base-content truncate">—</p>
                                </div>
                                <div class="col-span-2 space-y-1.5">
                                    <span class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest italic leading-none">Updated Title</span>
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
                            <a href="{{ route('tickets.show', $ticket) }}"
                                class="btn bg-[#1e293b] hover:bg-[#334155] h-12 w-full rounded-2xl font-bold uppercase text-[10px] tracking-widest text-white border-none transition-all">
                                CANCEL
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function updateTicketFileName(input) {
            const placeholder = document.getElementById('attachment-placeholder');
            const preview = document.getElementById('attachment-preview');
            const display = document.getElementById('filename-display');
            const area = document.getElementById('attachment-area');

            if (input.files && input.files[0]) {
                display.textContent = input.files[0].name;
                placeholder.classList.add('hidden');
                preview.classList.remove('hidden');
                preview.classList.add('flex');
                if (area) area.classList.add('border-success/30', 'bg-success/5');
            } else {
                placeholder.classList.remove('hidden');
                preview.classList.add('hidden');
                preview.classList.remove('flex');
                if (area) area.classList.remove('border-success/30', 'bg-success/5');
            }
        }

        function syncTicketEditSummary() {
            const title = document.getElementById('title').value;
            document.getElementById('summary-title').textContent = title || '—';
            
            const categorySelect = document.querySelector('select[name="category"]');
            if (categorySelect) {
                const cSelected = categorySelect.options[categorySelect.selectedIndex];
                document.getElementById('summary-category').textContent = (cSelected && cSelected.value) ? cSelected.text : '—';
            }

            const assigneeSelect = document.getElementById('assigned_to');
            if (assigneeSelect) {
                 // Check if it's a native select or if FlyonUI/custom component hides it
                 // If advance-select is used, checking the underlying select usually works
                const selectedOption = assigneeSelect.options[assigneeSelect.selectedIndex];
                document.getElementById('summary-assignee').textContent = (selectedOption && selectedOption.value) ? selectedOption.text : 'Unassigned';
            }

            const selectedPriority = document.querySelector('input[name="priority"]:checked');
            const summaryPriority = document.getElementById('summary-priority');
            if (selectedPriority && summaryPriority) {
                 summaryPriority.textContent = selectedPriority.value;
                 summaryPriority.className = 'badge badge-sm font-bold uppercase text-[9px] tracking-widest h-5 py-0 border-0 badge-' +
                     (selectedPriority.value === 'low' ? 'success' : (selectedPriority.value === 'medium' ? 'warning' : 'error'));
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input, select, textarea').forEach(el => {
                el.addEventListener('input', syncTicketEditSummary);
                el.addEventListener('change', syncTicketEditSummary);
            });
            setTimeout(syncTicketEditSummary, 500);
        });
    </script>
</x-app-layout>
