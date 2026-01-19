<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div
                        class="badge badge-lg font-bold text-[10px] uppercase tracking-widest bg-primary/5 text-primary border-0">
                        Dashboard</div>
                    <div class="h-4 w-px bg-base-content/10"></div>
                    <span class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">Calendar</span>
                </div>

                <div class="flex items-center gap-4">
                    <div
                        class="size-12 rounded-2xl bg-primary shadow-lg shadow-primary/20 flex items-center justify-center text-primary-content">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-base-content tracking-tight">Calendar</h1>
                        <p class="text-sm font-medium text-base-content/60 mt-0.5">Track your tickets and tasks
                            timeline.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        {{-- KPI Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Tickets Assigned --}}
            <div class="card bg-gradient-to-br from-amber-400 to-orange-500 text-white shadow-xl rounded-2xl p-5">
                <div class="text-4xl font-black mb-1">{{ $ticketsAssigned }}</div>
                <div class="text-xs font-bold uppercase tracking-wider opacity-90">Tickets Assigned</div>
            </div>

            {{-- Tickets Created --}}
            <div class="card bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-xl rounded-2xl p-5">
                <div class="text-4xl font-black mb-1">{{ $ticketsCreated }}</div>
                <div class="text-xs font-bold uppercase tracking-wider opacity-90">Tickets Created</div>
            </div>

            {{-- Tasks Assigned --}}
            <div class="card bg-gradient-to-br from-purple-500 to-purple-600 text-white shadow-xl rounded-2xl p-5">
                <div class="text-4xl font-black mb-1">{{ $trackersAssigned }}</div>
                <div class="text-xs font-bold uppercase tracking-wider opacity-90">Tasks Assigned</div>
            </div>

            {{-- Tasks Created --}}
            <div class="card bg-gradient-to-br from-pink-500 to-pink-600 text-white shadow-xl rounded-2xl p-5">
                <div class="text-4xl font-black mb-1">{{ $trackersCreated }}</div>
                <div class="text-xs font-bold uppercase tracking-wider opacity-90">Tasks Created</div>
            </div>
        </div>

        {{-- Event Types Legend --}}
        <div class="card bg-white shadow-xl border border-base-content/5 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-slate-900">Event Types</h3>
                <span class="badge badge-warning badge-md font-bold uppercase tracking-wider">Interactive Legend</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="flex items-center gap-3">
                    <div class="size-5 rounded bg-amber-400"></div>
                    <span class="text-base font-semibold text-slate-700">Ticket - Assigned (Open)</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="size-5 rounded bg-blue-500"></div>
                    <span class="text-base font-semibold text-slate-700">Ticket - Created by Me</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="size-5 rounded bg-purple-500"></div>
                    <span class="text-base font-semibold text-slate-700">Task - Assigned to Me</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="size-5 rounded bg-pink-500"></div>
                    <span class="text-base font-semibold text-slate-700">Task - Created by Me</span>
                </div>
            </div>
        </div>

        {{-- Calendar --}}
        <div class="card bg-white shadow-xl border border-base-content/5 rounded-2xl overflow-hidden">
            <div class="p-6">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    @push('styles')
        {{-- FullCalendar CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
        {{-- FullCalendar JS --}}
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    buttonText: {
                        today: 'Today',
                        month: 'Month',
                        week: 'Week',
                        day: 'Day',
                        list: 'List'
                    },
                    height: 'auto',
                    contentHeight: 650,
                    events: '{{ route('calendar.events') }}',
                    eventClick: function (info) {
                        info.jsEvent.preventDefault();
                        if (info.event.url) {
                            window.location.href = info.event.url;
                        }
                    },
                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        meridiem: false
                    },
                    // Styling
                    themeSystem: 'standard',
                    dayMaxEvents: 3,
                    moreLinkText: 'more',
                    navLinks: true,
                    editable: false,
                    selectable: false,
                    selectMirror: true,
                    nowIndicator: true,
                    // Custom styling
                    eventClassNames: function (arg) {
                        return ['rounded-lg', 'px-2', 'py-1', 'text-xs', 'font-bold', 'shadow-sm'];
                    }
                });
                calendar.render();

                // Custom styling for FullCalendar
                const style = document.createElement('style');
                style.textContent = `
                        .fc {
                            font-family: inherit;
                        }
                        .fc .fc-toolbar-title {
                            font-size: 1.5rem;
                            font-weight: 900;
                            color: #1e293b;
                        }
                        .fc .fc-button {
                            background-color: #6366f1;
                            border: none;
                            border-radius: 0.5rem;
                            padding: 0.5rem 1rem;
                            font-weight: 700;
                            text-transform: uppercase;
                            font-size: 0.75rem;
                            letter-spacing: 0.05em;
                            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.2);
                        }
                        .fc .fc-button:hover {
                            background-color: #4f46e5;
                        }
                        .fc .fc-button-active {
                            background-color: #4338ca !important;
                        }
                        .fc .fc-button:disabled {
                            opacity: 0.5;
                        }
                        .fc-theme-standard td, .fc-theme-standard th {
                            border-color: #e2e8f0;
                        }
                        .fc .fc-daygrid-day-number {
                            font-weight: 700;
                            color: #475569;
                            padding: 0.5rem;
                        }
                        .fc .fc-col-header-cell {
                            background-color: #f8fafc;
                            font-weight: 800;
                            text-transform: uppercase;
                            font-size: 0.75rem;
                            letter-spacing: 0.05em;
                            color: #64748b;
                            padding: 1rem 0.5rem;
                        }
                        .fc .fc-daygrid-day.fc-day-today {
                            background-color: #eef2ff !important;
                        }
                        .fc .fc-event {
                            border: none;
                            margin-bottom: 2px;
                        }
                        .fc .fc-event-title {
                            font-weight: 700;
                        }
                        .fc .fc-more-link {
                            font-weight: 700;
                            color: #6366f1;
                        }
                        .fc .fc-list-event:hover td {
                            background-color: #f8fafc;
                        }
                    `;
                document.head.appendChild(style);
            });
        </script>
    @endpush
</x-app-layout>