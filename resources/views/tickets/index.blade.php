<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-base-100 rounded-xl border border-base-content/5 shadow-sm text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 5l0 2" />
                        <path d="M15 11l0 2" />
                        <path d="M15 17l0 2" />
                        <path
                            d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-2xl text-base-content tracking-tight">Tickets</h2>
                    <p class="text-sm text-base-content/60 font-medium mt-1">Manage and track issue reports.</p>
                </div>
            </div>
            <a href="{{ route('tickets.create') }}"
                class="btn btn-primary gap-2 font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Create Ticket
            </a>
        </div>
    </x-slot>

    <div
        class="card bg-base-100 shadow-xl shadow-base-content/5 border border-base-content/5 rounded-3xl overflow-hidden mt-4">
        <div class="card-body p-0">
            @if(session('success'))
                <div class="p-4">
                    <div
                        class="alert alert-success shadow-sm border-none bg-success/10 text-success font-bold text-sm rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            <path d="M9 12l2 2l4 -4" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="table align-middle">
                    <thead
                        class="bg-base-100 border-b border-base-content/5 text-base-content/40 uppercase text-[10px] font-black tracking-[0.2em]">
                        <tr>
                            <th class="px-8 py-5">Ticket</th>
                            <th class="py-5">Project</th>
                            <th class="py-5">Priority</th>
                            <th class="py-5">Category</th>
                            <th class="py-5">Assignee</th>
                            <th class="py-5">Status</th>
                            <th class="py-5">Reporter</th>
                            <th class="text-end px-8 py-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($tickets as $ticket)
                            <tr
                                class="group hover:bg-base-200/30 transition-all border-b border-base-content/5 last:border-0">
                                <td class="px-8 py-4">
                                    <div
                                        class="font-black text-base-content/90 text-sm group-hover:text-primary transition-colors">
                                        {{ $ticket->title }}
                                    </div>
                                    <div
                                        class="text-[11px] text-base-content/50 mt-1 line-clamp-1 max-w-[250px] font-medium">
                                        {{ $ticket->description }}
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="p-1.5 bg-primary/10 rounded-lg text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path
                                                    d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                                <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                            </svg>
                                        </div>
                                        <span
                                            class="font-bold text-xs text-base-content/70">{{ $ticket->project->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    @if($ticket->priority == 'high')
                                        <div
                                            class="badge bg-error/10 text-error border-none rounded-lg font-black text-[10px] uppercase tracking-widest py-3 px-3 gap-2">
                                            <span class="size-1.5 rounded-full bg-error animate-pulse"></span>
                                            High
                                        </div>
                                    @elseif($ticket->priority == 'medium')
                                        <div
                                            class="badge bg-warning/10 text-warning border-none rounded-lg font-black text-[10px] uppercase tracking-widest py-3 px-3 gap-2">
                                            <span class="size-1.5 rounded-full bg-warning"></span>
                                            Medium
                                        </div>
                                    @else
                                        <div
                                            class="badge bg-success/10 text-success border-none rounded-lg font-black text-[10px] uppercase tracking-widest py-3 px-3 gap-2">
                                            <span class="size-1.5 rounded-full bg-success"></span>
                                            Low
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4">
                                    <div
                                        class="badge bg-base-200/50 text-base-content/60 border-none rounded-lg font-bold text-[10px] uppercase tracking-wider py-3 px-3">
                                        {{ $ticket->category }}
                                    </div>
                                </td>
                                <td class="py-4">
                                    @if($ticket->assignedTo)
                                        <div class="flex items-center gap-3">
                                            <div class="avatar relative">
                                                <div
                                                    class="w-8 h-8 rounded-xl overflow-hidden shadow-sm border border-base-content/10">
                                                    <img src="{{ $ticket->assignedTo->profile_photo_url }}"
                                                        alt="{{ $ticket->assignedTo->name }}"
                                                        class="object-cover w-full h-full" />
                                                </div>
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-xs font-bold text-base-content/80">{{ $ticket->assignedTo->name }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 text-base-content/40 italic">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M22 22l-5 -5" />
                                                <path d="M17 22l5 -5" />
                                                <path d="M22 13v-11h-10v5h5v6" />
                                                <path d="M6 9v12a2 2 0 1 0 4 0v-12" />
                                            </svg>
                                            <span class="text-xs font-medium">Unassigned</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4">
                                    @if($ticket->status === 'open')
                                        <div
                                            class="badge bg-primary/10 text-primary border-none rounded-lg font-black text-[10px] uppercase tracking-widest py-3 px-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3 animate-spin-slow"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                                                <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                                            </svg>
                                            Open
                                        </div>
                                    @else
                                        <div
                                            class="badge bg-success/10 text-success border-none rounded-lg font-black text-[10px] uppercase tracking-widest py-3 px-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path d="M9 12l2 2l4 -4" />
                                            </svg>
                                            {{ ucfirst($ticket->status) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div
                                                class="w-8 h-8 rounded-xl overflow-hidden shadow-sm border border-base-content/10">
                                                <img src="{{ $ticket->user->profile_photo_url }}"
                                                    alt="{{ $ticket->user->name }}" class="object-cover w-full h-full" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-xs font-bold text-base-content/70">{{ $ticket->user->name }}</span>
                                            <span
                                                class="text-[10px] text-base-content/40 font-medium">{{ $ticket->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end px-8 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('tickets.show', $ticket) }}"
                                            class="btn btn-square btn-sm btn-ghost text-base-content/70 hover:bg-primary/10 hover:text-primary rounded-lg transition-all"
                                            title="View Details">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('tickets.edit', $ticket) }}"
                                            class="btn btn-square btn-sm btn-ghost text-base-content/70 hover:bg-warning/10 hover:text-warning rounded-lg transition-all"
                                            title="Edit Ticket">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-square btn-sm btn-ghost text-base-content/70 hover:bg-error/10 hover:text-error rounded-lg transition-all"
                                                title="Delete Ticket">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-20 bg-base-200/10">
                                    <div class="flex flex-col items-center gap-6">
                                        <div
                                            class="size-20 bg-base-200 rounded-3xl flex items-center justify-center shadow-inner group">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="size-10 text-base-content/20 group-hover:scale-110 transition-transform"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M15 5v14" />
                                                <path
                                                    d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                                            </svg>
                                        </div>
                                        <div class="space-y-1">
                                            <h3 class="text-xl font-black text-base-content tracking-tight">No tickets found
                                            </h3>
                                            <p class="text-sm text-base-content/50 max-w-sm mx-auto font-medium">Looking
                                                good! There are currently no tickets reported.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($tickets->hasPages())
                <div class="px-8 py-4 border-t border-base-content/5 bg-base-200/20">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>