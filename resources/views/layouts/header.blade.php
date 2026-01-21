<div class="bg-base-100/80 backdrop-blur-md border-b border-base-content/[0.08] sticky top-0 z-40 flex flex-shrink-0">
    <div class="w-full px-6">
        <nav class="navbar h-16 min-h-[4rem] p-0">
            <div class="navbar-start items-center gap-3">
                <button type="button" class="btn btn-ghost btn-square btn-sm lg:hidden hover:bg-base-content/10" aria-haspopup="dialog"
                    aria-expanded="false" aria-controls="layout-sidebar" data-overlay="#layout-sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" /></svg>
                </button>
            </div>

            <div class="navbar-end items-center gap-4">
                <!-- Theme Switcher -->
                <div class="dropdown dropdown-end relative inline-flex [--offset:12] z-50">
                    <button type="button" class="btn btn-ghost btn-circle btn-sm hover:bg-base-content/10 transition-colors" aria-haspopup="menu" aria-expanded="false" aria-label="Theme Switcher">
                        <!-- Sun Icon (Show in Light) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 block dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                        </svg>
                        <!-- Moon Icon (Show in Dark) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 hidden dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                        </svg>
                    </button>
                    <ul class="dropdown-menu dropdown-open:opacity-100 min-w-40 hidden shadow-[0_0_50px_-12px_rgb(0,0,0,0.25)] border border-base-content/5 rounded-2xl overflow-hidden p-1.5 bg-base-100" role="menu">
                        <li>
                            <button type="button" class="flex items-center w-full px-3 py-2 rounded-lg text-xs font-medium text-base-content/70 hover:text-base-content hover:bg-base-content/5 transition-all gap-3"
                                onclick="window.themeManager.setTheme('light')" data-theme-value="light">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                                Light
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-auto theme-check hidden text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10" /></svg>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="flex items-center w-full px-3 py-2 rounded-lg text-xs font-medium text-base-content/70 hover:text-base-content hover:bg-base-content/5 transition-all gap-3"
                                onclick="window.themeManager.setTheme('dark')" data-theme-value="dark">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" /></svg>
                                Dark
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-auto theme-check hidden text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10" /></svg>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="flex items-center w-full px-3 py-2 rounded-lg text-xs font-medium text-base-content/70 hover:text-base-content hover:bg-base-content/5 transition-all gap-3"
                                onclick="window.themeManager.setTheme('system')" data-theme-value="system">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" /><path d="M7 20h10" /><path d="M9 16v4" /><path d="M15 16v4" /></svg>
                                System
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-auto theme-check hidden text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10" /></svg>
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Notification Dropdown -->
                <div class="dropdown dropdown-end relative inline-flex [--offset:12] z-50">
                    <button type="button" class="btn btn-ghost btn-circle btn-sm hover:bg-base-content/10 transition-colors relative" aria-haspopup="menu" aria-expanded="false" aria-label="Notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge badge-xs badge-error absolute top-0.5 right-0.5 size-2 p-0 border border-base-100"></span>
                        @endif
                    </button>
                    
                    <div class="dropdown-menu dropdown-open:opacity-100 min-w-80 hidden shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-base-content/5 rounded-2xl overflow-hidden bg-base-100 pb-2" role="menu">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-base-content/5 bg-base-200/50">
                            <h6 class="text-sm font-bold text-base-content">Notifications</h6>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[10px] font-bold uppercase tracking-wider text-primary hover:text-primary-focus transition-colors">Mark all read</button>
                                </form>
                            @endif
                        </div>

                        <div class="max-h-[300px] overflow-y-auto custom-scrollbar">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <a href="{{ $notification->data['action_url'] ?? '#' }}" onclick="markAsRead('{{ $notification->id }}')" class="flex gap-3 px-4 py-3 hover:bg-base-content/5 transition-colors border-b border-base-content/5 last:border-0 group">
                                    <div class="mt-1">
                                        @if(($notification->data['type'] ?? '') == 'task_assigned')
                                             <div class="size-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                             </div>
                                        @elseif(($notification->data['type'] ?? '') == 'project_assigned')
                                             <div class="size-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>
                                             </div>
                                        @elseif(($notification->data['type'] ?? '') == 'ticket_assigned')
                                             <div class="size-8 rounded-full bg-warning/10 flex items-center justify-center text-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l0 2" /><path d="M15 11l0 2" /><path d="M15 17l0 2" /><path d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" /></svg>
                                             </div>
                                        @elseif(($notification->data['type'] ?? '') == 'task_deadline')
                                             <div class="size-8 rounded-full bg-error/10 flex items-center justify-center text-error">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                                             </div>
                                        @else
                                             <div class="size-8 rounded-full bg-base-content/10 flex items-center justify-center text-base-content/70">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                                             </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-base-content group-hover:text-primary transition-colors">{{ $notification->data['title'] ?? 'Notification' }}</p>
                                        <p class="text-[11px] text-base-content/60 mt-0.5 line-clamp-2">{{ $notification->data['message'] ?? '' }}</p>
                                        <p class="text-[10px] text-base-content/40 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                </a>
                            @empty
                                <div class="px-4 py-8 text-center">
                                    <div class="size-12 rounded-full bg-base-content/5 flex items-center justify-center mx-auto mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-base-content/30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                    </div>
                                    <p class="text-xs font-medium text-base-content/50">No new notifications</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <script>
                    function markAsRead(id) {
                        fetch(`/notifications/${id}/read`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json'
                            },
                             keepalive: true
                        });
                    }
                </script>

                <!-- Profile Dropdown -->
                <div class="dropdown dropdown-end relative inline-flex [--offset:12]">
                    <button id="profile-dropdown" type="button" class="dropdown-toggle avatar p-0.5 rounded-xl transition-all hover:bg-base-content/5" aria-haspopup="menu"
                        aria-expanded="false" aria-label="Dropdown">
                        <div class="size-9 rounded-xl overflow-hidden border border-base-content/10 shadow-sm relative">
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                                class="object-cover w-full h-full" />
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-open:opacity-100 min-w-80 hidden shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-base-content/5 rounded-2xl overflow-hidden bg-base-100 pb-2" role="menu"
                        aria-orientation="vertical" aria-labelledby="profile-dropdown">
                        <!-- User Header Block -->
                        <li class="dropdown-header p-4 bg-base-200/50 border-b border-base-content/5">
                            <div class="flex items-start gap-3">
                                <div class="avatar online shrink-0">
                                    <div class="size-10 rounded-xl overflow-hidden border border-base-content/10 shadow-sm ring-1 ring-base-100">
                                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                                            class="object-cover w-full h-full" />
                                    </div>
                                </div>
                                <div class="flex flex-col min-w-0 grow">
                                    <!-- Name & Badge Row -->
                                    <div class="flex items-center gap-2">
                                        <h6 class="text-sm font-black text-base-content truncate leading-tight">{{ auth()->user()->name }}</h6>
                                        <div id="status-badge" class="badge badge-xs text-[9px] font-black tracking-tighter px-1.5 py-2 bg-primary/10 text-primary border-primary/10 transition-colors duration-300">
                                            {{ auth()->user()->todayAvailability?->status === 'medical_leave' ? 'SICK' : (auth()->user()->todayAvailability?->status === 'vacation' ? 'AWAY' : 'LIVE') }}
                                        </div>
                                    </div>
                                    <p class="text-[11px] font-medium text-base-content/50 truncate mt-0.5">{{ auth()->user()->email }}</p>
                                    
                                    <!-- Inline Status Row -->
                                    <form action="{{ route('availability.update') }}" method="POST" class="mt-2.5" id="availability-form">
                                        @csrf
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="text-[9px] font-bold uppercase tracking-wider text-base-content/40 shrink-0">Status</span>
                                            <div class="relative group grow max-w-[140px]" onclick="event.stopPropagation()">
                                                <select name="status" onchange="updateAvailabilityStatus(this)" onclick="event.stopPropagation()"
                                                    class="appearance-none w-full h-7 pl-2.5 pr-6 text-[10px] font-bold uppercase tracking-wide rounded-lg bg-base-100 border border-base-content/10 hover:border-primary/30 focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all cursor-pointer text-base-content outline-none shadow-sm">
                                                    @php $currentStatus = auth()->user()->todayAvailability?->status ?? 'present'; @endphp
                                                    <option value="present" {{ $currentStatus == 'present' ? 'selected' : '' }}>Available</option>
                                                    <option value="medical_leave" {{ $currentStatus == 'medical_leave' ? 'selected' : '' }}>On Leave</option>
                                                    <option value="vacation" {{ $currentStatus == 'vacation' ? 'selected' : '' }}>Vacation</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1.5 text-base-content/40 group-hover:text-primary transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6l6 -6" /></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                        <script>
                            function updateAvailabilityStatus(select) {
                                const form = select.form;
                                const formData = new FormData(form);
                                const badge = document.getElementById('status-badge');
                                
                                // Optimistic UI Update
                                const value = select.value;
                                if(value === 'present') {
                                    badge.innerText = 'LIVE';
                                    badge.className = 'badge badge-xs text-[9px] font-black tracking-tighter px-1.5 py-2 bg-primary/10 text-primary border-primary/10 transition-colors duration-300';
                                } else if(value === 'medical_leave') {
                                    badge.innerText = 'SICK';
                                    badge.className = 'badge badge-xs text-[9px] font-black tracking-tighter px-1.5 py-2 bg-error/10 text-error border-error/10 transition-colors duration-300';
                                } else if(value === 'vacation') {
                                    badge.innerText = 'AWAY';
                                    badge.className = 'badge badge-xs text-[9px] font-black tracking-tighter px-1.5 py-2 bg-warning/10 text-warning border-warning/10 transition-colors duration-300';
                                }

                                // Send Request
                                fetch(form.action, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                        'Accept': 'application/json'
                                    },
                                    body: formData
                                }).then(res => {
                                    if(!res.ok) console.error('Status update failed');
                                }).catch(err => console.error(err));
                            }
                        </script>

                        <!-- Actions Section -->
                        <li class="px-2 pt-2">
                            <a class="flex items-center w-full h-10 px-3 rounded-lg text-[11px] font-bold uppercase tracking-wider text-base-content/70 hover:text-base-content hover:bg-base-content/5 transition-all group" href="{{ route('users.edit', auth()->user()) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-3 opacity-50 group-hover:opacity-100 transition-opacity" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                                Account Settings
                            </a>
                        </li>

                        <li class="my-1 border-t border-base-content/5 mx-2"></li>

                        <!-- Destructive Section -->
                        <li class="px-2 pb-1">
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full h-10 px-3 rounded-lg text-[11px] font-bold uppercase tracking-wider text-error/70 hover:text-error hover:bg-error/5 transition-all group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-3 opacity-50 group-hover:opacity-100 transition-opacity" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>