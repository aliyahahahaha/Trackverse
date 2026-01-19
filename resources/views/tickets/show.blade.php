<x-app-layout>
    <div class="min-h-screen bg-base-200/20 pb-20">
        <!-- Premium Header Area -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-10 mb-8">
            <div class="space-y-8">
                <!-- Back Button & Breadcrumb Row (FIXED) -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center">
                        <a href="{{ route('tickets.index') }}" class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                            <span class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">← BACK TO TICKETS</span>
                        </a>
                    </div>

                    <div class="h-4 w-px bg-base-content/20"></div>

                    <!-- Breadcrumb -->
                    <nav class="flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-base-content/40">
                        <ol class="flex items-center gap-2">
                            <li><a href="{{ route('tickets.index') }}" class="hover:text-primary transition-colors">Tickets</a></li>
                            <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;" class="opacity-30 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg></li>
                            <li class="text-base-content/60">{{ $ticket->title }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                    <!-- Title & Details Row -->
                    <div class="space-y-3">
                        <div class="space-y-2">
                            <h1 class="text-3xl font-extrabold text-base-content tracking-tight">{{ $ticket->title }}</h1>
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 text-sm text-base-content/50">
                                <span class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="size-4 opacity-70">
                                        <path
                                            d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                        <path d="M12 12l0 .01" />
                                        <path d="M3 13a20 20 0 0 0 18 0" />
                                    </svg>
                                    {{ $ticket->ticketable ? $ticket->ticketable->name : ($ticket->project ? $ticket->project->name : 'N/A') }}
                                </span>
                                <span class="opacity-30">•</span>
                                <span class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="size-4 opacity-70">
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                    {{ $ticket->created_at->format('M d, Y') }}
                                </span>
                                <span class="opacity-30">•</span>
                                <span class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full overflow-hidden border border-base-content/10">
                                        <img src="{{ $ticket->user->profile_photo_url }}"
                                            class="object-cover w-full h-full" />
                                    </div>
                                    <span>by {{ $ticket->user->name }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('tickets.edit', $ticket) }}"
                        class="btn btn-warning btn-sm h-10 px-5 gap-2 font-bold rounded-xl shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                            class="size-4">
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('tickets.destroy', $ticket) }}" method="POST"
                        onsubmit="return confirm('Delete this ticket?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-error btn-sm h-10 px-5 gap-2 font-bold rounded-xl shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" class="size-4">
                                <path d="M4 7l16 0" />
                                <path d="M10 11l0 6" />
                                <path d="M14 11l0 6" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Description Panel -->
                    <div class="card bg-base-100 border border-base-content/10 rounded-2xl shadow-sm">
                        <div class="card-body p-6 space-y-6">
                            <div class="space-y-4">
                                <label
                                    class="text-[11px] uppercase tracking-wider font-semibold text-base-content/60">Description</label>
                                <div
                                    class="text-sm text-base-content/80 leading-relaxed whitespace-pre-wrap font-medium">
                                    @if($ticket->description)
                                        {{ $ticket->description }}
                                    @else
                                        <span class="text-base-content/40 italic">No detailed description provided.</span>
                                    @endif
                                </div>
                            </div>

                            @if($ticket->hasMedia('attachments') || $ticket->attachment_path)
                                @php
                                    $attachmentUrl = $ticket->hasMedia('attachments') ? $ticket->getFirstMediaUrl('attachments') : Storage::url($ticket->attachment_path);
                                    $attachmentName = $ticket->hasMedia('attachments') ? $ticket->getFirstMedia('attachments')->file_name : basename($ticket->attachment_path);
                                @endphp
                                <div class="pt-6 border-t border-base-content/5 space-y-3">
                                    <label
                                        class="text-[11px] uppercase tracking-wider font-semibold text-base-content/60">Attachment</label>
                                    <a href="{{ $attachmentUrl }}" target="_blank"
                                        class="flex items-center gap-3 p-3 rounded-xl bg-base-200/30 hover:bg-base-200/60 border border-base-content/5 transition-all group">
                                        <div class="w-9 h-9 flex items-center justify-center text-primary/60">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                                <path
                                                    d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p
                                                class="text-sm font-bold text-base-content truncate group-hover:text-primary transition-colors">
                                                {{ $attachmentName }}</p>
                                            <p
                                                class="text-[10px] text-base-content/40 font-medium uppercase tracking-tight">
                                                Click to preview file</p>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="size-4 text-base-content/20 group-hover:text-primary transition-all">
                                            <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                            <path d="M11 13l9 -9" />
                                            <path d="M15 4h5v5" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Discussion History Panel -->
                    <div class="card bg-base-100 border border-base-content/10 rounded-2xl shadow-sm">
                        <div class="card-body p-6">
                            <h3
                                class="text-[11px] uppercase tracking-wider font-semibold text-base-content/60 mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="size-4 opacity-50">
                                    <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10" />
                                    <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" />
                                </svg>
                                Discussion
                            </h3>

                            <div class="space-y-6">
                                @forelse($ticket->responses as $response)
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl overflow-hidden shrink-0 border border-base-content/5 shadow-sm">
                                            <img src="{{ $response->user->profile_photo_url }}"
                                                class="object-cover w-full h-full" />
                                        </div>
                                        <div class="flex-1 space-y-2 min-w-0">
                                            <div class="flex items-center justify-between gap-2">
                                                <p class="font-bold text-sm text-base-content/90">
                                                    {{ $response->user->name }}</p>
                                                <span
                                                    class="text-[10px] text-base-content/40 font-semibold uppercase tracking-wider">
                                                    {{ $response->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <div class="p-4 rounded-2xl bg-base-200/30 border border-base-content/5 w-fit max-w-[90%]">
                                                <p class="text-sm text-base-content/70 leading-relaxed font-medium whitespace-pre-wrap text-left">{{ $response->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-10 opacity-40">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="size-8 mx-auto mb-2">
                                            <path d="M8 9h8" />
                                            <path d="M8 13h6" />
                                            <path
                                                d="M13 20l-3 -3h-3a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6" />
                                            <path d="M16 22l5 -5" />
                                            <path d="M21 22l-5 -5" />
                                        </svg>
                                        <p class="text-xs font-bold uppercase tracking-widest">No activity found</p>
                                    </div>
                                @endforelse
                            </div>

                            @if($ticket->status !== 'closed')
                                <div class="mt-8 pt-6 border-t border-base-content/5 space-y-4">
                                    <label
                                        class="text-[11px] uppercase tracking-wider font-semibold text-base-content/60 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="size-4">
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Add Response
                                    </label>
                                    <form action="{{ route('tickets.responses.store', $ticket) }}" method="POST"
                                        class="space-y-4">
                                        @csrf
                                        <textarea name="content" rows="3" required
                                            class="textarea w-full bg-base-200/20 border-base-content/10 focus:bg-base-100 focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all font-medium text-sm rounded-xl placeholder:text-base-content/20"
                                            placeholder="Type your response..."></textarea>
                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="btn btn-primary btn-sm h-10 px-6 gap-2 font-bold rounded-xl shadow-lg shadow-primary/10">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="size-4">
                                                    <path d="M10 14l11 -11" />
                                                    <path d="M21 3l-6.5 18l-3.5 -7l-7 -3.5l18 -6.5" />
                                                </svg>
                                                Reply
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div
                                    class="mt-8 p-4 bg-base-200/40 rounded-xl border border-base-content/10 flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="size-5 text-base-content/30">
                                        <path
                                            d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                        <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                    </svg>
                                    <span class="text-xs font-bold text-base-content/30 uppercase tracking-widest">Ticket
                                        Closed</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="space-y-6">

                    <!-- Registry Details Panel -->
                    <div class="card bg-base-100 border border-base-content/10 rounded-2xl shadow-sm">
                        <div class="card-body p-6 space-y-6">
                            <h3
                                class="text-[11px] uppercase tracking-wider font-semibold text-base-content/60 pb-3 border-b border-base-content/5">
                                Registry Details</h3>

                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-[11px] uppercase tracking-wider font-semibold text-base-content/40">Status</span>
                                    @if($ticket->status === 'open')
                                        <span
                                            class="h-5 px-2.5 rounded-full bg-success/10 text-success border border-success/20 text-[10px] font-bold uppercase tracking-wider flex items-center">Open</span>
                                    @elseif($ticket->status === 'closed')
                                        <span
                                            class="h-5 px-2.5 rounded-full bg-base-200 text-base-content/40 border border-base-content/5 text-[10px] font-bold uppercase tracking-wider flex items-center">Closed</span>
                                    @else
                                        <span
                                            class="h-5 px-2.5 rounded-full bg-primary/10 text-primary border border-primary/20 text-[10px] font-bold uppercase tracking-wider flex items-center">Active</span>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-[11px] uppercase tracking-wider font-semibold text-base-content/40">Priority</span>
                                    @if($ticket->priority == 'high')
                                        <span
                                            class="h-5 px-2.5 rounded-full bg-error/5 text-error border border-error/10 text-[10px] font-bold uppercase tracking-wider flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-error animate-pulse"></span>
                                            High
                                        </span>
                                    @elseif($ticket->priority == 'medium')
                                        <span
                                            class="h-5 px-2.5 rounded-full bg-warning/5 text-warning border border-warning/10 text-[10px] font-bold uppercase tracking-wider flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-warning"></span>
                                            Medium
                                        </span>
                                    @else
                                        <span
                                            class="h-5 px-2.5 rounded-full bg-success/5 text-success border border-success/10 text-[10px] font-bold uppercase tracking-wider flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-success"></span>
                                            Low
                                        </span>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-[11px] uppercase tracking-wider font-semibold text-base-content/40">Category</span>
                                    <span class="text-sm font-bold text-base-content/70">{{ $ticket->category }}</span>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-base-content/5 space-y-4">
                                <span
                                    class="text-[11px] uppercase tracking-wider font-semibold text-base-content/40">Assignee</span>
                                @if($ticket->assignedTo)
                                    <div
                                        class="flex items-center gap-3 p-3 bg-primary/5 rounded-xl border border-primary/10">
                                        <div class="w-9 h-9 rounded-lg overflow-hidden shrink-0 border border-primary/20">
                                            <img src="{{ $ticket->assignedTo->profile_photo_url }}"
                                                class="object-cover w-full h-full" />
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-bold text-[13px] text-base-content/90 truncate">
                                                {{ $ticket->assignedTo->name }}</p>
                                            <p class="text-[10px] font-medium text-base-content/40 truncate">
                                                {{ $ticket->assignedTo->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="flex flex-col items-center justify-center p-6 bg-base-200/20 rounded-xl border border-dashed border-base-content/10">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="size-6 opacity-10 mb-2">
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                            <path d="M22 22l-5 -5" />
                                            <path d="M17 22l5 -5" />
                                        </svg>
                                        <span
                                            class="text-[10px] font-bold text-base-content/30 uppercase tracking-widest">Unassigned</span>
                                    </div>
                                @endif
                            </div>

                            @if($ticket->status !== 'closed')
                                <div class="pt-4">
                                    <form action="{{ route('tickets.close', $ticket) }}" method="POST"
                                        onsubmit="return confirm('Close this ticket?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-ghost btn-sm btn-block h-10 gap-2 border border-base-content/10 hover:bg-error/10 hover:text-error hover:border-error/20 transition-all font-bold uppercase text-[10px] tracking-widest rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="size-4">
                                                <path
                                                    d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                                <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                            </svg>
                                            Close Ticket
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Meta Notice -->
                    <div class="p-4 bg-primary/5 rounded-xl border border-primary/10">
                        <p class="text-[11px] text-base-content/40 leading-relaxed font-medium italic">Confidential.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>