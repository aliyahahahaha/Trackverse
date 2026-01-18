<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight flex items-center gap-2">
            <span class="icon-[tabler--shield-plus] size-6"></span>
            {{ __('Add New Permission') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-6">

        <!-- Header Actions -->
        <div>
            <a href="{{ route('permissions.index') }}"
                class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-[#333642] hover:bg-[#3e4250] border-none text-white gap-2 font-bold shadow-sm group transition-all">
                <span class="text-[10px] uppercase tracking-widest">← BACK TO PERMISSIONS</span>
            </a>
            <h3 class="text-2xl font-black text-base-content mt-2">Create Permission</h3>
            <p class="text-base-content/60 text-sm">Define a new permission and set default access levels</p>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-content/5 overflow-hidden">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="card-body p-8 gap-6">
                    <!-- Basic Info Section -->
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label font-bold text-sm">Permission Name</label>
                            <input type="text" name="name" placeholder="e.g., Delete Projects"
                                class="input input-lg input-bordered w-full focus:input-primary transition-all font-bold"
                                required />
                            <label class="label">
                                <span class="label-text-alt text-base-content/40">Use clear, descriptive names (e.g.,
                                    "edit_posts", "view_reports")</span>
                            </label>
                        </div>

                        <div class="form-control">
                            <label class="label font-bold text-sm">Description</label>
                            <textarea name="description"
                                placeholder="Explain what functionality this permission controls..."
                                class="textarea textarea-bordered h-24 w-full focus:textarea-primary transition-all text-sm font-medium"
                                required></textarea>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <!-- Role Assignment Section -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-sm uppercase tracking-widest text-base-content/50">Default Access
                            Assignment</h4>
                        <div class="grid grid-cols-1 gap-3">
                            @foreach($roles as $role)
                                <div
                                    class="form-control border border-base-content/10 rounded-xl p-4 hover:border-{{ $role['color'] }}/50 hover:bg-base-200/50 transition-all cursor-pointer group">
                                    <label class="label cursor-pointer flex justify-between items-center w-full p-0">
                                        <div class="flex items-center gap-3">
                                            <div class="badge badge-soft badge-{{ $role['color'] }} p-3">
                                                <span
                                                    class="icon-[tabler--{{ $role['key'] == 'admin' ? 'crown' : ($role['key'] == 'team_leader' ? 'users-group' : 'user') }}] size-5"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-bold text-base-content group-hover:text-primary transition-colors">{{ $role['name'] }}</span>
                                                <span class="text-xs text-base-content/40">Grant access by default</span>
                                            </div>
                                        </div>
                                        <input type="checkbox" name="roles[{{ $role['key'] }}]"
                                            class="toggle toggle-{{ $role['color'] }}" />
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="bg-base-200/30 px-8 py-5 border-t border-base-content/5 flex justify-end gap-3">
                    <a href="{{ route('permissions.index') }}" class="btn btn-ghost font-bold">Cancel</a>
                    <button type="submit"
                        class="btn btn-primary gap-2 font-bold px-8 shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                        <span class="icon-[tabler--plus] size-5"></span>
                        Create Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>