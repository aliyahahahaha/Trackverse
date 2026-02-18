<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('users.index') }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        USER LIST
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        USER PROFILE
                    </div>
                </div>
            </div>

            <!-- Profile Identity Hero -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 mt-2">
                <div class="flex flex-col md:flex-row items-center gap-8 text-center md:text-left">
                    <!-- Profile Photo with Glow -->
                    <div class="relative group shrink-0">
                        <div class="absolute -inset-1 bg-gradient-to-tr from-primary to-secondary rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition-all duration-500"></div>
                        <div class="relative size-32 rounded-[2.5rem] bg-base-100 flex items-center justify-center text-primary shadow-xl border border-base-content/5 ring-1 ring-base-content/5 overflow-hidden">
                            @if($user->hasMedia('avatars'))
                                <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @elseif(!empty($user->profile_photo_path))
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                                    <span class="text-3xl font-black text-primary tracking-tighter">{{ collect(explode(' ', $user->name))->map(fn($n) => $n[0])->take(2)->join('') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col md:flex-row items-center gap-3">
                            <h1 class="text-4xl font-black text-base-content tracking-tight leading-none">
                                {{ $user->name }}
                            </h1>
                            @if($user->isAdmin())
                                <div class="inline-flex items-center justify-center px-3 h-6 bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-full shadow-lg shadow-primary/20">ADMIN</div>
                            @elseif($user->isDirector())
                                <div class="inline-flex items-center justify-center px-3 h-6 bg-[#1e293b] text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-full shadow-lg shadow-slate-900/20">DIRECTOR</div>
                            @elseif($user->isTeamLeader())
                                <div class="inline-flex items-center justify-center px-3 h-6 bg-secondary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-full shadow-lg shadow-secondary/20">LEADER</div>
                            @else
                                <div class="inline-flex items-center justify-center px-3 h-6 bg-base-content text-base-100 text-[10px] font-black uppercase tracking-[0.2em] rounded-full opacity-60">USER</div>
                            @endif
                        </div>
                        
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-y-3 gap-x-6">
                            <div class="flex items-center gap-2 text-sm font-bold text-base-content/40">
                                <span class="icon-[tabler--mail] size-4 opacity-40"></span>
                                {{ $user->email }}
                            </div>
                            <div class="flex items-center gap-2 text-sm font-bold text-base-content/40">
                                <span class="icon-[tabler--calendar-event] size-4 opacity-40"></span>
                                Joined {{ $user->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-center lg:justify-end gap-3 shrink-0">
                    <a href="{{ route('users.edit', $user) }}"
                        class="btn btn-lg h-14 px-8 btn-warning text-white rounded-[1.25rem] shadow-xl shadow-warning/20 transition-all gap-3 group border-none">
                        <span class="icon-[tabler--pencil] size-5 group-hover:rotate-12 transition-transform"></span>
                        <span class="text-[11px] uppercase font-black tracking-widest">Edit Profile</span>
                    </a>

                    @if(auth()->id() !== $user->id && auth()->user()->isAdmin())
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-lg h-14 px-8 btn-error text-white rounded-[1.25rem] shadow-xl shadow-error/20 transition-all gap-3 group border-none"
                                data-confirm="Are you sure you want to delete this user? This will permanently remove their profile and all associated data."
                                data-confirm-title="Delete User" data-confirm-text="Yes, Delete User">
                                <span class="icon-[tabler--trash] size-5 group-hover:scale-110 transition-transform"></span>
                                <span class="text-[11px] uppercase font-black tracking-widest">Delete</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 mt-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Content: Details -->
            <div class="lg:col-span-8 space-y-8">
                <div
                    class="card bg-base-100 shadow-2xl shadow-base-content/[0.03] border border-base-content/5 rounded-[2rem] overflow-hidden">
                    <div class="card-body p-10 pt-8">
                        <h3
                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/30 flex items-center gap-2.5 mb-10">
                            <div class="size-1.5 bg-primary/40 rounded-full"></div>
                            Account Details
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div>
                                <label
                                    class="text-[9px] uppercase font-bold tracking-widest text-base-content/20 block mb-2">FULL
                                    NAME</label>
                                <div
                                    class="text-sm font-bold text-base-content bg-base-content/[0.02] p-4 rounded-xl border border-base-content/5">
                                    {{ $user->name }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="text-[9px] uppercase font-bold tracking-widest text-base-content/20 block mb-2">EMAIL
                                    ADDRESS</label>
                                <div
                                    class="text-sm font-bold text-base-content bg-base-content/[0.02] p-4 rounded-xl border border-base-content/5">
                                    {{ $user->email }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="text-[9px] uppercase font-bold tracking-widest text-base-content/20 block mb-2">JOIN
                                    DATE</label>
                                <div
                                    class="text-sm font-bold text-base-content bg-base-content/[0.02] p-4 rounded-xl border border-base-content/5 flex items-center justify-between">
                                    {{ $user->created_at->format('M d, Y') }}
                                    <span
                                        class="text-[9px] font-bold text-base-content/20">{{ $user->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="text-[9px] uppercase font-bold tracking-widest text-base-content/20 block mb-2">SYSTEM
                                    ROLE</label>
                                <div
                                    class="text-sm font-bold text-base-content bg-base-content/[0.02] p-4 rounded-xl border border-base-content/5">
                                    {{ $user->role_label }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div
                        class="card bg-base-100 shadow-2xl shadow-base-content/[0.03] border border-base-content/5 rounded-[2rem] overflow-hidden group hover:border-primary/20 transition-all">
                        <div class="card-body p-8">
                            <div class="flex items-start justify-between mb-4">
                                <div
                                    class="size-14 bg-primary/5 rounded-2xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-7" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M15 5l0 2" />
                                        <path d="M15 11l0 2" />
                                        <path d="M15 17l0 2" />
                                        <path
                                            d="M5 5h14a2 2 0 0 1 2 2v3.2a2 2 0 0 0 0 3.6v3.2a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3.2a2 2 0 0 0 0 -3.6v-3.2a2 2 0 0 1 2 -2" />
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-[9px] font-bold text-base-content/20 uppercase tracking-widest">
                                        TICKETS ASSIGNED</div>
                                    <div class="text-2xl font-bold text-base-content mt-1">
                                        {{ $user->assignedTickets ? $user->assignedTickets->count() : 0 }}
                                    </div>
                                </div>
                            </div>
                            <div class="w-full bg-base-content/[0.03] h-1.5 rounded-full overflow-hidden mt-4">
                                <div class="bg-primary h-full w-1/3 rounded-full opacity-60"></div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="card bg-base-100 shadow-2xl shadow-base-content/[0.03] border border-base-content/5 rounded-[2rem] overflow-hidden group hover:border-secondary/20 transition-all">
                        <div class="card-body p-8">
                            <div class="flex items-start justify-between mb-4">
                                <div
                                    class="size-14 bg-secondary/5 rounded-2xl flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-7" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-[9px] font-bold text-base-content/20 uppercase tracking-widest">
                                        ACTIVE PROJECTS</div>
                                    <div class="text-2xl font-bold text-base-content mt-1">
                                        {{ $user->projects ? $user->projects->count() : 0 }}
                                    </div>
                                </div>
                            </div>
                            <div class="w-full bg-base-content/[0.03] h-1.5 rounded-full overflow-hidden mt-4">
                                <div class="bg-secondary h-full w-1/4 rounded-full opacity-60"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Security and Status -->
            <div class="lg:col-span-4 space-y-8">
                <div
                    class="card bg-base-100 shadow-2xl shadow-base-content/[0.02] border border-base-content/5 rounded-[2rem] overflow-hidden">
                    <div class="card-body p-8">
                        <h3
                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/30 flex items-center gap-2.5 mb-8">
                            <div class="size-1.5 bg-success/40 rounded-full"></div>
                            Security & Access
                        </h3>

                        <div class="space-y-6">
                            <div
                                class="flex items-center justify-between p-4 bg-success/5 rounded-2xl border border-success/10 transition-all hover:bg-success/10">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="size-10 rounded-xl bg-white flex items-center justify-center text-success shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                                            <path d="M9 12l2 2l4 -4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div
                                            class="text-[10px] font-bold uppercase tracking-widest text-success/60 mb-0.5">
                                            PASSWORD</div>
                                        <div class="text-xs font-bold text-success">SECURE</div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-4 bg-primary/5 rounded-2xl border border-primary/10 transition-all hover:bg-primary/10">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="size-10 rounded-xl bg-white flex items-center justify-center text-primary shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M12 7v5l3 3" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div
                                            class="text-[10px] font-bold uppercase tracking-widest text-primary/60 mb-0.5">
                                            STATUS</div>
                                        <div class="text-xs font-bold text-primary uppercase">ACTIVE</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>