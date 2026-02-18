@foreach($announcements as $announcement)
    <div id="announcement-modal-{{ $announcement->id }}" class="overlay modal hidden announcement-modal-overlay"
        role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div
                class="modal-content overflow-hidden border border-base-content/5 shadow-2xl rounded-3xl bg-base-100 relative">
                <!-- Close Button (Top Right) -->
                <!-- Close Button (Top Right) -->
                <button type="button"
                    class="btn btn-sm btn-circle btn-ghost absolute top-4 right-4 z-50 hover:bg-base-200 transition-all font-bold modal-close-btn"
                    data-close-modal="#announcement-modal-{{ $announcement->id }}">
                    <span class="icon-[tabler--x] size-5"></span>
                </button>

                <!-- Optional Image at the Top -->
                @if($announcement->image_path)
                    <div class="w-full h-64 sm:h-80 overflow-hidden relative">
                        <img src="{{ Storage::url($announcement->image_path) }}"
                            class="absolute inset-0 w-full h-full object-cover" alt="{{ $announcement->title }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                @endif

                <div class="p-8 sm:p-10">
                    <!-- ... content ... -->
                    <div class="flex items-center gap-3 mb-6">
                        <!-- ... rest of header ... -->
                        @if($announcement->type === 'success')
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest border shadow-sm bg-green-50 text-green-700 border-green-100">
                                <div class="w-1.5 h-1.5 rounded-full animate-pulse bg-green-500"></div>
                                Success
                            </span>
                        @elseif($announcement->type === 'warning')
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest border shadow-sm bg-yellow-50 text-yellow-800 border-yellow-100">
                                <div class="w-1.5 h-1.5 rounded-full animate-pulse bg-yellow-500"></div>
                                Warning
                            </span>
                        @elseif($announcement->type === 'error')
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest border shadow-sm bg-red-50 text-red-700 border-red-100">
                                <div class="w-1.5 h-1.5 rounded-full animate-pulse bg-red-500"></div>
                                Critical
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest border shadow-sm bg-blue-50 text-blue-700 border-blue-100">
                                <div class="w-1.5 h-1.5 rounded-full animate-pulse bg-blue-500"></div>
                                Information
                            </span>
                        @endif

                        <span
                            class="inline-flex px-3 py-1.5 bg-slate-50 text-slate-500 rounded-lg text-[10px] font-bold uppercase tracking-widest border border-slate-100 shadow-sm">
                            {{ $announcement->created_at->format('M d, Y') }}
                        </span>

                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight ml-auto">
                            Posted {{ $announcement->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 tracking-tight leading-tight mb-6">
                        {{ $announcement->title }}
                    </h3>

                    <!-- Scrollable Content -->
                    <div class="max-h-[400px] overflow-y-auto pr-4 custom-scrollbar">
                        <div class="prose prose-slate max-w-none">
                            <p class="text-slate-600 text-base sm:text-lg leading-relaxed font-medium">
                                {!! nl2br(e(trim($announcement->content))) !!}
                            </p>
                        </div>
                    </div>

                    <!-- Footer: Author -->
                    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div
                                    class="size-10 rounded-full overflow-hidden border border-slate-200 ring-2 ring-slate-50 shadow-sm">
                                    <img src="{{ $announcement->user->profile_photo_url }}"
                                        alt="{{ $announcement->user->name }}" />
                                </div>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 uppercase tracking-widest">
                                    {{ $announcement->user->name }}
                                </p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">
                                    {{ $announcement->user->role_label }}</p>
                            </div>
                        </div>

                        <button type="button"
                            class="btn btn-ghost ml-auto font-bold uppercase tracking-widest text-[9px] rounded-xl px-6 h-10 border border-slate-100 modal-close-btn"
                            data-close-modal="#announcement-modal-{{ $announcement->id }}">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<style>
    /* Modal Overlay Styles */
    .announcement-modal-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    /* CRITICAL: Ensure hidden modals are completely removed from layout */
    .announcement-modal-overlay.hidden {
        display: none !important;
    }

    .announcement-modal-overlay.overlay-open,
    .announcement-modal-overlay.open {
        opacity: 1;
        pointer-events: auto;
    }

    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }
</style>