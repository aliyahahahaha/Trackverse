<aside id="layout-sidebar"
    class="overlay lg:overlay-none h-screen transition-all duration-300 ease-in-out border-e border-base-content/10 flex-shrink-0 z-50 overflow-hidden bg-base-100"
    style="width: var(--sidebar-width); min-width: var(--sidebar-width); max-width: var(--sidebar-width);"
    aria-label="Sidebar" tabindex="-1">
    <div id="layout-sidebar-content" class="h-full flex flex-col bg-base-100 overflow-hidden">
        <!-- Close Button (Mobile) -->
        <button type="button" class="btn btn-ghost btn-circle btn-sm absolute end-4 top-4 lg:hidden z-50"
            aria-label="Close" data-overlay="#layout-sidebar">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6l-12 12" />
                <path d="M6 6l12 12" />
            </svg>
        </button>

        <!-- Branding Section -->
        <div class="px-5 py-4 flex-shrink-0 border-b border-base-content/5">
            <div class="flex items-center gap-3">
                <div
                    class="size-8 bg-primary/10 rounded-xl flex items-center justify-center border border-primary/10 shadow-sm transition-transform hover:scale-105 duration-300">
                    <img src="{{ asset('trackverse.png') }}" alt="Logo" class="size-4.5 object-contain">
                </div>
                <div class="flex flex-col">
                    <h2
                        class="text-base-content text-sm font-black tracking-tighter uppercase italic leading-none group cursor-default">
                        Track<span class="text-primary italic animate-pulse">Verse</span>
                    </h2>
                    <span class="text-[8px] font-black uppercase tracking-[0.2em] text-slate-400 mt-0.5">Management
                        Hub</span>
                </div>
            </div>
        </div>

        <!-- Navigation items -->
        <div class="flex-1 overflow-y-auto px-3 py-3 custom-scrollbar">
            <ul class="menu menu-xs p-0 gap-0.5 pb-2">
                <!-- Group: CORE SERVICES -->
                <li class="px-2 pt-1 pb-0.5">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Core Services</span>
                </li>

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}" @class([
                        'flex w-full items-center px-3 py-2 rounded-lg transition-all duration-300 group relative overflow-hidden',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20 scale-[1.01]' => request()->routeIs('dashboard'),
                        'text-slate-500 hover:bg-primary/5 hover:text-primary font-bold' => !request()->routeIs('dashboard')
                    ])>
                        <div @class(['size-6 rounded-md flex items-center justify-center mr-1 transition-colors', 'bg-primary-content/20' => request()->routeIs('dashboard'), 'bg-slate-100 group-hover:bg-primary/10' => !request()->routeIs('dashboard')])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h6v6h-6z" />
                                <path d="M14 4h6v6h-6z" />
                                <path d="M4 14h6v6h-6z" />
                                <path d="M14 14h6v6h-6z" />
                            </svg>
                        </div>
                        <span class="ml-2 text-[10px] uppercase tracking-wider">Dashboard</span>
                        @if(request()->routeIs('dashboard'))
                            <div class="absolute right-0 top-0 bottom-0 w-0.5 bg-white/30"></div>
                        @endif
                    </a>
                </li>

                <!-- Calendar -->
                <li>
                    <a href="{{ route('calendar.index') }}" @class([
                        'flex w-full items-center px-3 py-2 rounded-lg transition-all duration-300 group relative overflow-hidden',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20 scale-[1.01]' => request()->routeIs('calendar.*'),
                        'text-slate-500 hover:bg-primary/5 hover:text-primary font-bold' => !request()->routeIs('calendar.*')
                    ])>
                        <div @class(['size-6 rounded-md flex items-center justify-center mr-1 transition-colors', 'bg-primary-content/20' => request()->routeIs('calendar.*'), 'bg-slate-100 group-hover:bg-primary/10' => !request()->routeIs('calendar.*')])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <path d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                        </div>
                        <span class="ml-2 text-[10px] uppercase tracking-wider">Calendar</span>
                        @if(request()->routeIs('calendar.*'))
                            <div class="absolute right-0 top-0 bottom-0 w-0.5 bg-white/30"></div>
                        @endif
                    </a>
                </li>

                <!-- Announcements -->
                <li>
                    <a href="{{ route('announcements.index') }}" @class([
                        'flex w-full items-center px-3 py-2 rounded-lg transition-all duration-300 group relative overflow-hidden',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20 scale-[1.01]' => request()->routeIs('announcements.*'),
                        'text-slate-500 hover:bg-primary/5 hover:text-primary font-bold' => !request()->routeIs('announcements.*')
                    ])>
                        <div @class(['size-6 rounded-md flex items-center justify-center mr-1 transition-colors', 'bg-primary-content/20' => request()->routeIs('announcements.*'), 'bg-slate-100 group-hover:bg-primary/10' => !request()->routeIs('announcements.*')])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                                <path d="M8 8m0 0l4 0" />
                                <path d="M8 12m0 0l4 0" />
                                <path d="M8 16m0 0l4 0" />
                            </svg>
                        </div>
                        <span class="ml-2 text-[10px] uppercase tracking-wider">Announcements</span>
                    </a>
                </li>

                <!-- Tasks -->
                <li>
                    <a href="{{ route('tasks.index') }}" @class([
                        'flex w-full items-center px-3 py-2 rounded-lg transition-all duration-300 group relative overflow-hidden',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20 scale-[1.01]' => request()->routeIs('tasks.*'),
                        'text-slate-500 hover:bg-primary/5 hover:text-primary font-bold' => !request()->routeIs('tasks.*')
                    ])>
                        <div @class(['size-6 rounded-md flex items-center justify-center mr-1 transition-colors', 'bg-primary-content/20' => request()->routeIs('tasks.*'), 'bg-slate-100 group-hover:bg-primary/10' => !request()->routeIs('tasks.*')])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 11l3 3l8 -8" />
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                            </svg>
                        </div>
                        <span class="ml-2 text-[10px] uppercase tracking-wider">Tasks</span>
                    </a>
                </li>

                <!-- Group: WORKSPACE -->
                <li class="px-2 pt-3 pb-0.5">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Workspace</span>
                </li>

                <!-- Projects -->
                <li class="p-0" x-data="{ open: {{ request()->routeIs('projects.*') ? 'true' : 'false' }} }">
                    <div class="flex flex-col w-full p-0">
                        <button @click="open = !open"
                            class="flex w-full items-center px-3 py-2 rounded-lg transition-all duration-300 group text-slate-500 hover:bg-primary/5 hover:text-primary font-bold"
                            aria-haspopup="true" :aria-expanded="open">
                            <div
                                class="size-6 rounded-md bg-slate-100 group-hover:bg-primary/10 flex items-center justify-center mr-1 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" @class(['size-3.5', 'text-primary' => request()->routeIs('projects.*')]) viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                    <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                    <path d="M12 12l0 .01" />
                                    <path d="M3 13a20 20 0 0 0 18 0" />
                                </svg>
                            </div>
                            <span @class(['grow ml-2 text-left text-[10px] uppercase tracking-wider', 'text-primary' => request()->routeIs('projects.*')])>Projects</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3 transition-transform duration-300"
                                :class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6l6 -6" />
                            </svg>
                        </button>
                        <ul x-show="open" x-cloak x-collapse
                            class="mt-0.5 space-y-0.5 ml-4 pl-4 border-l-2 border-slate-100">
                            <li>
                                <a href="{{ route('projects.index') }}" @class(['flex items-center px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all group/sub', 'text-primary bg-primary/5 shadow-sm' => request()->routeIs('projects.index'), 'text-slate-400 hover:text-primary hover:bg-primary/5' => !request()->routeIs('projects.index')])>
                                    All Projects
                                </a>
                            </li>
                            @can('create', App\Models\Project::class)
                                <li>
                                    <a href="{{ route('projects.create') }}" @class(['flex items-center px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all group/sub', 'text-primary bg-primary/5 shadow-sm' => request()->routeIs('projects.create'), 'text-slate-400 hover:text-primary hover:bg-primary/5' => !request()->routeIs('projects.create')])>
                                        Create New
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                <!-- Tickets -->
                <li>
                    <a href="{{ route('tickets.index') }}" @class([
                        'flex w-full items-center px-3 py-2 rounded-lg transition-all duration-300 group relative overflow-hidden',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20 scale-[1.01]' => request()->routeIs('tickets.*'),
                        'text-slate-500 hover:bg-primary/5 hover:text-primary font-bold' => !request()->routeIs('tickets.*')
                    ])>
                        <div @class(['size-6 rounded-md flex items-center justify-center mr-1 transition-colors', 'bg-primary-content/20' => request()->routeIs('tickets.*'), 'bg-slate-100 group-hover:bg-primary/10' => !request()->routeIs('tickets.*')])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 5l0 2" />
                                <path d="M15 11l0 2" />
                                <path d="M15 17l0 2" />
                                <path
                                    d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                            </svg>
                        </div>
                        <span class="ml-2 text-[10px] uppercase tracking-wider">Tickets</span>
                    </a>
                </li>

                <!-- Team Members -->
                <li>
                    <a href="{{ route('users.index') }}" @class([
                        'flex w-full items-center px-3 py-2 rounded-lg transition-all duration-300 group relative overflow-hidden',
                        'bg-primary text-primary-content font-bold shadow-md shadow-primary/20 scale-[1.01]' => request()->routeIs('users.index') && !auth()->user()->isAdmin(),
                        'text-slate-500 hover:bg-primary/5 hover:text-primary font-bold' => !(request()->routeIs('users.index') && !auth()->user()->isAdmin())
                    ])>
                        <div @class(['size-6 rounded-md flex items-center justify-center mr-1 transition-colors', 'bg-primary-content/20' => request()->routeIs('users.index') && !auth()->user()->isAdmin(), 'bg-slate-100 group-hover:bg-primary/10' => !request()->routeIs('users.index') && !auth()->user()->isAdmin()])>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                        </div>
                        <span class="ml-2 text-[10px] uppercase tracking-wider">Team Members</span>
                    </a>
                </li>

                <!-- Administration -->
                @if(auth()->user()->isAdmin())
                    <li class="px-2 pt-3 pb-0.5">
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Administration</span>
                    </li>

                    <li class="p-0"
                        x-data="{ open: {{ (request()->routeIs('users.*') || request()->routeIs('permissions.*')) ? 'true' : 'false' }} }">
                        <div class="flex flex-col w-full p-0">
                            <button @click="open = !open"
                                class="flex w-full items-center px-3 py-2 rounded-lg transition-all duration-300 group text-slate-500 hover:bg-primary/5 hover:text-primary font-bold"
                                aria-haspopup="true" :aria-expanded="open">
                                <div
                                    class="size-6 rounded-md bg-slate-100 group-hover:bg-primary/10 flex items-center justify-center mr-1 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" @class(['size-3.5', 'text-primary' => (request()->routeIs('users.*') || request()->routeIs('permissions.*'))])
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37a1.724 1.724 0 0 0 2.572 -1.065" />
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                    </svg>
                                </div>
                                <span @class(['grow ml-2 text-left text-[10px] uppercase tracking-wider', 'text-primary' => (request()->routeIs('users.*') || request()->routeIs('permissions.*'))])>Management</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 transition-transform duration-300"
                                    :class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 9l6 6l6 -6" />
                                </svg>
                            </button>
                            <ul x-show="open" x-cloak x-collapse
                                class="mt-0.5 space-y-0.5 ml-4 pl-4 border-l-2 border-slate-100">
                                <li>
                                    <a href="{{ route('users.index') }}" @class(['flex items-center px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all group/sub', 'text-primary bg-primary/5 shadow-sm' => request()->routeIs('users.index'), 'text-slate-400 hover:text-primary hover:bg-primary/5' => !request()->routeIs('users.index')])>
                                        User Directory
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('permissions.index') }}" @class(['flex items-center px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all group/sub', 'text-primary bg-primary/5 shadow-sm' => request()->routeIs('permissions.*'), 'text-slate-400 hover:text-primary hover:bg-primary/5' => !request()->routeIs('permissions.*')])>
                                        Permissions
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Sidebar Footer - User Profile -->
        <div class="p-2 border-t border-base-content/5 bg-base-100/50">
            <div
                class="flex items-center gap-2 p-1.5 rounded-lg bg-base-100 border border-base-content/5 shadow-sm group transition-all duration-300 hover:shadow-md hover:border-primary/10">
                <div class="relative">
                    <div
                        class="size-7 rounded-md overflow-hidden border-2 border-primary/10 transition-transform group-hover:scale-105 duration-300">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                            class="object-cover w-full h-full" />
                    </div>
                    <div
                        class="absolute -bottom-0.5 -right-0.5 size-2 bg-success border-2 border-white rounded-full shadow-sm animate-pulse">
                    </div>
                </div>
                <div class="flex flex-col min-w-0 grow">
                    <h6
                        class="text-[9px] font-black text-base-content truncate uppercase tracking-wider group-hover:text-primary transition-colors">
                        {{ auth()->user()->name }}
                    </h6>
                    <p class="text-[7px] font-bold text-slate-400 uppercase tracking-widest truncate">
                        {{ auth()->user()->role ?? 'User' }}
                    </p>
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