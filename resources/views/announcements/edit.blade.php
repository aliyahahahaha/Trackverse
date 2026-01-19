<x-app-layout>
    <div class="min-h-screen w-full bg-gray-50 py-12 px-4 sm:px-6">

        {{-- Header Navigation --}}
        <div class="max-w-6xl mx-auto mb-10 space-y-5">
            <div class="flex items-center gap-4">
                <a href="{{ route('announcements.index') }}"
                    class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                    <span class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">←
                        BACK
                        TO ANNOUNCEMENTS</span>
                </a>
                <div class="h-5 w-px bg-base-content/10"></div>
                <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400">
                    <div
                        class="w-4 h-4 rounded-full bg-orange-500 text-white flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </div>
                    Live Editing Mode
                </div>
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Edit Announcement</h1>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2 ml-1">Modifying existing
                    broadcast details</p>
            </div>
        </div>

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
                                        <h3 class="text-lg font-bold text-slate-900 tracking-tight">Announcement Details
                                        </h3>
                                        <p class="text-xs font-medium text-slate-400">Update broadcast details</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="size-2 rounded-full bg-orange-500 animate-pulse"></span>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Live
                                        Editing</span>
                                </div>
                            </div>

                            {{-- Card Body --}}
                            <div class="p-8 space-y-8">
                                {{-- Headline Title --}}
                                <div class="form-control w-full">
                                    <label class="label px-1 pt-0 pb-2">
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest text-slate-400">Headline
                                            Title</span>
                                    </label>
                                    <input type="text" name="title" id="title" oninput="updateAnnouncementPreview()"
                                        value="{{ old('title', $announcement->title) }}"
                                        placeholder="Enter a catchy title..."
                                        class="input input-lg w-full h-16 bg-slate-50 border-none rounded-2xl focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition-all font-bold text-lg placeholder:text-slate-300 placeholder:font-bold border border-transparent focus:border-orange-500/20"
                                        required />
                                </div>

                                {{-- Details & Content --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                                    {{-- Content Textarea --}}
                                    <div class="form-control w-full">
                                        <label class="label px-1 pt-0 pb-2">
                                            <span
                                                class="text-[10px] font-black uppercase tracking-widest text-slate-400">Detailed
                                                Content</span>
                                        </label>
                                        <textarea name="content" id="content" rows="8"
                                            oninput="updateAnnouncementPreview()"
                                            placeholder="Write your announcement details here..."
                                            class="textarea w-full h-[208px] bg-slate-50 border-none rounded-2xl focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition-all font-medium text-slate-600 placeholder:text-slate-300 placeholder:font-bold resize-none leading-relaxed p-5 border border-transparent focus:border-orange-500/20"
                                            required>{{ old('content', $announcement->content) }}</textarea>
                                    </div>

                                    {{-- Category Selection & More --}}
                                    <div class="space-y-6">
                                        <div class="form-control w-full">
                                            <label class="label px-1 pt-0 pb-2">
                                                <span
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400">Category</span>
                                            </label>
                                            <div class="relative group">
                                                <select name="type" id="type" onchange="updateAnnouncementPreview()"
                                                    class="select select-lg w-full h-14 bg-slate-50 border-none rounded-2xl focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition-all font-bold text-sm appearance-none cursor-pointer border border-transparent focus:border-orange-500/20"
                                                    required>
                                                    <option value="info" {{ $announcement->type == 'info' ? 'selected' : '' }}>🔵 Informational</option>
                                                    <option value="success" {{ $announcement->type == 'success' ? 'selected' : '' }}>🟢 Success</option>
                                                    <option value="warning" {{ $announcement->type == 'warning' ? 'selected' : '' }}>🟡 Warning</option>
                                                    <option value="error" {{ $announcement->type == 'error' ? 'selected' : '' }}>🔴 Critical Alert</option>
                                                </select>
                                                <div
                                                    class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-hover:text-orange-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M6 9l6 6l6 -6" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Banner Image Dropzone --}}
                                        <div class="form-control w-full">
                                            <label class="label px-1 pt-0 pb-2">
                                                <span
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400">Banner
                                                    Image</span>
                                            </label>
                                            <div id="dropzone-container"
                                                class="relative w-full h-[128px] rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 hover:bg-orange-50/50 hover:border-orange-500 transition-all cursor-pointer group overflow-hidden">
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
                                                            class="text-[10px] font-black uppercase tracking-widest text-slate-400">
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
                                                            class="text-[10px] font-black uppercase tracking-widest text-slate-400">
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
                                class="btn bg-white hover:bg-slate-50 text-slate-500 border-none font-bold rounded-2xl px-8 h-12">
                                Cancel
                            </a>
                            <button type="submit"
                                class="btn btn-warning h-12 px-10 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl shadow-warning/25 hover:scale-[1.02] active:scale-[0.98] transition-all border-none text-white">
                                Save Changes
                            </button>
                        </div>
                    </div>

                    {{-- Right Column: Live Preview --}}
                    <div class="lg:col-span-4 sticky top-8">
                        <div
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500/40 mb-4 px-1 flex items-center gap-2">
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
                                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border shadow-sm transition-all duration-300">
                                        <div class="size-2 rounded-full animate-pulse shadow-sm"></div>
                                        Loading...
                                    </div>
                                    <span
                                        class="text-[10px] font-black text-slate-300 uppercase tracking-widest">{{ $announcement->created_at->format('M d, Y') }}</span>
                                </div>

                                {{-- Inner Content Preview --}}
                                <div class="space-y-4">
                                    <h4 id="preview-title"
                                        class="text-3xl font-black text-slate-900 leading-tight break-words transition-all">
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
                                                class="text-[10px] font-black uppercase text-slate-800 tracking-tight">{{ $announcement->user->name }}</span>
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

                pBadge.className = 'inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border shadow-sm transition-all duration-300 ';
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