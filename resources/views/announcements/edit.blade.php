<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('announcements.index') }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        ANNOUNCEMENTS
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        EDIT MODE
                    </div>
                </div>
            </div>

            <!-- Main Title Content -->
            <div class="flex flex-col gap-1.5">
                <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Edit Announcement</h1>
                <p class="text-[13px] text-base-content/50 font-bold">
                    Modifying existing broadcast details
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6">

        {{-- Main Content Section --}}
        <div class="max-w-6xl mx-auto px-1">
            <form action="{{ route('announcements.update', $announcement) }}" method="POST"
                enctype="multipart/form-data" id="announcement-form">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    {{-- Left Column: Form --}}
                    <div class="lg:col-span-8">
                        <div
                            class="card bg-white shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-[2rem] overflow-hidden">

                            {{-- Card Header --}}
                            <div
                                class="px-8 py-6 border-b border-base-content/5 bg-white flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="size-10 rounded-xl bg-orange-500 text-white flex items-center justify-center shadow-lg shadow-orange-500/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                            <path d="M13.5 6.5l4 4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-base-content">Announcement Details</h3>
                                        <p class="text-xs text-base-content/50">Update broadcast details</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="size-2 rounded-full bg-orange-500 animate-pulse"></span>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Live
                                        Editing</span>
                                </div>
                            </div>

                            {{-- Card Body --}}
                            <div class="p-8 space-y-8">
                                {{-- Headline Title --}}
                                <div class="form-control w-full">
                                    <label class="label px-1 pt-0 pb-2">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/50">Headline
                                            Title</span>
                                    </label>
                                    <input type="text" name="title" id="title" oninput="updateAnnouncementPreview()"
                                        value="{{ old('title', $announcement->title) }}"
                                        placeholder="Enter a catchy title..."
                                        class="input w-full h-12 bg-base-200/50 border border-base-content/10 rounded-xl focus:bg-base-100 focus:border-primary transition-all font-bold text-sm placeholder:text-base-content/30"
                                        required />
                                </div>

                                {{-- Details & Content --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                                    {{-- Content Textarea --}}
                                    <div class="form-control w-full">
                                        <label class="label px-1 pt-0 pb-2">
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-widest text-base-content/50">Detailed
                                                Content</span>
                                        </label>
                                        <textarea name="content" id="content" rows="8"
                                            oninput="updateAnnouncementPreview()"
                                            placeholder="Write your announcement details here..."
                                            class="textarea w-full h-52 bg-base-200/50 border border-base-content/10 rounded-xl focus:bg-base-100 focus:border-primary transition-all resize-none leading-relaxed p-4 text-sm"
                                            required>{{ old('content', $announcement->content) }}</textarea>
                                    </div>

                                    {{-- Category Selection & More --}}
                                    <div class="space-y-6">
                                        <div class="form-control w-full">
                                            <label class="label px-1 pt-0 pb-2">
                                                <span
                                                    class="text-[10px] font-bold uppercase tracking-widest text-base-content/50">Category</span>
                                            </label>
                                            <div class="relative group">
                                                <select name="type" id="type" onchange="updateAnnouncementPreview()"
                                                    class="select w-full h-12 bg-base-200/50 border border-base-content/10 rounded-xl focus:bg-base-100 focus:border-primary transition-all font-bold text-sm cursor-pointer"
                                                    required>
                                                    <option value="info" {{ $announcement->type == 'info' ? 'selected' : '' }}>🔵 Informational</option>
                                                    <option value="success" {{ $announcement->type == 'success' ? 'selected' : '' }}>🟢 Success</option>
                                                    <option value="warning" {{ $announcement->type == 'warning' ? 'selected' : '' }}>🟡 Warning</option>
                                                    <option value="error" {{ $announcement->type == 'error' ? 'selected' : '' }}>🔴 Critical Alert</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Banner Image Dropzone --}}
                                        <div class="form-control w-full">
                                            <label class="label px-1 pt-0 pb-2">
                                                <span
                                                    class="text-[10px] font-bold uppercase tracking-widest text-base-content/50">Banner
                                                    Image</span>
                                            </label>
                                            <div id="dropzone-container"
                                                class="relative w-full h-32 rounded-xl border-2 border-dashed border-base-content/20 bg-base-200/30 hover:bg-base-200/50 hover:border-primary/50 transition-all cursor-pointer overflow-hidden">
                                                <input type="file" id="image" name="image"
                                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30"
                                                    accept="image/*" onchange="previewAnnouncementImage(this)">
                                                <input type="hidden" name="remove_image" id="remove_image" value="0">

                                                @if($announcement->image_path)
                                                    <div id="image-preview-container"
                                                        class="absolute inset-0 z-20 bg-slate-100">
                                                        <img id="preview-img-tag"
                                                            src="{{ Storage::url($announcement->image_path) }}"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                    <div id="upload-placeholder"
                                                        class="opacity-0 absolute inset-0 flex flex-col items-center justify-center pointer-events-none z-10 p-4 text-center">
                                                        <div
                                                            class="size-8 rounded-full bg-white shadow-sm border border-slate-100 text-orange-500 flex items-center justify-center mb-1 group-hover:scale-110 transition-all">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2.5" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path
                                                                    d="M4 14.899a7 7 0 1 1 15.718 -2.908a7 7 0 1 1 -5.718 2.908" />
                                                                <path d="M12 12v9" />
                                                                <path d="M9 16l3 -3l3 3" />
                                                            </svg>
                                                        </div>
                                                        <p
                                                            class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                                            Change Banner</p>
                                                    </div>
                                                @else
                                                    <div id="upload-placeholder"
                                                        class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none z-10 p-4 text-center">
                                                        <div
                                                            class="size-8 rounded-full bg-white shadow-sm border border-slate-100 text-orange-500 flex items-center justify-center mb-1 group-hover:scale-110 transition-all">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2.5" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path
                                                                    d="M4 14.899a7 7 0 1 1 15.718 -2.908a7 7 0 1 1 -5.718 2.908" />
                                                                <path d="M12 12v9" />
                                                                <path d="M9 16l3 -3l3 3" />
                                                            </svg>
                                                        </div>
                                                        <p
                                                            class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                                            Banner</p>
                                                    </div>
                                                    <div id="image-preview-container"
                                                        class="hidden absolute inset-0 z-20 bg-slate-100">
                                                        <img id="preview-img-tag" src="" class="w-full h-full object-cover">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Form Actions --}}
                        <div class="flex items-center justify-end gap-4 mt-8">
                            <a href="{{ route('announcements.index') }}"
                                class="btn bg-[#1e293b] hover:bg-[#334155] h-12 px-6 rounded-2xl font-bold uppercase text-[10px] tracking-widest text-white border-none transition-all">
                                CANCEL
                            </a>
                            <button type="submit"
                                class="btn btn-warning h-12 px-8 rounded-2xl font-bold uppercase text-[10px] tracking-widest text-white shadow-xl shadow-warning/20 hover:scale-[1.02] active:scale-[0.98] transition-all border-none">
                                SAVE CHANGES
                            </button>
                        </div>
                    </div>

                    {{-- Right Column: Live Preview --}}
                    <div class="lg:col-span-4 sticky top-8">
                        <div
                            class="text-[10px] font-bold uppercase tracking-widest text-orange-500/40 mb-4 px-1 flex items-center gap-2">
                            <div class="size-1.5 rounded-full bg-orange-500 shadow-[0_0_8px_rgba(249,115,22,0.6)]">
                            </div>
                            Live View Preview
                        </div>

                        <div
                            class="card bg-white shadow-2xl shadow-orange-500/[0.05] border border-slate-100 rounded-[2.5rem] overflow-hidden min-h-[480px] flex flex-col justify-between relative group">

                            {{-- Decorative top glow --}}
                            <div
                                class="absolute top-0 left-0 right-0 h-40 bg-gradient-to-b from-orange-50/50 to-transparent pointer-events-none opacity-50">
                            </div>

                            {{-- Preview Badge --}}
                            <div class="p-8 pb-4 relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <div id="preview-type-badge"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest border shadow-sm transition-all duration-300">
                                        <div class="size-2 rounded-full animate-pulse shadow-sm"></div>
                                        Loading...
                                    </div>
                                    <span
                                        class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">{{ $announcement->created_at->format('M d, Y') }}</span>
                                </div>

                                {{-- Inner Content Preview --}}
                                <div class="space-y-4">
                                    <h4 id="preview-title"
                                        class="text-2xl font-bold text-slate-900 leading-tight break-words transition-all">
                                        {{ $announcement->title }}
                                    </h4>
                                    <div class="h-px w-12 bg-slate-100"></div>
                                    <p id="preview-content"
                                        class="text-sm text-slate-600 font-medium leading-relaxed break-words line-clamp-6 transition-all">
                                        {{ $announcement->content }}
                                    </p>
                                </div>
                            </div>

                            {{-- Preview Image/Author Section --}}
                            <div class="relative mt-4">
                                {{-- Preview Banner --}}
                                <div id="preview-banner-container"
                                    class="h-48 mx-6 rounded-[1.5rem] bg-slate-50 border border-slate-100 overflow-hidden relative mb-6">
                                    @if($announcement->image_path)
                                        <img id="preview-banner-img" src="{{ Storage::url($announcement->image_path) }}"
                                            class="w-full h-full object-cover">
                                        <div id="preview-banner-placeholder"
                                            class="hidden absolute inset-0 flex items-center justify-center text-slate-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-10" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                <polyline points="21 15 16 10 5 21" />
                                            </svg>
                                        </div>
                                    @else
                                        <div id="preview-banner-placeholder"
                                            class="absolute inset-0 flex items-center justify-center text-slate-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-10" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                <polyline points="21 15 16 10 5 21" />
                                            </svg>
                                        </div>
                                        <img id="preview-banner-img" src="" class="hidden w-full h-full object-cover">
                                    @endif
                                </div>

                                {{-- Author Preview --}}
                                <div class="px-8 pb-8 flex items-center justify-between border-t border-slate-50 pt-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="size-10 rounded-2xl bg-slate-50 border border-slate-100 p-0.5 overflow-hidden shadow-sm">
                                            <img src="{{ $announcement->user->profile_photo_url }}"
                                                class="size-full object-cover rounded-[0.8rem]" />
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[10px] font-bold uppercase text-slate-800 tracking-tight">{{ $announcement->user->name }}</span>
                                            <span
                                                class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter italic">Broadcaster</span>
                                        </div>
                                    </div>
                                    <div
                                        class="size-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M5 12l14 0" />
                                            <path d="M13 18l6 -6" />
                                            <path d="M13 6l6 6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>

        <script>
            function updateAnnouncementPreview() {
                const title = document.getElementById('title').value;
                const content = document.getElementById('content').value;
                const typeEl = document.getElementById('type');
                const type = typeEl.value;

                // Preview Title
                const pTitle = document.getElementById('preview-title');
                if (title) {
                    pTitle.textContent = title;
                    pTitle.classList.remove('text-slate-300', 'italic');
                    pTitle.classList.add('text-slate-900');
                } else {
                    pTitle.textContent = 'Highlight Title';
                    pTitle.classList.add('text-slate-300', 'italic');
                    pTitle.classList.remove('text-slate-900');
                }

                // Preview Content
                const pContent = document.getElementById('preview-content');
                if (content) {
                    pContent.textContent = content;
                    pContent.classList.remove('text-slate-300', 'italic');
                    pContent.classList.add('text-slate-600');
                } else {
                    pContent.textContent = 'Your announcement content will be displayed here in real-time as you type...';
                    pContent.classList.add('text-slate-300', 'italic');
                    pContent.classList.remove('text-slate-600');
                }

                // Preview Type Badge
                const pBadge = document.getElementById('preview-type-badge');
                const pBadgeDot = pBadge.querySelector('div');
                const typeText = typeEl.options[typeEl.selectedIndex].text.split(' ')[1]; // Get text after emoji

                pBadge.className = 'inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest border shadow-sm transition-all duration-300 ';
                pBadgeDot.className = 'size-2 rounded-full animate-pulse ';

                if (type === 'success') {
                    pBadge.classList.add('bg-green-50', 'text-green-600', 'border-green-100');
                    pBadgeDot.classList.add('bg-green-500');
                } else if (type === 'warning') {
                    pBadge.classList.add('bg-amber-50', 'text-amber-600', 'border-amber-100');
                    pBadgeDot.classList.add('bg-amber-500');
                } else if (type === 'error') {
                    pBadge.classList.add('bg-rose-50', 'text-rose-600', 'border-rose-100');
                    pBadgeDot.classList.add('bg-rose-500');
                } else {
                    pBadge.classList.add('bg-blue-50', 'text-blue-500', 'border-blue-100');
                    pBadgeDot.classList.add('bg-blue-500');
                }

                // Keep the dot and text
                pBadge.innerHTML = '';
                pBadge.appendChild(pBadgeDot);
                pBadge.appendChild(document.createTextNode(typeText));
            }

            function previewAnnouncementImage(input) {
                const file = input.files[0];
                const previewImg = document.getElementById('preview-img-tag');
                const previewContainer = document.getElementById('image-preview-container');
                const placeholder = document.getElementById('upload-placeholder');

                const livePreviewImg = document.getElementById('preview-banner-img');
                const livePreviewPlaceholder = document.getElementById('preview-banner-placeholder');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        // Dropzone preview
                        previewImg.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                        placeholder.classList.add('opacity-0');

                        // Card preview
                        livePreviewImg.src = e.target.result;
                        livePreviewImg.classList.remove('hidden');
                        livePreviewPlaceholder.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            }

            // Initial call
            document.addEventListener('DOMContentLoaded', updateAnnouncementPreview);
        </script>
    </div>
</x-app-layout>