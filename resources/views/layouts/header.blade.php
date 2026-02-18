<div class="bg-base-100/80 backdrop-blur-md shadow-sm sticky top-0 z-40 flex flex-shrink-0">
    <div class="w-full px-6">
        <nav class="navbar h-16 min-h-[4rem] p-0">
            <div class="navbar-start items-center gap-3">
                <button type="button"
                    class="lg:hidden size-9 rounded-xl bg-slate-900 text-white flex items-center justify-center shadow-lg active:scale-90 transition-all hover:bg-slate-800"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="layout-sidebar"
                    data-overlay="#layout-sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6l16 0" />
                        <path d="M4 12l16 0" />
                        <path d="M4 18l16 0" />
                    </svg>
                </button>
            </div>

            <div class="navbar-end items-center gap-4">
                <!-- Theme Switcher -->
                <div class="relative inline-flex z-50" x-data="{ open: false }" @click.outside="open = false">
                    <button type="button"
                        class="btn btn-ghost btn-circle btn-sm hover:bg-base-content/10 transition-colors"
                        :class="{ 'bg-base-content/10': open }" @click="open = !open">
                        <!-- Sun Icon (Show in Light) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 block dark:hidden" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                        </svg>
                        <!-- Moon Icon (Show in Dark) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 hidden dark:block" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                        </svg>
                    </button>
                    <ul class="absolute right-0 top-full mt-2 min-w-40 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-base-content/5 rounded-2xl overflow-hidden p-1.5 bg-base-100 ring-1 ring-black/5"
                        x-show="open" x-cloak x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                        <li>
                            <button type="button"
                                class="flex items-center w-full px-3 py-2 rounded-lg text-xs font-medium text-base-content/70 hover:text-base-content hover:bg-base-content/5 transition-all gap-3"
                                onclick="setTheme('light')" data-theme-value="light">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path
                                        d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                                </svg>
                                Light
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="size-3 ml-auto theme-check hidden text-primary" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            </button>
                        </li>
                        <li>
                            <button type="button"
                                class="flex items-center w-full px-3 py-2 rounded-lg text-xs font-medium text-base-content/70 hover:text-base-content hover:bg-base-content/5 transition-all gap-3"
                                onclick="setTheme('dark')" data-theme-value="dark">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                                </svg>
                                Dark
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="size-3 ml-auto theme-check hidden text-primary" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            </button>
                        </li>
                        <li>
                            <button type="button"
                                class="flex items-center w-full px-3 py-2 rounded-lg text-xs font-medium text-base-content/70 hover:text-base-content hover:bg-base-content/5 transition-all gap-3"
                                onclick="setTheme('system')" data-theme-value="system">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                                    <path d="M7 20h10" />
                                    <path d="M9 16v4" />
                                    <path d="M15 16v4" />
                                </svg>
                                System
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="size-3 ml-auto theme-check hidden text-primary" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Notification Dropdown -->
                @php
                    $isPowerUser = auth()->user()->isAdmin() || auth()->user()->isDirector();
                    $unreadCount = $isPowerUser
                        ? \Illuminate\Notifications\DatabaseNotification::whereNull('read_at')->count()
                        : auth()->user()->unreadNotifications()->count();

                    $notifications = $isPowerUser
                        ? \Illuminate\Notifications\DatabaseNotification::whereNull('read_at')->with('notifiable')->latest()->take(20)->get()
                        : auth()->user()->unreadNotifications;
                @endphp
                <div class="relative inline-flex z-50" x-data="{ open: false }" @click.outside="open = false">
                    <button type="button"
                        class="btn btn-ghost btn-circle btn-sm hover:bg-base-content/10 transition-colors relative"
                        :class="{ 'bg-base-content/10': open }" @click="open = !open">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        @if($unreadCount > 0)
                            <span
                                class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-base-100"></span>
                        @endif
                    </button>

                    <div class="absolute right-0 top-full mt-2 min-w-80 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] border border-base-content/5 rounded-2xl overflow-hidden bg-base-100 pb-2 ring-1 ring-black/5"
                        x-show="open" x-cloak x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                        <div
                            class="flex items-center justify-between px-4 py-3 border-b border-base-content/5 bg-base-200/50">
                            <h6 class="text-sm font-bold text-base-content">
                                {{ $isPowerUser ? 'System activity' : 'Notifications' }}
                            </h6>
                            @if($unreadCount > 0)
                                <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-[10px] font-bold uppercase tracking-wider text-primary hover:text-primary-focus transition-colors">Mark
                                        all read</button>
                                </form>
                            @endif
                        </div>

                        <div class="max-h-[300px] overflow-y-auto custom-scrollbar">
                            @forelse($notifications as $notification)
                                <a href="{{ $notification->data['action_url'] ?? '#' }}"
                                    onclick="markAsRead(event, '{{ $notification->id }}', '{{ $notification->data['action_url'] ?? '#' }}')"
                                    class="flex gap-3 px-4 py-3 hover:bg-base-content/5 transition-colors border-b border-base-content/5 last:border-0 group">
                                    <div class="mt-1">
                                        @if(($notification->data['type'] ?? '') == 'task_assigned')
                                            <div
                                                class="size-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M9 12l2 2l4 -4" />
                                                </svg>
                                            </div>
                                        @elseif(($notification->data['type'] ?? '') == 'project_assigned')
                                            <div
                                                class="size-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M3 21l18 0" />
                                                    <path d="M9 8l1 0" />
                                                    <path d="M9 12l1 0" />
                                                    <path d="M9 16l1 0" />
                                                    <path d="M14 8l1 0" />
                                                    <path d="M14 12l1 0" />
                                                    <path d="M14 16l1 0" />
                                                    <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
                                                </svg>
                                            </div>
                                        @elseif(($notification->data['type'] ?? '') == 'ticket_assigned')
                                            <div
                                                class="size-8 rounded-full bg-warning/10 flex items-center justify-center text-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M15 5l0 2" />
                                                    <path d="M15 11l0 2" />
                                                    <path d="M15 17l0 2" />
                                                    <path
                                                        d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                                                </svg>
                                            </div>
                                        @elseif(($notification->data['type'] ?? '') == 'task_deadline')
                                            <div
                                                class="size-8 rounded-full bg-error/10 flex items-center justify-center text-error">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M12 7v5l3 3" />
                                                </svg>
                                            </div>
                                        @elseif(($notification->data['type'] ?? '') == 'announcement')
                                            <div
                                                class="size-8 rounded-full bg-[#14b8a6]/10 flex items-center justify-center text-[#14b8a6]">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M11 15h2a2 2 0 1 0 0 -4h-7a2 2 0 1 0 0 4v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1 -1v-3z" />
                                                    <path d="M15 10l4.5 -4.5" />
                                                    <path d="M15 14l4.5 4.5" />
                                                    <path d="M18.3 10h.7" />
                                                    <path d="M18.3 14h.7" />
                                                </svg>
                                            </div>
                                        @else
                                            <div
                                                class="size-8 rounded-full bg-base-content/10 flex items-center justify-center text-base-content/70">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                                                    <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <p
                                            class="text-xs font-bold text-base-content group-hover:text-primary transition-colors truncate">
                                            {{ $notification->data['title'] ?? 'Notification' }}
                                        </p>
                                        <p
                                            class="text-[11px] font-medium text-base-content/60 line-clamp-1 leading-tight mt-0.5">
                                            {{ $notification->data['message'] ?? 'No message' }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-1.5">
                                            <p
                                                class="text-[9px] text-base-content/30 font-bold uppercase tracking-tighter shrink-0">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                            @if($isPowerUser && isset($notification->notifiable))
                                                <div class="w-1 h-1 rounded-full bg-base-content/10 shrink-0"></div>
                                                <div class="flex items-center gap-1 min-w-0">
                                                    <span
                                                        class="text-[8px] font-black text-primary/40 uppercase tracking-widest shrink-0">FOR:</span>
                                                    <span
                                                        class="text-[9px] text-primary font-black uppercase tracking-tight truncate">
                                                        {{ $notification->notifiable->name }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="px-4 py-8 text-center">
                                    <div
                                        class="size-12 rounded-full bg-base-content/5 flex items-center justify-center mx-auto mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-base-content/30"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path d="M9 12l2 2l4 -4" />
                                        </svg>
                                    </div>
                                    <p class="text-xs font-medium text-base-content/50">No new notifications</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <script>
                    function markAsRead(event, id, actionUrl) {
                        // Prevent default link behavior
                        event.preventDefault();

                        // Get CSRF token
                        const csrfToken = document.querySelector('meta[name="csrf-token"]');
                        if (!csrfToken) {
                            console.error('CSRF token not found');
                            // Navigate anyway if CSRF token is missing
                            if (actionUrl && actionUrl !== '#') {
                                window.location.href = actionUrl;
                            }
                            return;
                        }

                        // Mark notification as read
                        fetch(`/notifications/${id}/read`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        })
                            .then(response => {
                                if (response.ok) {
                                    // Navigate to the action URL after marking as read
                                    if (actionUrl && actionUrl !== '#') {
                                        window.location.href = actionUrl;
                                    } else {
                                        // If no action URL, just reload the page to update the notification badge
                                        window.location.reload();
                                    }
                                } else {
                                    console.error('Failed to mark notification as read');
                                    // Navigate anyway even if marking failed
                                    if (actionUrl && actionUrl !== '#') {
                                        window.location.href = actionUrl;
                                    }
                                }
                            })
                            .catch(error => {
                                console.error('Error marking notification as read:', error);
                                // Navigate anyway even if there was an error
                                if (actionUrl && actionUrl !== '#') {
                                    window.location.href = actionUrl;
                                }
                            });
                    }
                </script>

                <!-- Profile Dropdown -->
                <div class="relative inline-flex z-50" x-data="{ open: false }" @click.outside="open = false">
                    <button type="button" class="avatar p-0.5 rounded-xl transition-all group hover:bg-base-content/5"
                        @click="open = !open">
                        <div class="size-9 rounded-xl overflow-hidden relative transition-colors shadow-sm">
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                                class="object-cover w-full h-full" />
                        </div>
                    </button>
                    <div class="absolute right-0 top-full mt-3 w-72 shadow-[0_20px_50px_-20px_rgba(0,0,0,0.25)] rounded-[2rem] overflow-hidden bg-base-100"
                        x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-2 scale-95">

                        <!-- Header Section -->
                        <div class="p-6 pb-5">
                            <div class="flex items-start gap-4">
                                <div class="size-12 rounded-xl overflow-hidden shadow-sm shrink-0">
                                    <img src="{{ auth()->user()->profile_photo_url }}"
                                        class="object-cover w-full h-full" />
                                </div>
                                <div class="flex flex-col min-w-0 grow pt-0.5">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h6
                                            class="text-[14px] font-bold text-slate-800 dark:text-white truncate leading-none transition-colors">
                                            {{ auth()->user()->name }}
                                        </h6>
                                        @php
                                            $status = auth()->user()->todayAvailability?->status ?? 'available';
                                            $statusConfig = [
                                                'available' => [
                                                    'label' => 'AVAILABLE',
                                                    'class' => 'bg-success/10 text-success'
                                                ],
                                                'busy' => [
                                                    'label' => 'BUSY',
                                                    'class' => 'bg-error/10 text-error'
                                                ],
                                                'on_leave' => [
                                                    'label' => 'ON LEAVE',
                                                    'class' => 'bg-warning/10 text-warning'
                                                ],
                                            ];
                                            $config = $statusConfig[$status] ?? $statusConfig['available'];
                                        @endphp
                                        <div
                                            class="px-2 py-1 {{ $config['class'] }} text-[8px] font-bold tracking-widest rounded-lg uppercase leading-none border-none">
                                            <div class="flex items-center gap-1.5">
                                                <div class="w-1 h-1 rounded-full bg-current"></div>
                                                {{ $config['label'] }}
                                            </div>
                                        </div>
                                    </div>
                                    <p
                                        class="text-[11px] font-bold text-slate-400 dark:text-slate-500 truncate tracking-tight">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                            </div>

                            <!-- Status Row -->
                            <div class="mt-7 flex items-center gap-4">
                                <span
                                    class="text-[8.5px] font-bold uppercase tracking-widest text-slate-400 shrink-0 ml-1">Status</span>
                                <form action="{{ route('availability.update') }}" method="POST" id="status-form-exact"
                                    class="grow">
                                    @csrf
                                    <div class="relative group">
                                        <select name="status" onchange="this.form.submit()"
                                            class="appearance-none w-full h-9 pl-4 pr-10 text-[10px] font-bold uppercase tracking-widest rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-slate-300 focus:border-primary/40 focus:ring-4 focus:ring-primary/5 transition-all cursor-pointer text-slate-700 dark:text-slate-200 outline-none shadow-sm">
                                            @php $cs = auth()->user()->todayAvailability?->status ?? 'available'; @endphp
                                            <option value="available" {{ $cs == 'available' ? 'selected' : '' }}>Available
                                            </option>
                                            <option value="busy" {{ $cs == 'busy' ? 'selected' : '' }}>Busy</option>
                                            <option value="on_leave" {{ $cs == 'on_leave' ? 'selected' : '' }}>On Leave
                                            </option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m6 9 6 6 6-6" />
                                            </svg>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="h-px bg-slate-100 dark:bg-slate-800 mx-6"></div>

                        <!-- Actions List -->
                        <div class="px-2 py-3">
                            <a href="{{ route('users.edit', auth()->user()) }}"
                                class="flex items-center w-full h-11 px-5 rounded-2xl text-[9px] font-bold uppercase tracking-widest text-slate-500 hover:text-slate-800 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 transition-all group">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="size-5 mr-3.5 text-slate-300 group-hover:text-slate-500 transition-colors"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <circle cx="12" cy="10" r="3" />
                                    <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                                </svg>
                                Account Settings
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="w-full mt-0.5">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full h-11 px-5 rounded-2xl text-[9px] font-bold uppercase tracking-widest text-[#FF5A5F] hover:bg-[#FFF5F5] dark:hover:bg-red-500/10 transition-all group text-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 mr-3.5 opacity-70"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <polyline points="16 17 21 12 16 7" />
                                        <line x1="21" y1="12" x2="9" y2="12" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>