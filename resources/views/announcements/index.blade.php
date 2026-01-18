<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-base-content leading-tight flex items-center gap-2">
                <span class="icon-[tabler--news] size-6 text-primary"></span>
                {{ __('Announcements') }}
            </h2>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('announcements.create') }}"
                    class="btn btn-primary btn-sm gap-2 font-bold shadow-lg shadow-primary/20">
                    <span class="icon-[tabler--plus] size-5"></span>
                    New Announcement
                </a>
            @endif
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
                    <div class="card-body p-6 flex flex-col lg:flex-row gap-6">

                        <!-- Left Content Section -->
                        <div class="flex-1 min-w-0 flex flex-col">
                            <!-- Header: Badge & Date -->
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                @if($announcement->type === 'success')
                                    <span
                                        class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-widest border shadow-sm"
                                        style="background-color: #f0fdf4; color: #15803d; border-color: #dcfce7;">
                                        <div class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #22c55e;">
                                        </div>
                                        Success
                                    </span>
                                @elseif($announcement->type === 'warning')
                                    <span
                                        class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-widest border shadow-sm"
                                        style="background-color: #fefce8; color: #a16207; border-color: #fef9c3;">
                                        <div class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #eab308;">
                                        </div>
                                        Warning
                                    </span>
                                @elseif($announcement->type === 'error')
                                    <span
                                        class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-widest border shadow-sm"
                                        style="background-color: #fef2f2; color: #b91c1c; border-color: #fee2e2;">
                                        <div class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #ef4444;">
                                        </div>
                                        Critical
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-widest border shadow-sm"
                                        style="background-color: #eff6ff; color: #1d4ed8; border-color: #dbeafe;">
                                        <div class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #3b82f6;">
                                        </div>
                                        Information
                                    </span>
                                @endif
                                <span class="text-[10px] font-black text-base-content/40 uppercase tracking-widest">
                                    {{ $announcement->created_at->format('M d, Y') }}
                                </span>
                            </div>

                            <!-- Title & Body -->
                            <div class="mb-auto">
                                <h3
                                    class="text-xl font-bold text-base-content leading-tight mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                    {{ $announcement->title }}
                                </h3>
                                <div
                                    class="prose prose-sm max-w-none text-base-content/70 font-medium line-clamp-3 leading-relaxed">
                                    <p class="whitespace-pre-wrap">{{ $announcement->content }}</p>
                                </div>
                            </div>

                            <!-- Footer: Author & Actions -->
                            <div class="mt-6 flex items-center justify-between pt-4 border-t border-base-content/5">
                                <div class="flex items-center gap-2">
                                    <div class="avatar">
                                        <div class="size-6 rounded-full overflow-hidden border border-base-content/10">
                                            <img src="{{ $announcement->user->profile_photo_url }}"
                                                alt="{{ $announcement->user->name }}" />
                                        </div>
                                    </div>
                                    <span class="text-[10px] font-bold text-base-content/50 uppercase tracking-tighter">
                                        Posted by {{ $announcement->user->name }}
                                    </span>
                                </div>

                                @if(auth()->user()->isAdmin())
                                    <div class="flex items-center gap-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('announcements.edit', $announcement) }}"
                                            class="btn btn-square btn-sm size-8 bg-base-100 text-base-content shadow-sm border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 transition-all rounded-lg"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('announcements.destroy', $announcement) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Delete this announcement?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-square btn-sm size-8 bg-base-100 text-base-content shadow-sm border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 transition-all rounded-lg"
                                                title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
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
                                @endif
                            </div>
                        </div>

                        <!-- Right Image Thumbnail (Desktop) / Top (Mobile) -->
                        @if($announcement->image_path)
                            <div class="shrink-0 order-first lg:order-last">
                                <div
                                    class="relative w-full lg:w-48 h-48 lg:h-full min-h-[12rem] rounded-xl overflow-hidden border border-base-content/5 shadow-sm group-hover:shadow-md transition-all">
                                    <img src="{{ Storage::url($announcement->image_path) }}"
                                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        alt="Announcement Image">
                                </div>
                            </div>
                        @endif

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
                                class="btn btn-primary gap-2 shadow-lg shadow-primary/20">
                                <span class="icon-[tabler--plus] size-4"></span>
                                Create First Announcement
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>