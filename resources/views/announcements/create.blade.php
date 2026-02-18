<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('announcements.index') }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        ← BACK TO ANNOUNCEMENTS
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        NEW BROADCAST
                    </div>
                </div>
            </div>

            <!-- Main Title Content -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div
                        class="size-16 rounded-[1.5rem] bg-primary shadow-2xl shadow-primary/20 flex items-center justify-center text-primary-content shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Create
                            Announcement</h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Drafting a new broadcast for the
                            system.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-6 lg:px-10">
        <div class="max-w-6xl mx-auto px-1">
            <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data"
                id="announcement-form">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    {{-- Left Column: Form --}}
                    <div class="lg:col-span-8 space-y-8">
                        <div
                            class="card bg-white shadow-xl shadow-base-content/[0.02] border border-base-content/5 rounded-[2rem] overflow-hidden">
                            <div class="p-8 space-y-8">
                                {{-- Headline Title --}}
                                <div class="form-control w-full">
                                    <label class="label px-1 pt-0 pb-2">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-base-content/50">Headline
                                            Title</span>
                                    </label>
                                    <input type="text" name="title" id="title" oninput="updateAnnouncementPreview()"
                                        placeholder="Enter a catchy title..."
                                        class="input w-full h-12 bg-base-200/50 border border-base-content/10 rounded-xl focus:bg-base-100 focus:border-primary transition-all font-bold text-sm placeholder:text-base-content/30 placeholder:font-medium"
                                        required />
                                </div>

                                {{-- Details & Content --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                                    <div class="form-control w-full">
                                        <label class="label px-1 pt-0 pb-2">
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-widest text-base-content/50">Detailed
                                                Content</span>
                                        </label>
                                        <textarea name="content" id="content" rows="8"
                                            oninput="updateAnnouncementPreview()"
                                            placeholder="Write your announcement details here..."
                                            class="textarea w-full h-52 bg-base-200/50 border border-base-content/10 rounded-xl focus:bg-base-100 focus:border-primary transition-all resize-none leading-relaxed p-4 text-sm placeholder:text-base-content/30 placeholder:font-medium"
                                            required></textarea>
                                    </div>

                                    <div class="space-y-6">
                                        <div class="form-control w-full">
                                            <label class="label px-1 pt-0 pb-2">
                                                <span
                                                    class="text-[10px] font-bold uppercase tracking-widest text-base-content/50">Category</span>
                                            </label>
                                            <select name="type" id="type" onchange="updateAnnouncementPreview()"
                                                class="select w-full h-12 bg-base-200/50 border border-base-content/10 rounded-xl focus:bg-base-100 focus:border-primary transition-all font-bold text-sm"
                                                required>
                                                <option value="info" selected>🔵 Informational</option>
                                                <option value="success">🟢 Success</option>
                                                <option value="warning">🟡 Warning</option>
                                                <option value="error">🔴 Critical Alert</option>
                                            </select>
                                        </div>

                                        <div class="form-control w-full">
                                            <label class="label px-1 pt-0 pb-2">
                                                <span
                                                    class="text-[10px] font-bold uppercase tracking-widest text-base-content/50">Banner
                                                    Image</span>
                                            </label>
                                            <div
                                                class="relative w-full h-32 rounded-xl border-2 border-dashed border-base-content/20 bg-base-200/30 hover:border-primary/50 transition-all cursor-pointer overflow-hidden">
                                                <input type="file" name="image" id="image"
                                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30"
                                                    accept="image/*" onchange="previewAnnouncementImage(this)">
                                                <div id="upload-placeholder"
                                                    class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none z-10 p-4 text-center">
                                                    <p
                                                        class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                                        Click to upload banner</p>
                                                </div>
                                                <div id="image-preview-container" class="hidden absolute inset-0 z-20">
                                                    <img id="preview-img-tag" src="" class="w-full h-full object-cover">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 mt-8">
                            <a href="{{ route('announcements.index') }}"
                                class="btn bg-[#1e293b] hover:bg-[#334155] h-12 px-6 rounded-2xl font-bold uppercase text-[10px] tracking-widest text-white border-none transition-all">
                                CANCEL
                            </a>
                            <button type="submit"
                                class="btn btn-primary h-12 px-8 rounded-2xl font-bold uppercase tracking-widest text-[10px] shadow-xl shadow-primary/20 border-none text-white">
                                CREATE ANNOUNCEMENT
                            </button>
                        </div>
                    </div>

                    {{-- Right Column: Live Preview --}}
                    <div class="lg:col-span-4 sticky top-8">
                        <div
                            class="text-[10px] font-bold uppercase tracking-widest text-blue-500/40 mb-4 px-1 flex items-center gap-2">
                            <div class="size-1.5 rounded-full bg-blue-500"></div>
                            Live View Preview
                        </div>
                        <div
                            class="card bg-white shadow-2xl border border-slate-100 rounded-[2.5rem] overflow-hidden min-h-[400px] flex flex-col justify-between">
                            <div class="p-8">
                                <div id="preview-type-badge"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest border bg-blue-50 text-blue-500 border-blue-100 mb-4">
                                    Information
                                </div>
                                <h4 id="preview-title" class="text-xl font-bold text-slate-300 italic mb-4">Highlight
                                    Title</h4>
                                <p id="preview-content" class="text-sm text-slate-300 font-medium italic line-clamp-6">
                                    Content preview...</p>
                            </div>
                            <div id="preview-banner-container"
                                class="h-40 mx-6 rounded-[1.5rem] bg-slate-50 border border-slate-100 overflow-hidden mb-8 flex items-center justify-center">
                                <img id="preview-banner-img" src="" class="hidden w-full h-full object-cover">
                                <span id="preview-banner-placeholder" class="text-slate-200">No Banner</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateAnnouncementPreview() {
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
            const typeEl = document.getElementById('type');

            const pTitle = document.getElementById('preview-title');
            pTitle.textContent = title || 'Highlight Title';
            pTitle.className = title ? 'text-xl font-bold text-slate-900 mb-4' : 'text-xl font-bold text-slate-300 italic mb-4';

            const pContent = document.getElementById('preview-content');
            pContent.textContent = content || 'Content preview...';
            pContent.className = content ? 'text-sm text-slate-600 font-medium line-clamp-6' : 'text-sm text-slate-300 font-medium italic line-clamp-6';

            const pBadge = document.getElementById('preview-type-badge');
            const type = typeEl.value;
            pBadge.className = 'inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest border mb-4 ';
            if (type === 'success') pBadge.classList.add('bg-green-50', 'text-green-600', 'border-green-100');
            else if (type === 'warning') pBadge.classList.add('bg-amber-50', 'text-amber-600', 'border-amber-100');
            else if (type === 'error') pBadge.classList.add('bg-rose-50', 'text-rose-600', 'border-rose-100');
            else pBadge.classList.add('bg-blue-50', 'text-blue-500', 'border-blue-100');
            pBadge.textContent = typeEl.options[typeEl.selectedIndex].text.split(' ')[1];
        }

        function previewAnnouncementImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview-img-tag').src = e.target.result;
                    document.getElementById('image-preview-container').classList.remove('hidden');
                    document.getElementById('upload-placeholder').classList.add('hidden');

                    document.getElementById('preview-banner-img').src = e.target.result;
                    document.getElementById('preview-banner-img').classList.remove('hidden');
                    document.getElementById('preview-banner-placeholder').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>