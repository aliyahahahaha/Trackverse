<x-app-layout>
    <x-slot name="header">
        <x-slot name="header">
            <div class="space-y-6 pb-2">
                <!-- Back Button & Breadcrumb Row (FIXED) -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center">
                        <a href="{{ route('tickets.show', $ticket) }}"
                            class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                            <span
                                class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">←
                                BACK TO TICKET</span>
                        </a>
                    </div>

                    <div class="h-4 w-px bg-base-content/20"></div>

                    <nav
                        class="flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-base-content/40">
                        <ol class="flex items-center gap-2">
                            <li><a href="{{ route('tickets.index') }}"
                                    class="hover:text-primary transition-colors">Tickets</a></li>
                            <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                    style="width: 12px; height: 12px;" class="opacity-30 flex-shrink-0"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 6l6 6l-6 6" />
                                </svg></li>
                            <li><a href="{{ route('tickets.show', $ticket) }}"
                                    class="hover:text-primary transition-colors">{{ $ticket->title }}</a></li>
                            <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                    style="width: 12px; height: 12px;" class="opacity-30 flex-shrink-0"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 6l6 6l-6 6" />
                                </svg></li>
                            <li class="text-base-content/60">Edit</li>
                        </ol>
                    </nav>
                </div>

                <div class="flex items-center gap-4">
                    <div
                        class="size-10 bg-warning/10 rounded-xl flex items-center justify-center text-warning shadow-sm border border-warning/5 ring-4 ring-warning/5 overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" class="flex-shrink-0"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-black text-2xl text-base-content tracking-tight leading-none mb-1">
                            Edit Ticket
                        </h2>
                        <div
                            class="flex items-center gap-2 text-[10px] font-black uppercase tracking-wider text-base-content/30 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;"
                                class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 7l0 5l3 3" />
                            </svg>
                            Modify ticket details
                        </div>
                    </div>
                </div>
        </x-slot>

        @php
            $allUsers = \App\Models\User::all(['id', 'name', 'email']);
        @endphp
        <script>
            window.allSystemUsers = @json($allUsers);
        </script>

        <div class="py-6">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                <div class="card bg-base-100 shadow-sm border border-base-content/5 overflow-hidden rounded-2xl">
                    <div class="px-6 py-4 border-b border-base-content/5">
                        <h3 class="text-sm font-bold text-base-content/70">Ticket Details</h3>
                    </div>

                    <form action="{{ route('tickets.update', $ticket) }}" method="POST" enctype="multipart/form-data"
                        class="p-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div class="form-control">
                                <label class="label pb-1.5">
                                    <span class="text-xs font-semibold text-base-content/60">
                                        Status
                                        <span class="text-error">*</span>
                                    </span>
                                </label>
                                <select name="status" required
                                    class="select bg-base-100 border border-base-content/10 focus:border-primary focus:ring-1 focus:ring-primary transition-all font-medium text-sm rounded-lg h-10">
                                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>
                                        In
                                        Progress</option>
                                    <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>
                                        Resolved
                                    </option>
                                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed
                                    </option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label pb-1.5">
                                    <span class="text-xs font-semibold text-base-content/60">
                                        Priority
                                        <span class="text-error">*</span>
                                    </span>
                                </label>
                                <select name="priority" required
                                    class="select bg-base-100 border border-base-content/10 focus:border-primary focus:ring-1 focus:ring-primary transition-all font-medium text-sm rounded-lg h-10">
                                    <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div class="form-control">
                                <label class="label pb-1.5">
                                    <span class="text-xs font-semibold text-base-content/60">
                                        Category
                                        <span class="text-error">*</span>
                                    </span>
                                </label>
                                <select name="category" required
                                    class="select bg-base-100 border border-base-content/10 focus:border-primary focus:ring-1 focus:ring-primary transition-all font-medium text-sm rounded-lg h-10">
                                    <option value="Bug" {{ $ticket->category == 'Bug' ? 'selected' : '' }}>Bug Report
                                    </option>
                                    <option value="Feature Request" {{ $ticket->category == 'Feature Request' ? 'selected' : '' }}>Feature Request</option>
                                    <option value="Technical Support" {{ $ticket->category == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                                    <option value="Other" {{ $ticket->category == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label pb-1.5">
                                    <span class="text-xs font-semibold text-base-content/60">Assignee</span>
                                </label>
                                <select name="assigned_to"
                                    class="select bg-base-100 border border-base-content/10 focus:border-primary focus:ring-1 focus:ring-primary transition-all font-medium text-sm rounded-lg h-10">
                                    <option value="">Unassigned</option>
                                    @foreach($ticket->project->members as $member)
                                        <option value="{{ $member->id }}" {{ $ticket->assigned_to == $member->id ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-control mb-5">
                            <label class="label pb-1.5">
                                <span class="text-xs font-semibold text-base-content/60">
                                    Title
                                    <span class="text-error">*</span>
                                </span>
                            </label>
                            <input type="text" name="title" required value="{{ old('title', $ticket->title) }}"
                                class="input bg-base-100 border border-base-content/10 focus:border-primary focus:ring-1 focus:ring-primary transition-all font-medium text-sm rounded-lg h-10"
                                placeholder="Enter ticket title">
                        </div>

                        <div class="form-control mb-5">
                            <label class="label pb-1.5">
                                <span class="text-xs font-semibold text-base-content/60">
                                    Description
                                    <span class="text-error">*</span>
                                </span>
                            </label>
                            <textarea name="description" rows="4" required
                                class="textarea bg-base-100 border border-base-content/10 focus:border-primary focus:ring-1 focus:ring-primary transition-all font-medium text-sm rounded-lg leading-relaxed"
                                placeholder="Describe the issue in detail...">{{ old('description', $ticket->description) }}</textarea>
                        </div>

                        <div class="form-control mb-5">
                            <label class="label pb-1.5">
                                <span class="text-xs font-semibold text-base-content/60">Attachments (Optional)</span>
                            </label>

                            @if($ticket->attachment_path)
                                <div
                                    class="flex items-center gap-2 mb-3 px-3 py-2 bg-base-200/50 rounded-lg border border-base-content/5">
                                    <span class="icon-[tabler--file-check] size-4 text-success"></span>
                                    <span class="text-xs font-medium text-base-content/70">Current file exists. Uploading
                                        new
                                        one will replace it.</span>
                                </div>
                            @endif

                            <label for="attachment"
                                class="flex flex-col items-center justify-center w-full h-28 border border-base-content/10 border-dashed rounded-lg cursor-pointer bg-base-100 hover:bg-base-200/30 transition-all group/upload">
                                <div class="flex flex-col items-center justify-center py-4" id="attachment-placeholder">
                                    <span
                                        class="icon-[tabler--cloud-upload] size-7 text-base-content/20 group-hover/upload:text-primary transition-colors mb-2"></span>
                                    <p class="text-xs font-semibold text-base-content/40">Select new file</p>
                                    <p class="text-[10px] text-base-content/30 mt-1">Images, PDF, DOC (Max 10MB)</p>
                                </div>
                                <div class="hidden flex-col items-center justify-center py-4" id="attachment-preview">
                                    <span class="icon-[tabler--file-check] size-7 text-success mb-2"></span>
                                    <p class="text-xs font-semibold text-base-content" id="filename-display"></p>
                                    <p class="text-[10px] text-base-content/40 mt-1">Click to change file</p>
                                </div>
                                <input type="file" name="attachment" id="attachment" class="hidden"
                                    accept="image/*,.pdf,.doc,.docx" onchange="updateFileName(this)" />
                            </label>
                            @error('attachment')
                                <p class="text-xs text-error font-medium mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-base-content/5">
                            <a href="{{ route('tickets.show', $ticket) }}"
                                class="btn btn-ghost hover:bg-base-200 rounded-lg px-5 h-9 text-sm font-medium">
                                Cancel
                            </a>
                            <button type="submit"
                                class="btn btn-primary rounded-lg px-6 h-9 text-sm font-semibold gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                    <polyline points="17 21 17 13 7 13 7 21" />
                                    <polyline points="7 3 7 8 15 8" />
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function updateFileName(input) {
                const placeholder = document.getElementById('attachment-placeholder');
                const preview = document.getElementById('attachment-preview');
                const display = document.getElementById('filename-display');

                if (input.files && input.files[0]) {
                    display.textContent = input.files[0].name;
                    placeholder.classList.add('hidden');
                    preview.classList.remove('hidden');
                    preview.classList.add('flex');
                } else {
                    placeholder.classList.remove('hidden');
                    preview.classList.add('hidden');
                    preview.classList.remove('flex');
                }
            }

            // Initialize HSSelect components
            document.addEventListener('DOMContentLoaded', function () {
                if (window.HSSelect) {
                    document.querySelectorAll('select[data-select]').forEach(el => {
                        const config = JSON.parse(el.getAttribute('data-select'));
                        new HSSelect(el, config);
                    });
                }
            });
        </script>
</x-app-layout>