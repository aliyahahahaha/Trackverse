<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Breadcrumbs / Premium Pill) -->
            <div class="flex">
                <div class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('tickets.index') }}" 
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        TICKET HUB
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <a href="{{ route('projects.show', $ticket->project) }}" 
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        {{ strtoupper($ticket->project->name) }}
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        TICKET REGISTRY
                    </div>
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
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">{{ $ticket->title }}</h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Reference ID: #TICK-{{ $ticket->id }} • Opened by {{ $ticket->user->name }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @if (($ticket->user_id === auth()->id() || auth()->user()->isAdmin()) && !auth()->user()->isDirector())
                        <a href="{{ route('tickets.edit', $ticket) }}"
                            class="btn btn-square bg-base-100 text-base-content/70 border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 size-12 rounded-xl shadow-sm transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                <path d="M13.5 6.5l4 4" />
                            </svg>
                        </a>
                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-square bg-base-100 text-base-content/70 border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 size-12 rounded-xl shadow-sm transition-all"
                                data-confirm="Are you sure you want to delete this ticket? This action is permanent."
                                data-confirm-title="Delete Ticket" data-confirm-text="Yes, Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('tickets.index') }}"
                        class="btn btn-primary h-12 px-6 gap-2 font-bold uppercase text-[10px] tracking-widest shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all rounded-xl border-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" />
                        </svg>
                        Back to Hub
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content - Left Side (2 columns) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description Card -->
                <div
                    class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-3xl overflow-hidden">
                    <div class="card-body p-8">
                        <h3
                            class="font-bold text-sm uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                <path d="M12 12l0 .01" />
                                <path d="M3 13a20 20 0 0 0 18 0" />
                            </svg>
                            Description
                        </h3>
                        <p class="text-base leading-relaxed text-base-content/80 text-left">
                            {!! nl2br(e(trim($ticket->description))) ?: 'No description provided.' !!}
                        </p>

                        <!-- Attachments inside Description Card if available -->
                        @if ($ticket->hasMedia('attachments') || $ticket->attachment_path)
                            @php
                                $attachmentUrl = $ticket->hasMedia('attachments')
                                    ? $ticket->getFirstMediaUrl('attachments')
                                    : Storage::url($ticket->attachment_path);
                                $attachmentName = $ticket->hasMedia('attachments')
                                    ? $ticket->getFirstMedia('attachments')->file_name
                                    : basename($ticket->attachment_path);
                            @endphp
                            <div class="pt-6 mt-6 border-t border-base-content/5">
                                <h4 class="text-xs uppercase tracking-widest font-bold text-base-content/40 mb-3">
                                    Attachment</h4>
                                <a href="{{ $attachmentUrl }}" target="_blank"
                                    class="flex items-center gap-3 p-4 rounded-2xl bg-base-200/50 hover:bg-base-200 border border-base-content/5 hover:border-base-content/10 transition-all group">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center bg-base-100 rounded-xl text-primary shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path
                                                d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="text-sm font-bold text-base-content truncate group-hover:text-primary transition-colors">
                                            {{ $attachmentName }}
                                        </p>
                                        <p class="text-[10px] text-base-content/40 font-bold uppercase">Click to view
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="size-4 text-base-content/20 group-hover:text-primary transition-colors"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                        <path d="M11 13l9 -9" />
                                        <path d="M15 4h5v5" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Discussion Card -->
                <div
                    class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-3xl overflow-hidden">
                    <div class="card-body p-8">
                        <h3
                            class="font-bold text-sm uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10" />
                                <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" />
                            </svg>
                            Discussion
                        </h3>

                        <div class="space-y-6">
                            @forelse($ticket->responses as $response)
                                <div class="flex gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl overflow-hidden shrink-0 border border-base-content/10">
                                        <img src="{{ $response->user->profile_photo_url }}"
                                            class="object-cover w-full h-full" />
                                    </div>
                                    <div class="flex-1 space-y-1.5">
                                        <div class="flex items-center justify-between">
                                            <p class="font-bold text-sm text-base-content">{{ $response->user->name }}
                                            </p>
                                            <span
                                                class="text-[10px] text-base-content/40 font-bold uppercase tracking-wide">{{ $response->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div
                                            class="p-4 rounded-2xl bg-base-200/50 text-sm text-base-content/80 leading-relaxed">
                                            {!! nl2br(e(trim($response->content))) !!}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 opacity-40">
                                    <p class="text-xs font-bold uppercase tracking-widest">No discussion yet</p>
                                </div>
                            @endforelse
                        </div>

                        @if ($ticket->status !== 'closed')
                            @if (!auth()->user()->isDirector())
                                <div class="mt-8 pt-6 border-t border-base-content/5 space-y-4">
                                    <label class="text-[10px] uppercase tracking-widest font-bold text-base-content/40">Add
                                        Response</label>
                                    <form action="{{ route('tickets.responses.store', $ticket) }}" method="POST"
                                        class="space-y-4">
                                        @csrf
                                        <textarea name="content" rows="3" required
                                            class="textarea w-full bg-base-200/30 border-base-content/10 focus:bg-base-100 focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all font-medium text-sm rounded-2xl placeholder:text-base-content/30"
                                            placeholder="Type your response..."></textarea>
                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="btn btn-primary h-10 px-6 gap-2 font-bold rounded-xl shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 transition-all text-xs uppercase tracking-wide">
                                                Send Reply
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div
                                    class="mt-8 p-4 bg-primary/[0.03] rounded-xl border border-primary/10 flex items-center justify-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary/40"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M12 8l0 4" />
                                        <path d="M12 16l.01 0" />
                                    </svg>
                                    <span class="text-xs font-bold text-primary/40 uppercase tracking-widest">View Only Mode</span>
                                </div>
                            @endif
                        @else
                            <div
                                class="mt-8 p-4 bg-base-200/50 rounded-xl border border-base-content/10 flex items-center justify-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-base-content/30"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                    <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                </svg>
                                <span class="text-xs font-bold text-base-content/40 uppercase tracking-widest">Ticket
                                    Closed</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar - Right Side (1 column) -->
            <div class="space-y-6">
                <!-- Status & Details Card -->
                <div
                    class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-3xl overflow-hidden">
                    <div class="card-body p-6">
                        <h3
                            class="font-bold text-xs uppercase tracking-widest text-base-content/40 pb-4 border-b border-base-content/5 mb-6">
                            Registry Details
                        </h3>

                        <div class="space-y-6">
                            <!-- Status -->
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-xs font-bold uppercase tracking-widest text-base-content/30">Status</span>
                                @if ($ticket->status === 'open')
                                    <span
                                        class="px-3 h-6 flex items-center justify-center rounded-full bg-success/10 text-success border-none text-[10px] font-black uppercase tracking-widest leading-none">Open</span>
                                @elseif($ticket->status === 'closed')
                                    <span
                                        class="px-3 h-6 flex items-center justify-center rounded-full bg-base-200 text-base-content/40 border-none text-[10px] font-black uppercase tracking-widest leading-none">Closed</span>
                                @else
                                    <span
                                        class="px-3 h-6 flex items-center justify-center rounded-full bg-primary/10 text-primary border-none text-[10px] font-black uppercase tracking-widest leading-none">{{ $ticket->status }}</span>
                                @endif
                            </div>

                            <!-- Priority -->
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-xs font-bold uppercase tracking-widest text-base-content/30">Priority</span>
                                @if ($ticket->priority == 'high')
                                    <span
                                        class="px-3 h-6 flex items-center justify-center rounded-full bg-error/10 text-error border-none text-[10px] font-black uppercase tracking-widest gap-1.5 leading-none">
                                        <span class="size-1 rounded-full bg-error animate-pulse"></span> High
                                    </span>
                                @elseif($ticket->priority == 'medium')
                                    <span
                                        class="px-3 h-6 flex items-center justify-center rounded-full bg-warning/5 text-warning border-none text-[10px] font-black uppercase tracking-widest gap-1.5 leading-none">
                                        <span class="size-1 rounded-full bg-warning"></span> Medium
                                    </span>
                                @else
                                    <span
                                        class="px-3 h-6 flex items-center justify-center rounded-full bg-success/10 text-success border-none text-[10px] font-black uppercase tracking-widest gap-1.5 leading-none">
                                        <span class="size-1 rounded-full bg-success"></span> Low
                                    </span>
                                @endif
                            </div>

                            <!-- Category -->
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-xs font-bold uppercase tracking-widest text-base-content/30">Category</span>
                                <span class="text-sm font-bold text-slate-700">{{ $ticket->category }}</span>
                            </div>

                            <div class="pt-2">
                                <span
                                    class="text-xs font-bold uppercase tracking-widest text-base-content/30 block mb-3">Assignee</span>
                                @if ($ticket->assignedTo)
                                    <div
                                        class="flex items-center gap-4 p-4 bg-[#F8F7FF] rounded-[20px] border border-primary/5">
                                        <div
                                            class="size-12 rounded-2xl overflow-hidden shrink-0 border border-base-content/10 shadow-sm">
                                            <img src="{{ $ticket->assignedTo->profile_photo_url }}"
                                                class="object-cover w-full h-full" />
                                        </div>
                                        <div class="overflow-hidden">
                                            <p class="font-bold text-sm text-slate-700 truncate">
                                                {{ $ticket->assignedTo->name }}</p>
                                            <p class="text-[11px] font-bold text-slate-400 truncate tracking-tight">
                                                {{ $ticket->assignedTo->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="p-4 bg-base-200/30 rounded-2xl border border-dashed border-base-content/10 text-center">
                                        <span
                                            class="text-xs font-bold text-base-content/30 uppercase tracking-widest">Unassigned</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Close Button (if open) -->
                            @php
                                $canClose = false;
                                $user = auth()->user();
                                
                                // Check if user can close this ticket
                                if (!$user->isDirector()) {
                                    // Reporter or assignee can close
                                    $canClose = $ticket->user_id === $user->id || $ticket->assigned_to === $user->id;
                                    
                                    // Team leaders can close if they're project member or creator
                                    if (!$canClose && $user->isTeamLeader()) {
                                        $isMember = $ticket->project->members->contains($user->id);
                                        $isCreator = $ticket->project->created_by === $user->id;
                                        $canClose = $isMember || $isCreator;
                                    }
                                    
                                    // Admins can always close
                                    if (!$canClose && $user->isAdmin()) {
                                        $canClose = true;
                                    }
                                }
                            @endphp
                            
                            @if ($ticket->status !== 'closed' && $canClose)
                                <div class="pt-4">
                                    <form action="{{ route('tickets.close', $ticket) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            data-confirm="Are you sure you want to close this ticket? It will become read-only."
                                            data-confirm-title="Close Ticket" data-confirm-text="Yes, Close It"
                                            class="w-full h-[52px] bg-[#373B4D] hover:bg-[#2D3142] text-white rounded-[18px] shadow-xl shadow-slate-900/10 flex items-center justify-center gap-3 transition-all active:scale-[0.98] group">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="size-5 text-white/70 group-hover:text-white transition-colors"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg>
                                            <span class="text-xs font-bold uppercase tracking-widest">Close Ticket</span>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Timeline Card -->
                <div
                    class="card bg-base-100 shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-3xl overflow-hidden">
                    <div class="card-body p-6">
                        <h3
                            class="font-bold text-xs uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 7l0 5l3 3" />
                            </svg>
                            Timeline
                        </h3>

                        <div class="space-y-4">
                            <!-- Created -->
                            <div class="flex items-start gap-3 p-3 rounded-xl bg-base-200/30">
                                <div
                                    class="size-8 rounded-lg bg-base-100 flex items-center justify-center text-base-content/40 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest mb-1">
                                        Created</p>
                                    <p class="font-bold text-xs">{{ $ticket->created_at->format('M d, Y') }}</p>
                                    <p class="text-[10px] text-base-content/40">
                                        {{ $ticket->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="flex items-start gap-3 p-3 rounded-xl bg-base-200/30">
                                <div
                                    class="size-8 rounded-lg bg-base-100 flex items-center justify-center text-base-content/40 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-[9px] font-bold text-base-content/30 uppercase tracking-widest mb-1">
                                        Last Updated</p>
                                    <p class="font-bold text-xs">{{ $ticket->updated_at->format('M d, Y') }}</p>
                                    <p class="text-[10px] text-base-content/40">
                                        {{ $ticket->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confidential Notice -->
                <div class="px-4 py-3 bg-base-100 border border-base-content/5 rounded-2xl flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-primary opacity-60 flex-shrink-0"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 9v4" />
                        <path d="M12 17h.01" />
                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                    </svg>
                    <p class="text-[10px] text-base-content/40 font-bold uppercase tracking-wide">
                        Confidential Ticket
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
