<div id="task-create-modal" class="overlay modal overlay-open:opacity-100 hidden" role="dialog" tabindex="-1"
    style="transition: opacity 0.3s ease;">
    <div class="modal-dialog overlay-open:opacity-100" style="transition: opacity 0.3s ease;">
        <div class="modal-content overflow-hidden border border-base-content/5 shadow-2xl rounded-3xl bg-base-100">
            <div
                class="card-header bg-base-100 border-b border-base-200/50 px-8 py-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center text-primary shadow-sm border border-primary/5 shrink-0 overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" class="flex-shrink-0"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 5h8" />
                            <path d="M13 9h5" />
                            <path d="M13 15h8" />
                            <path d="M13 19h5" />
                            <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-base-content tracking-tight">Draft New Milestone</h3>
                        <p class="text-[10px] uppercase font-black tracking-widest text-base-content/30 italic">Define
                            clear
                            objectives for your squad</p>
                    </div>
                </div>
                <button type="button"
                    class="btn btn-sm btn-circle btn-ghost hover:bg-error/10 hover:text-error transition-all"
                    data-overlay="#task-create-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-4 h-4 flex-shrink-0"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6l-12 12" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('projects.tasks.store', $project) }}" method="POST" class="p-8">
                @csrf

                <!-- Task Name -->
                <div class="form-control mb-6">
                    <label class="label pb-1.5 pt-0">
                        <span
                            class="text-[10px] uppercase font-black tracking-widest text-base-content/50 flex items-center gap-1.5 ml-1">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;"
                                class="flex-shrink-0 text-primary/40" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M15 8l2 0" />
                                <path d="M15 12l2 0" />
                                <path d="M7 16l10 0" />
                            </svg>
                            TASK TITLE
                        </span>
                    </label>
                    <input type="text" name="name" required
                        class="input input-lg w-full bg-base-200/50 border-none focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm rounded-xl placeholder:font-medium placeholder:text-base-content/20"
                        placeholder="Briefly state the deliverable...">
                </div>

                <!-- Description -->
                <div class="form-control mb-6">
                    <label class="label pb-1.5 pt-0">
                        <span
                            class="text-[10px] uppercase font-black tracking-widest text-base-content/50 flex items-center gap-1.5 ml-1">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;"
                                class="flex-shrink-0 text-primary/40" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 6l16 0" />
                                <path d="M4 12l16 0" />
                                <path d="M4 18l12 0" />
                            </svg>
                            DETAILED CONTEXT
                        </span>
                    </label>
                    <textarea name="description" rows="4"
                        class="textarea textarea-lg w-full bg-base-200/50 border-none focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm rounded-xl placeholder:font-medium placeholder:text-base-content/20 min-h-[120px]"
                        placeholder="Describe the expected outcome and any helpful links..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Due Date -->
                    <div class="form-control">
                        <label class="label pb-1.5 pt-0">
                            <span
                                class="text-[10px] uppercase font-black tracking-widest text-base-content/50 flex items-center gap-1.5 ml-1">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;"
                                    class="flex-shrink-0 text-primary/40" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                                    <path d="M16 3v4" />
                                    <path d="M8 3v4" />
                                    <path d="M4 11h16" />
                                    <path d="M15 19l2 2l4 -4" />
                                </svg>
                                DEADLINE
                            </span>
                        </label>
                        <input type="date" name="due_date"
                            class="input input-lg w-full bg-base-200/50 border-none focus:bg-base-100 focus:ring-2 focus:ring-primary/20 transition-all font-bold text-sm rounded-xl placeholder:text-base-content/20">
                    </div>

                    <!-- Assignee -->
                    <div class="form-control">
                        <x-ui.advance-select name="assigned_to" label="ASSIGN TO" placeholder="Draft Assignment"
                            :multiple="false" :options="$project->members->map(fn($m) => [
        'value' => $m->id,
        'label' => $m->name,
        'description' => $m->email,
        'image' => $m->profile_photo_url
    ])->toArray()" />
                    </div>
                </div>

                <div class="pt-8 flex items-center justify-end gap-3 border-t border-base-content/5">
                    <button type="button"
                        class="btn btn-ghost font-black uppercase tracking-widest text-[9px] rounded-xl px-8 h-12"
                        data-overlay="#task-create-modal">
                        Discard
                    </button>
                    <button type="submit"
                        class="btn btn-primary px-10 rounded-xl font-black uppercase tracking-widest shadow-xl shadow-primary/20 h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-4 h-4 flex-shrink-0"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />
                            <path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />
                            <path d="M15 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        </svg>
                        Initiate Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>