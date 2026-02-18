<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('permissions.index') }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        ← BACK TO PERMISSIONS
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        NEW PERMISSION
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
                            <path
                                d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                            <circle cx="12" cy="11" r="2" />
                            <path d="M12 13v1" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Create Permission
                        </h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Define a new permission and set
                            default access levels.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-6 lg:px-10">
        <div class="max-w-4xl mx-auto">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf

                <div class="space-y-8">
                    <!-- Basic Info Card -->
                    <div
                        class="card bg-base-100 rounded-3xl ring-1 ring-base-content/5 shadow-xl shadow-base-content/[0.02] overflow-hidden">
                        <div class="card-body p-8 space-y-8">
                            <div class="flex items-center gap-3">
                                <div class="size-2 bg-primary rounded-full animate-pulse"></div>
                                <h3 class="text-[10px] font-bold uppercase tracking-widest text-base-content/30 italic">
                                    Permission Details</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-8">
                                <div class="form-control w-full">
                                    <label class="label px-1 pt-0 pb-3">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/40">Permission
                                            Name</span>
                                    </label>
                                    <input type="text" name="name" placeholder="e.g., Delete Projects"
                                        class="input w-full h-14 bg-base-200/50 border border-base-content/10 rounded-2xl focus:bg-base-100 focus:border-primary transition-all font-bold text-sm"
                                        required />
                                    <label class="label px-1 pt-2">
                                        <span class="text-[10px] font-bold italic text-base-content/30">Use clear,
                                            descriptive names (e.g., "edit_posts", "view_reports")</span>
                                    </label>
                                </div>

                                <div class="form-control w-full">
                                    <label class="label px-1 pt-0 pb-3">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/40">Description</span>
                                    </label>
                                    <textarea name="description"
                                        placeholder="Explain what functionality this permission controls..."
                                        class="textarea w-full h-32 bg-base-200/50 border border-base-content/10 rounded-2xl focus:bg-base-100 focus:border-primary transition-all resize-none leading-relaxed p-5 text-sm font-medium"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role Assignment Card -->
                    <div
                        class="card bg-base-100 rounded-3xl ring-1 ring-base-content/5 shadow-xl shadow-base-content/[0.02] overflow-hidden">
                        <div class="card-body p-8 space-y-8">
                            <div class="flex items-center gap-3">
                                <div class="size-2 bg-secondary rounded-full animate-pulse"></div>
                                <h3 class="text-[10px] font-bold uppercase tracking-widest text-base-content/30 italic">
                                    Default Access Assignment</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-4">
                                @foreach($roles as $role)
                                    <label
                                        class="group relative flex items-center justify-between p-5 rounded-2xl bg-base-200/30 border border-base-content/5 hover:bg-base-200/60 hover:border-{{ $role['color'] }}/30 transition-all cursor-pointer">
                                        <div class="flex items-center gap-4">
                                            <div
                                               class="size-12 rounded-xl bg-{{ $role['color'] }}/10 flex items-center justify-center text-{{ $role['color'] }} group-hover:scale-110 transition-transform">
                                                @if($role['key'] === 'admin')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z" /></svg>
                                                @elseif($role['key'] === 'director')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>
                                                @elseif($role['key'] === 'team_leader')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-black text-sm text-base-content tracking-tight">
                                                    {{ $role['name'] }}</h4>
                                                <p
                                                    class="text-[10px] font-bold text-base-content/30 uppercase tracking-tighter">
                                                    Grant access by default</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="roles[{{ $role['key'] }}]"
                                                class="toggle toggle-{{ $role['color'] }} toggle-md shadow-sm" />
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col md:flex-row md:items-center justify-end gap-3 pt-6">
                        <a href="{{ route('permissions.index') }}"
                            class="btn bg-[#1e293b] hover:bg-[#334155] h-14 px-10 rounded-2xl font-bold uppercase text-[10px] tracking-widest text-white border-none shadow-lg transition-all">
                            CANCEL
                        </a>
                        <button type="submit"
                            class="btn btn-primary h-14 px-12 rounded-2xl font-bold uppercase tracking-widest text-[10px] shadow-2xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all border-none text-white">
                            CREATE PERMISSION
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>