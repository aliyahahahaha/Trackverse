<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('tickets.index') }}" 
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        ALL TICKETS
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <a href="{{ route('tickets.index', ['filter' => 'mine']) }}" 
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        MY TICKETS
                    </a>
                </div>
            </div>

            <!-- Main Header Content -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="size-16 rounded-[1.5rem] bg-primary shadow-2xl shadow-primary/20 flex items-center justify-center text-primary-content shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 5l0 2" /><path d="M15 11l0 2" /><path d="M15 17l0 2" />
                            <path d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Support Tickets</h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Manage and track issue reports across your projects.</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="px-5 py-3 bg-white rounded-2xl border border-base-content/5 shadow-sm">
                        <span class="text-[9px] font-bold uppercase tracking-widest text-base-content/30 block leading-none mb-1.5">Total Reports</span>
                        <span class="text-sm font-bold text-base-content leading-none">{{ $tickets->total() }} Tickets</span>
                    </div>
                    @if(auth()->user()->hasPermission('create_tickets'))
                        <a href="{{ route('tickets.create') }}"
                            class="btn btn-primary h-12 px-8 gap-3 font-bold uppercase text-[10px] tracking-widest shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all rounded-2xl border-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5l0 14" /><path d="M5 12l14 0" />
                            </svg>
                            NEW TICKET
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <div class="card bg-base-100 shadow-xl shadow-base-content/5 border border-base-content/5 rounded-[32px] overflow-hidden">
        <div class="card-body p-0">
            @if(session('success'))
                <div class="p-6 pb-0">
                    <div class="alert alert-success shadow-sm border-none bg-success/10 text-success font-bold text-sm rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="table align-middle">
                    <thead class="text-base-content/30 uppercase text-[9px] font-bold tracking-[0.2em] border-b border-base-content/5">
                        <tr>
                            <th class="px-8 py-6">Ticket</th>
                            <th class="py-6">Project</th>
                            <th class="py-6">Priority</th>
                            <th class="py-6">Category</th>
                            <th class="py-6">Assignee</th>
                            <th class="py-6">Status</th>
                            <th class="py-6">Reporter</th>
                            <th class="text-end px-8 py-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($tickets as $ticket)
                            <tr class="group hover:bg-base-200/20 transition-all border-b border-base-content/5 last:border-0 cursor-default">
                                <td class="px-8 py-5">
                                    <div class="font-bold text-base-content/90 group-hover:text-primary transition-colors">
                                        {{ $ticket->title }}
                                    </div>
                                    <div class="text-[11px] text-base-content/40 mt-1 font-medium italic">
                                        {{ Str::limit($ticket->description, 40) }}
                                    </div>
                                </td>
                                <td class="py-5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="p-2 bg-primary/5 rounded-xl text-primary border border-primary/5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                                <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                            </svg>
                                        </div>
                                        <span class="font-bold text-[10px] uppercase tracking-wider text-base-content/60">{{ $ticket->project->name }}</span>
                                    </div>
                                </td>
                                <td class="py-5">
                                    @php
                                        $pConfig = match($ticket->priority) {
                                            'high' => ['bg' => 'bg-red-50 text-red-500', 'dot' => 'bg-red-500', 'label' => 'HIGH'],
                                            'medium' => ['bg' => 'bg-orange-50 text-orange-500', 'dot' => 'bg-orange-500', 'label' => 'MEDIUM'],
                                            default => ['bg' => 'bg-emerald-50 text-emerald-500', 'dot' => 'bg-emerald-500', 'label' => 'LOW'],
                                        };
                                    @endphp
                                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full {{ $pConfig['bg'] }} text-[10px] font-bold tracking-widest border-none">
                                        <span class="size-1.5 rounded-full {{ $pConfig['dot'] }}"></span>
                                        {{ $pConfig['label'] }}
                                    </div>
                                </td>
                                <td class="py-5">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-base-content/30 italic">
                                        {{ $ticket->category }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    @if($ticket->assignedTo)
                                        <div class="flex items-center gap-3">
                                            <div class="size-8 rounded-xl overflow-hidden border border-base-content/10 shadow-sm">
                                                <img src="{{ $ticket->assignedTo->profile_photo_url }}" class="object-cover w-full h-full" />
                                            </div>
                                            <span class="text-xs font-bold text-base-content/70">{{ $ticket->assignedTo->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-xs font-medium text-base-content/30 italic">Unassigned</span>
                                    @endif
                                </td>
                                <td class="py-5">
                                    @if($ticket->status === 'open')
                                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/5 text-primary text-[10px] font-bold tracking-widest border-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3 animate-spin-slow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" /><path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                                            </svg>
                                            OPEN
                                        </div>
                                    @else
                                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-500 text-[10px] font-bold tracking-widest border-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>
                                            CLOSED
                                        </div>
                                    @endif
                                </td>
                                <td class="py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="size-8 rounded-xl overflow-hidden border border-base-content/10 shadow-sm">
                                            <img src="{{ $ticket->user->profile_photo_url }}" class="object-cover w-full h-full" />
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-base-content/80">{{ $ticket->user->name }}</span>
                                            <span class="text-[9px] text-base-content/40 font-medium tracking-tight uppercase">{{ $ticket->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end px-8 py-5">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('tickets.show', $ticket) }}" class="p-2 text-base-content/30 hover:text-primary hover:bg-primary/5 rounded-lg transition-all border border-base-content/5 hover:border-primary/20">
                                            <span class="icon-[tabler--eye] size-4"></span>
                                        </a>
                                        @if(auth()->id() === $ticket->user_id || auth()->user()->isAdmin())
                                            <a href="{{ route('tickets.edit', $ticket) }}" class="p-2 text-base-content/30 hover:text-warning hover:bg-warning/5 rounded-lg transition-all border border-base-content/5 hover:border-warning/20">
                                                 <span class="icon-[tabler--pencil] size-4"></span>
                                             </a>
                                        @endif
                                        @if(auth()->user()->hasPermission('delete_tickets'))
                                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-base-content/30 hover:text-error hover:bg-error/5 rounded-lg transition-all border border-base-content/5 hover:border-error/20" data-confirm="Are you sure you want to delete this ticket? This action is permanent." data-confirm-title="Delete Ticket" data-confirm-text="Yes, Delete">
                                                    <span class="icon-[tabler--trash] size-4"></span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-24">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="size-20 bg-base-200/50 rounded-full flex items-center justify-center text-base-content/20 shadow-inner">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 5v14" /><path d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" /></svg>
                                        </div>
                                        <p class="text-base-content/40 font-bold uppercase text-[11px] tracking-widest">No report found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($tickets->hasPages())
                <div class="px-8 py-6 border-t border-base-content/5 bg-base-200/10 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest">
                        Showing <span class="text-base-content/70">{{ $tickets->firstItem() }}</span> to <span class="text-base-content/70">{{ $tickets->lastItem() }}</span> of <span class="text-base-content/70">{{ $tickets->total() }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        {{ $tickets->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
