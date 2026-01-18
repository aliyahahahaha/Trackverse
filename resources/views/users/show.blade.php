<x-app-layout>
    <x-slot name="header">
        <div class="space-y-6">
            <!-- Top Navigation Row -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('users.index') }}"
                        class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                        <span
                            class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">←
                            BACK TO DIRECTORY</span>
                    </a>

                    <div class="w-px h-4 bg-base-content/10"></div>

                    <!-- Breadcrumbs -->
                    <nav
                        class="flex items-center text-[10px] font-black uppercase tracking-[0.15em] text-base-content/30">
                        <ol class="flex items-center gap-2">
                            <li><a href="{{ route('users.index') }}"
                                    class="hover:text-base-content transition-colors">User
                                    Management</a></li>
                            <li class="opacity-30"><svg viewBox="0 0 24 24" class="size-2.5" fill="none"
                                    stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M9 6l6 6l-6 6" />
                                </svg></li>
                            <li class="text-base-content/60">{{ $user->name }}</li>
                        </ol>
                    </nav>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('users.edit', $user) }}"
                        class="btn h-10 px-5 btn-warning text-white rounded-xl shadow-lg shadow-warning/20 transition-all gap-2 group border-none">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="size-4 group-hover:rotate-12 transition-transform" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                        </svg>
                        <span class="text-[10px] uppercase font-black tracking-widest">Edit Profile</span>
                    </a>

                    @if(auth()->id() !== $user->id && auth()->user()->isAdmin())
                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn h-10 px-5 btn-error text-white rounded-xl shadow-lg shadow-error/20 transition-all gap-2 group border-none">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="size-4 group-hover:scale-110 transition-transform" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                <span class="text-[10px] uppercase font-black tracking-widest">Delete</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Profile Info Row -->
            <div class="flex items-center gap-6">
                <div class="relative group">
                    <div
                        class="size-24 rounded-[2rem] bg-primary/10 flex items-center justify-center text-primary shadow-sm border border-primary/5 ring-8 ring-primary/5 overflow-hidden">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                            class="w-full h-full object-cover">
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-1.5">
                        <h2 class="font-black text-4xl text-base-content tracking-tight leading-none">
                            {{ $user->name }}
                        </h2>
                        @if($user->isAdmin())
                            <div
                                class="badge bg-primary/10 text-primary border-none text-[9px] font-black uppercase tracking-widest h-5 px-2">
                                ADMIN</div>
                        @elseif($user->isTeamLeader())
                            <div
                                class="badge bg-secondary/10 text-secondary border-none text-[9px] font-black uppercase tracking-widest h-5 px-2">
                                TEAM LEADER</div>
                        @else
                            <div
                                class="badge bg-base-content/10 text-base-content/60 border-none text-[9px] font-black uppercase tracking-widest h-5 px-2">
                                USER</div>
                        @endif
                    </div>
                    <p class="text-xs font-bold text-base-content/30 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 7l9 6l9 -6" />
                            <path d="M3 7l0 10a2 2 0 0 0 2 2h14a2 2 0 0 0 2 -2v-10" />
                        </svg>
                        {{ $user->email }}
                    </p>
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
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-base-content/30 flex items-center gap-2.5 mb-10">
                            <div class="size-1.5 bg-primary/40 rounded-full"></div>
                            Account Details
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div>
                                <label
                                    class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/20 block mb-2">FULL
                                    NAME</label>
                                <div
                                    class="text-sm font-black text-base-content bg-base-content/[0.02] p-4 rounded-xl border border-base-content/5">
                                    {{ $user->name }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/20 block mb-2">EMAIL
                                    ADDRESS</label>
                                <div
                                    class="text-sm font-black text-base-content bg-base-content/[0.02] p-4 rounded-xl border border-base-content/5">
                                    {{ $user->email }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/20 block mb-2">JOIN
                                    DATE</label>
                                <div
                                    class="text-sm font-black text-base-content bg-base-content/[0.02] p-4 rounded-xl border border-base-content/5 flex items-center justify-between">
                                    {{ $user->created_at->format('M d, Y') }}
                                    <span
                                        class="text-[9px] font-bold text-base-content/20">{{ $user->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/20 block mb-2">SYSTEM
                                    ROLE</label>
                                <div
                                    class="text-sm font-black text-base-content bg-base-content/[0.02] p-4 rounded-xl border border-base-content/5">
                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
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
                                    <div class="text-[9px] font-black text-base-content/20 uppercase tracking-widest">
                                        TICKETS ASSIGNED</div>
                                    <div class="text-3xl font-black text-base-content mt-1">
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
                                    <div class="text-[9px] font-black text-base-content/20 uppercase tracking-widest">
                                        ACTIVE PROJECTS</div>
                                    <div class="text-3xl font-black text-base-content mt-1">
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
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-base-content/30 flex items-center gap-2.5 mb-8">
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
                                            class="text-[10px] font-black uppercase tracking-widest text-success/60 mb-0.5">
                                            PASSWORD</div>
                                        <div class="text-xs font-black text-success">SECURE</div>
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
                                            class="text-[10px] font-black uppercase tracking-widest text-primary/60 mb-0.5">
                                            STATUS</div>
                                        <div class="text-xs font-black text-primary uppercase">ACTIVE</div>
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