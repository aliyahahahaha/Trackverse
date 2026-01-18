<x-app-layout>
    <x-slot name="header">
        <x-slot name="header">
            <div class="space-y-6 pb-2">
                <!-- Back Button & Breadcrumb Row (FIXED) -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('projects.show', $project) }}"
                        class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                        <span
                            class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">←
                            BACK TO PROJECT</span>
                    </a>

                    <div class="h-4 w-px bg-base-content/20"></div>

                    <nav
                        class="flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-base-content/40">
                        <ol class="flex items-center gap-2">
                            <li><a href="{{ route('projects.index') }}"
                                    class="hover:text-primary transition-colors">Projects</a></li>
                            <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                    style="width: 12px; height: 12px;" class="opacity-30 flex-shrink-0"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 6l6 6l-6 6" />
                                </svg></li>
                            <li><a href="{{ route('projects.show', $project) }}"
                                    class="hover:text-primary transition-colors">{{ $project->name }}</a></li>
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
                            Edit Project
                        </h2>
                        <div
                            class="flex items-center gap-2 text-[10px] font-black uppercase tracking-wider text-base-content/30 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;"
                                class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 7l0 5l3 3" />
                            </svg>
                            Edit project details
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <div class="py-6">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                <div class="card bg-base-100 shadow-sm border border-base-content/5 overflow-hidden rounded-2xl">
                    <div class="px-6 py-4 border-b border-base-content/5 flex items-center justify-between">
                        <h3 class="text-sm font-bold text-base-content/70">Project Details</h3>
                        @include('projects.partials.status-badge', ['status' => $project->status])
                    </div>

                    <div class="p-6">
                        <form action="{{ route('projects.update', $project) }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')

                            <div class="form-control">
                                <label for="name" class="label pb-1.5">
                                    <span class="text-xs font-semibold text-base-content/60">
                                        Project Name
                                        <span class="text-error">*</span>
                                    </span>
                                </label>
                                <input type="text" name="name" id="name"
                                    class="input bg-base-100 border border-base-content/10 focus:border-primary focus:ring-1 focus:ring-primary transition-all font-medium text-sm rounded-lg h-10"
                                    value="{{ old('name', $project->name) }}" placeholder="Enter project name" required>
                                @error('name')
                                    <label class="label pt-1.5 pb-0">
                                        <span class="label-text-alt text-error text-xs font-medium">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label for="description" class="label pb-1.5">
                                    <span class="text-xs font-semibold text-base-content/60">Description</span>
                                </label>
                                <textarea name="description" id="description" rows="4"
                                    class="textarea bg-base-100 border border-base-content/10 focus:border-primary focus:ring-1 focus:ring-primary transition-all font-medium text-sm rounded-lg leading-relaxed"
                                    placeholder="Describe the project objectives and scope...">{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <label class="label pt-1.5 pb-0">
                                        <span class="label-text-alt text-error text-xs font-medium">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label for="status" class="label pb-1.5">
                                    <span class="text-xs font-semibold text-base-content/60">
                                        Status
                                        <span class="text-error">*</span>
                                    </span>
                                </label>
                                <select name="status" id="status"
                                    class="select bg-base-100 border border-base-content/10 focus:border-primary focus:ring-1 focus:ring-primary transition-all font-medium text-sm rounded-lg h-10">
                                    <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }}>Planning</option>
                                    <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="on_hold" {{ old('status', $project->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                    <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <label class="label pt-1.5 pb-0">
                                        <span class="label-text-alt text-error text-xs font-medium">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="pt-3 border-t border-base-content/5">
                                <x-ui.advance-select name="members" label="Team Members"
                                    placeholder="Select team members..."
                                    :selected="$project->members->pluck('id')->toArray()" :options="$users->map(fn($u) => [
        'value' => $u->id,
        'label' => $u->name,
        'description' => $u->email,
        'image' => $u->profile_photo_url
    ])->toArray()" />
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-base-content/5">
                                <a href="{{ route('projects.show', $project) }}"
                                    class="btn btn-ghost hover:bg-base-200 rounded-lg px-5 h-9 text-sm font-medium">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="btn btn-primary rounded-lg px-6 h-9 text-sm font-semibold gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
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
        </div>
</x-app-layout>