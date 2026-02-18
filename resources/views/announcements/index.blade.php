<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('announcements.index') }}"
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        LATEST NEWS
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <a href="{{ route('announcements.index', ['filter' => 'archive']) }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        ARCHIVE
                    </a>
                </div>
            </div>

            <!-- Main Header Content -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div
                        class="size-16 rounded-[1.5rem] bg-primary shadow-2xl shadow-primary/20 flex items-center justify-center text-primary-content shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4v-4" />
                            <path d="M11 20l4 0" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Announcements</h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Stay updated with the latest news
                            and system updates.</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="px-5 py-3 bg-white rounded-2xl border border-base-content/5 shadow-sm">
                        <span
                            class="text-[9px] font-bold uppercase tracking-widest text-base-content/30 block leading-none mb-1.5">Total
                            Updates</span>
                        <span class="text-sm font-bold text-base-content leading-none">{{ $announcements->count() }}
                            Updates</span>
                    </div>
                    @if(auth()->user()->isAdmin() || auth()->user()->isDirector())
                        <a href="{{ route('announcements.create') }}"
                            class="btn btn-primary h-12 px-8 gap-3 font-bold uppercase text-[10px] tracking-widest shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all rounded-2xl border-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                            NEW ANNOUNCEMENT
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="alert alert-success shadow-lg border-none bg-success/20 text-success-content font-medium">
                <span class="icon-[tabler--circle-check] size-6"></span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($announcements as $announcement)
                <div
                    class="card bg-base-100 shadow-sm border border-base-content/5 hover:shadow-md transition-all duration-300 group overflow-hidden">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="flex flex-col lg:flex-row gap-4">
                                <!-- Left Content Section -->
                                <div class="flex-1 min-w-0 flex flex-col">
                                    <!-- Header: Badge & Date -->
                                    <div class="flex flex-wrap items-center gap-3 mb-3">
                                        @if($announcement->type === 'success')
                                            <span
                                                class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-success/30 bg-success/5 text-success shadow-sm">
                                                <div class="size-1.5 rounded-full bg-success"></div>
                                                Success
                                            </span>
                                        @elseif($announcement->type === 'warning')
                                            <span
                                                class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-warning/30 bg-warning/5 text-warning shadow-sm">
                                                <div class="size-1.5 rounded-full bg-warning"></div>
                                                Warning
                                            </span>
                                        @elseif($announcement->type === 'error')
                                            <span
                                                class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-error/30 bg-error/5 text-error shadow-sm">
                                                <div class="size-1.5 rounded-full bg-error"></div>
                                                Critical
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border border-info/30 bg-info/5 text-info shadow-sm">
                                                <div class="size-1.5 rounded-full bg-info"></div>
                                                Information
                                            </span>
                                        @endif
                                        <span
                                            class="text-[9px] font-black text-base-content/30 uppercase tracking-widest leading-none">
                                            {{ $announcement->created_at->format('M d, Y') }}
                                        </span>
                                    </div>

                                    <!-- Title & Body -->
                                    <div class="mb-4">
                                        <h3
                                            class="text-lg font-bold text-base-content leading-tight mb-1.5 group-hover:text-primary transition-colors line-clamp-2">
                                            {{ $announcement->title }}
                                        </h3>
                                        <div
                                            class="prose prose-sm max-w-none text-base-content/60 font-medium line-clamp-2 leading-relaxed mb-4 italic">
                                            <p class="whitespace-pre-wrap text-[13px]">{{ $announcement->content }}</p>
                                        </div>
                                        <button type="button" data-overlay="#announcement-modal-{{ $announcement->id }}"
                                            class="text-[9px] font-black text-primary uppercase tracking-[0.2em] hover:text-primary-focus transition-all flex items-center gap-2 group/btn">
                                            Read More
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="group-hover/btn:translate-x-1 transition-transform">
                                                <path d="M5 12l14 0" />
                                                <path d="M13 18l6 -6" />
                                                <path d="M13 6l6 6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Image Thumbnail -->
                                @if($announcement->image_path)
                                    <div class="shrink-0">
                                        <div
                                            class="relative w-full lg:w-32 h-32 rounded-xl overflow-hidden border border-base-content/5 shadow-sm group-hover:shadow-md transition-all">
                                            <img src="{{ Storage::url($announcement->image_path) }}"
                                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                                alt="Announcement Image">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div
                            class="px-5 py-3 border-t border-base-content/5 flex items-center justify-between bg-base-100/50">
                            <div class="flex items-center gap-2.5">
                                <div class="avatar">
                                    <div
                                        class="size-6 rounded-full overflow-hidden border border-base-content/10 shadow-sm">
                                        <img src="{{ $announcement->user->profile_photo_url }}"
                                            alt="{{ $announcement->user->name }}" />
                                    </div>
                                </div>
                                <span class="text-[9px] font-bold text-base-content/40 uppercase tracking-widest">
                                    Posted by {{ $announcement->user->name }}
                                </span>
                            </div>

                            @if(auth()->user()->isAdmin() || auth()->user()->isDirector())
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('announcements.edit', $announcement) }}"
                                        class="btn btn-square btn-sm size-8 bg-base-100 text-base-content/40 shadow-sm border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 transition-all rounded-xl"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                            <path d="M13.5 6.5l4 4" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('announcements.destroy', $announcement) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-square btn-sm size-8 bg-base-100 text-base-content/40 shadow-sm border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 transition-all rounded-xl"
                                            data-confirm="Are you sure you want to delete this announcement?"
                                            data-confirm-title="Delete Announcement" data-confirm-text="Yes, Delete"
                                            title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full card bg-base-100/50 border-2 border-dashed border-base-content/10 shadow-none">
                    <div class="card-body items-center text-center py-20">
                        <div class="size-20 bg-base-200 rounded-full flex items-center justify-center mb-6">
                            <span class="icon-[tabler--news-off] size-10 text-base-content/20"></span>
                        </div>
                        <h3 class="text-2xl font-bold text-base-content tracking-tight">No announcements yet</h3>
                        <p class="text-sm text-base-content/50 max-w-xs mb-8">Stay tuned for important updates and
                            notifications from the administration.</p>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('announcements.create') }}"
                                class="btn btn-primary gap-2 shadow-lg shadow-primary/20 font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                                    class="shrink-0">
                                    <path d="M12 5v14M5 12h14" />
                                </svg>
                                Create First Announcement
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
        @include('announcements.partials.show-modal')
        @include('projects.partials.modal-fix')
    </div>
</x-app-layout>