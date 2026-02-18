<aside id="layout-sidebar"
    class="overlay lg:overlay-none h-screen transition-all duration-300 ease-in-out border-e border-base-content/10 flex-shrink-0 z-50 overflow-hidden bg-base-100"
    style="width: var(--sidebar-width); min-width: var(--sidebar-width); max-width: var(--sidebar-width);"
    aria-label="Sidebar" tabindex="-1">
    <div id="layout-sidebar-content" class="h-full flex flex-col bg-base-100 overflow-hidden">
        <!-- Close Button (Mobile) -->
        <!-- Close Button (Mobile) Removed -->

        <!-- Branding Section - Enlarged -->
        <div class="px-6 py-6 flex-shrink-0 border-b border-base-content/5">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 group cursor-pointer">
                <div
                    class="size-11 bg-primary/10 rounded-[14px] flex items-center justify-center border border-primary/10 shadow-sm transition-transform hover:scale-105 duration-300">
                    <img src="{{ asset('trackverse.png') }}" alt="Logo" class="size-7 object-contain">
                </div>
                <div class="flex flex-col">
                    <h2
                        class="text-base-content text-xl font-bold tracking-tighter uppercase italic leading-none group-hover:text-primary transition-colors">
                        Track<span class="text-primary italic animate-pulse">Verse</span>
                    </h2>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-1">Management
                        Hub</span>
                </div>
            </a>
        </div>

        <!-- Navigation items -->
        <div class="flex-1 overflow-y-auto px-3 py-3 custom-scrollbar">
            <ul class="menu menu-xs p-0 gap-0.5 pb-2">
                <!-- Group: CORE SERVICES -->
                <li class="px-2 mb-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Core Services</span>
                </li>

                <!-- Dashboard -->
                <li class="w-full">
                    <a href="{{ route('dashboard') }}" @class([
                        'flex w-full items-center px-3 h-10 rounded-lg transition-all duration-200 group',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20' => request()->routeIs('dashboard'),
                        'text-slate-500 hover:bg-base-content/5 hover:text-primary font-bold' => !request()->routeIs('dashboard')
                    ])>
                        <div @class([
                            'flex items-center justify-center size-7 rounded-lg shrink-0 transition-colors mr-3',
                            'bg-primary-content/20' => request()->routeIs('dashboard'),
                            'bg-base-200/80 group-hover:bg-primary/10' => !request()->routeIs('dashboard')
                        ])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="7" height="7" x="3" y="3" rx="1" />
                                <rect width="7" height="7" x="14" y="3" rx="1" />
                                <rect width="7" height="7" x="14" y="14" rx="1" />
                                <rect width="7" height="7" x="3" y="14" rx="1" />
                            </svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-wide truncate">Dashboard</span>
                    </a>
                </li>

                <!-- Calendar -->
                <li class="w-full">
                    <a href="{{ route('calendar.index') }}" @class([
                        'flex w-full items-center px-3 h-10 rounded-lg transition-all duration-200 group',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20' => request()->routeIs('calendar.*'),
                        'text-slate-500 hover:bg-base-content/5 hover:text-primary font-bold' => !request()->routeIs('calendar.*')
                    ])>
                        <div @class([
                            'flex items-center justify-center size-7 rounded-lg shrink-0 transition-colors mr-3',
                            'bg-primary-content/20' => request()->routeIs('calendar.*'),
                            'bg-base-200/80 group-hover:bg-primary/10' => !request()->routeIs('calendar.*')
                        ])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <path d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-wide truncate">Calendar</span>
                    </a>
                </li>

                <!-- Leaderboard -->
                <li class="w-full">
                    <a href="{{ route('leaderboard.index') }}" @class([
                        'flex w-full items-center px-3 h-10 rounded-lg transition-all duration-200 group',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20' => request()->routeIs('leaderboard.*'),
                        'text-slate-500 hover:bg-base-content/5 hover:text-primary font-bold' => !request()->routeIs('leaderboard.*')
                    ])>
                        <div @class([
                            'flex items-center justify-center size-7 rounded-lg shrink-0 transition-colors mr-3',
                            'bg-primary-content/20' => request()->routeIs('leaderboard.*'),
                            'bg-base-200/80 group-hover:bg-primary/10' => !request()->routeIs('leaderboard.*')
                        ])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9h6v6h-6z" />
                                <path d="M18 9h-3v6h3z" />
                                <path d="M12 3l-9 4.5v3l9 4.5l9 -4.5v-3z" />
                                <path d="M12 15v6" />
                            </svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-wide truncate">Leaderboard</span>
                    </a>
                </li>

                <!-- Announcements -->
                <li class="w-full">
                    <a href="{{ route('announcements.index') }}" @class([
                        'flex w-full items-center px-3 h-10 rounded-lg transition-all duration-200 group',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20' => request()->routeIs('announcements.*'),
                        'text-slate-500 hover:bg-base-content/5 hover:text-primary font-bold' => !request()->routeIs('announcements.*')
                    ])>
                        <div @class([
                            'flex items-center justify-center size-7 rounded-lg shrink-0 transition-colors mr-3',
                            'bg-primary-content/20' => request()->routeIs('announcements.*'),
                            'bg-base-200/80 group-hover:bg-primary/10' => !request()->routeIs('announcements.*')
                        ])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                                <path d="M8 8h4M8 12h4M8 16h4" />
                            </svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-wide truncate">Announcements</span>
                    </a>
                </li>

                <!-- Tasks -->
                <li class="w-full">
                    <a href="{{ route('tasks.index') }}" @class([
                        'flex w-full items-center px-3 h-10 rounded-lg transition-all duration-200 group',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20' => request()->routeIs('tasks.*'),
                        'text-slate-500 hover:bg-base-content/5 hover:text-primary font-bold' => !request()->routeIs('tasks.*')
                    ])>
                        <div @class([
                            'flex items-center justify-center size-7 rounded-lg shrink-0 transition-colors mr-3',
                            'bg-primary-content/20' => request()->routeIs('tasks.*'),
                            'bg-base-200/80 group-hover:bg-primary/10' => !request()->routeIs('tasks.*')
                        ])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 11l3 3l8 -8" />
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                            </svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-wide truncate">Tasks</span>
                    </a>
                </li>

                <!-- Group: WORKSPACE -->
                <li class="px-2 pt-3 pb-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Workspace</span>
                </li>

                <!-- Projects (Expandable) -->
                <li x-data="{ open: {{ request()->routeIs('projects.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="flex w-full items-center px-3 h-10 rounded-lg transition-all duration-200 group text-base-content/60 hover:bg-base-content/5 hover:text-base-content font-bold mb-0.5"
                        aria-haspopup="true" :aria-expanded="open">
                        <div @class([
                            'flex items-center justify-center size-7 rounded-lg shrink-0 transition-colors mr-3',
                            'bg-primary/10 text-primary' => request()->routeIs('projects.*'),
                            'bg-base-200/80 group-hover:bg-primary/10 text-base-content/40' => !request()->routeIs('projects.*')
                        ])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                <path d="M3 13a20 20 0 0 0 18 0" />
                            </svg>
                        </div>
                        <span @class(['grow text-left text-[11px] uppercase tracking-wider truncate', 'text-primary' => request()->routeIs('projects.*')])>Projects</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="size-3.5 transition-transform duration-200 opacity-40 group-hover:opacity-100"
                            :class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6l6 -6" />
                        </svg>
                    </button>
                    <ul x-show="open" x-cloak x-collapse
                        class="w-full p-0 flex flex-col pl-[3.5rem] space-y-0.5 mb-2 border-l border-base-content/10 ml-[1.65rem]">
                        <li class="w-full">
                            <a href="{{ route('projects.index') }}" @class(['block w-full h-8 flex items-center text-[9px] font-bold uppercase tracking-widest transition-all', 'text-primary' => request()->routeIs('projects.index'), 'text-base-content/40 hover:text-primary' => !request()->routeIs('projects.index')])>
                                All Projects
                            </a>
                        </li>
                        @can('create', App\Models\Project::class)
                            <li class="w-full">
                                <a href="{{ route('projects.create') }}" @class(['block w-full h-8 flex items-center text-[9px] font-bold uppercase tracking-widest transition-all', 'text-primary' => request()->routeIs('projects.create'), 'text-base-content/40 hover:text-primary' => !request()->routeIs('projects.create')])>
                                    Create New
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <!-- Tickets -->
                <li class="w-full">
                    <a href="{{ route('tickets.index') }}" @class([
                        'flex w-full items-center px-3 h-10 rounded-lg transition-all duration-200 group',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20' => request()->routeIs('tickets.*'),
                        'text-base-content/60 hover:bg-base-content/5 hover:text-base-content font-bold' => !request()->routeIs('tickets.*')
                    ])>
                        <div @class([
                            'flex items-center justify-center size-7 rounded-lg shrink-0 transition-colors mr-3',
                            'bg-primary-content/20' => request()->routeIs('tickets.*'),
                            'bg-base-200/80 group-hover:bg-primary/10' => !request()->routeIs('tickets.*')
                        ])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 5v2m0 4v2m0 4v2" />
                                <path
                                    d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                            </svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-wider truncate">Tickets</span>
                    </a>
                </li>

                @if(auth()->user()->isAdmin())
                    <!-- Team Members -->
                    <li class="w-full">
                        <a href="{{ route('users.index') }}" @class([
                            'flex w-full items-center px-3 h-10 rounded-lg transition-all duration-200 group',
                            'bg-primary text-primary-content font-bold shadow-md shadow-primary/20' => request()->routeIs('users.index'),
                            'text-base-content/60 hover:bg-base-content/5 hover:text-base-content font-bold' => !request()->routeIs('users.index')
                        ])>
                            <div @class([
                                'flex items-center justify-center size-7 rounded-lg shrink-0 transition-colors mr-3',
                                'bg-primary-content/20' => request()->routeIs('users.index'),
                                'bg-base-200/80 group-hover:bg-primary/10' => !request()->routeIs('users.index')
                            ])>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </div>
                            <span class="text-[11px] uppercase tracking-wider truncate">Team Members</span>
                        </a>
                    </li>
                @endif

                <!-- Administration -->
                @if(auth()->user()->isAdmin())
                    <li class="px-2 mt-6 mb-2">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Administration</span>
                    </li>

                    <li
                        x-data="{ open: {{ (request()->routeIs('users.*') || request()->routeIs('permissions.*')) ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex w-full items-center px-3 h-10 rounded-lg transition-all duration-200 group text-base-content/60 hover:bg-base-content/5 hover:text-base-content font-bold mb-0.5"
                            aria-haspopup="true" :aria-expanded="open">
                            <div @class([
                                'flex items-center justify-center size-7 rounded-lg shrink-0 transition-colors mr-3',
                                'bg-primary/10 text-primary' => (request()->routeIs('users.*') || request()->routeIs('permissions.*')),
                                'bg-base-200/80 group-hover:bg-primary/10 text-base-content/40' => !(request()->routeIs('users.*') || request()->routeIs('permissions.*'))
                            ])>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37a1.724 1.724 0 0 0 2.572 -1.065" />
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                </svg>
                            </div>
                            <span @class(['grow text-left text-[11px] uppercase tracking-wider truncate', 'text-primary' => (request()->routeIs('users.*') || request()->routeIs('permissions.*'))])>Management</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="size-3.5 transition-transform duration-300 opacity-40 group-hover:opacity-100"
                                :class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6l6 -6" />
                            </svg>
                        </button>
                        <ul x-show="open" x-cloak x-collapse
                            class="w-full p-0 flex flex-col pl-[3.5rem] space-y-0.5 mb-2 border-l border-base-content/10 ml-[1.65rem]">
                            <li class="w-full">
                                <a href="{{ route('users.index') }}" @class(['block w-full h-8 flex items-center text-[9px] font-bold uppercase tracking-widest transition-all', 'text-primary' => request()->routeIs('users.index'), 'text-base-content/40 hover:text-primary' => !request()->routeIs('users.index')])>
                                    User Directory
                                </a>
                            </li>
                            <li class="w-full">
                                <a href="{{ route('permissions.index') }}" @class(['block w-full h-8 flex items-center text-[9px] font-bold uppercase tracking-widest transition-all', 'text-primary' => request()->routeIs('permissions.index'), 'text-base-content/40 hover:text-primary' => !request()->routeIs('permissions.index')])>
                                    Permissions
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Sidebar Footer - User Profile -->
        <div class="p-2 border-t border-base-content/5 bg-base-100/50">
            <div
                class="flex items-center gap-2 p-1.5 rounded-lg bg-base-100 border border-base-content/5 shadow-sm group transition-all duration-300 hover:shadow-md hover:border-primary/10">
                <div class="relative inline-block">
                    <img class="size-9 rounded-lg object-cover border border-base-content/10"
                        src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" />
                    @php
                        $curStatus = auth()->user()->todayAvailability?->status ?? 'available';
                        $statusDot = match ($curStatus) {
                            'busy' => 'bg-error',
                            'on_leave' => 'bg-warning',
                            default => 'bg-success',
                        };
                    @endphp
                    <span
                        class="absolute bottom-0 right-0 block size-2.5 rounded-full {{ $statusDot }} ring-2 ring-white transform translate-x-1/4 translate-y-1/4"></span>
                </div>
                <div class="flex flex-col min-w-0 grow gap-0.5">
                    <h6
                        class="text-xs font-bold text-base-content/90 truncate group-hover:text-primary transition-colors leading-tight">
                        {{ auth()->user()->name }}
                    </h6>
                    <span class="text-[10px] font-semibold text-base-content/50 uppercase tracking-wider truncate">
                        {{ auth()->user()->role_label }}
                    </span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                    @csrf
                    <button type="submit"
                        class="size-6 rounded-md flex items-center justify-center text-slate-400 hover:text-error hover:bg-error/10 transition-all duration-300"
                        title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M9 12h12l-3 -3" />
                            <path d="M18 15l3 -3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>