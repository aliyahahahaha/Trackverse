<x-app-layout>
    <div class="min-h-screen w-full bg-gray-50 py-12 px-4 sm:px-6">

        {{-- Header Navigation --}}
        <div class="max-w-3xl mx-auto mb-6 flex items-center gap-4">
            <a href="{{ route('announcements.index') }}"
                class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                <span class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">← BACK
                    TO ANNOUNCEMENTS</span>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Announcement</h2>
                <div class="flex items-center gap-2 text-xs font-medium text-gray-500">
                    <span class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></span>
                    Live Editing Mode
                </div>
            </div>
        </div>

        {{-- Main Content Card --}}
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">

                {{-- Colored Top Border --}}
                <div class="h-1.5 w-full bg-orange-400"></div>

                <div class="p-8 gap-6">
                    <form action="{{ route('announcements.update', $announcement) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="w-full">
                            <label class="block font-bold text-gray-700 pb-2" for="title">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-7 h-7 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M7 12h10" />
                                            <path d="M7 5v14" />
                                            <path d="M17 5v14" />
                                        </svg>
                                    </div>
                                    <span class="text-sm uppercase tracking-wide">Headline Title</span>
                                </div>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $announcement->title) }}"
                                class="w-full h-12 px-4 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-medium text-base text-gray-900 placeholder:text-gray-400 outline-none"
                                placeholder="e.g., System Maintenance" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Type & Image Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 items-start">
                            {{-- Content --}}
                            <div class="w-full">
                                <label class="block font-bold text-gray-700 pb-2" for="content">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-7 h-7 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path
                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <path d="M9 17h6" />
                                                <path d="M9 13h6" />
                                            </svg>
                                        </div>
                                        <span class="text-sm uppercase tracking-wide">Detailed Content</span>
                                    </div>
                                </label>
                                <textarea id="content" name="content"
                                    class="w-full h-[208px] p-4 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all font-medium text-gray-900 placeholder:text-gray-400 outline-none leading-relaxed resize-none"
                                    placeholder="Write the announcement details here..."
                                    required>{{ old('content', $announcement->content) }}</textarea>
                                @error('content')
                                    <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Category (Right Side of Grid) --}}
                            <div class="w-full">
                                <label class="block font-bold text-gray-700 pb-2" for="type">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-7 h-7 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 4h6v6h-6z" />
                                                <path d="M14 4h6v6h-6z" />
                                                <path d="M4 14h6v6h-6z" />
                                                <path d="M14 14h6v6h-6z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm uppercase tracking-wide">Category</span>
                                    </div>
                                </label>
                                <div class="relative group">
                                    <select name="type" id="type"
                                        class="w-full h-12 px-4 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-medium text-gray-900 outline-none appearance-none bg-white cursor-pointer"
                                        style="-webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: none;"
                                        required>
                                        <option value="info" {{ old('type', $announcement->type) == 'info' ? 'selected' : '' }}>🔵 Informational</option>
                                        <option value="success" {{ old('type', $announcement->type) == 'success' ? 'selected' : '' }}>🟢 Success</option>
                                        <option value="warning" {{ old('type', $announcement->type) == 'warning' ? 'selected' : '' }}>🟡 Warning</option>
                                        <option value="error" {{ old('type', $announcement->type) == 'error' ? 'selected' : '' }}>🔴 Critical Error</option>
                                    </select>
                                    <div
                                        class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 group-hover:text-orange-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M6 9l6 6l6 -6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Image Input (Bottom Full Width) --}}
                        <div class="w-full">
                            <label class="block font-bold text-gray-700 pb-2" for="image">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                            <circle cx="8.5" cy="8.5" r="1.5" />
                                            <polyline points="21 15 16 10 5 21" />
                                        </svg>
                                    </div>
                                    <span class="text-sm uppercase tracking-wide">Update Banner</span>
                                </div>
                            </label>

                            {{-- Dropzone Container --}}
                            <div id="dropzone-container" style="height: 208px;"
                                class="relative w-full h-52 rounded-lg border-2 {{ $announcement->image_path ? 'border-transparent' : 'border-dashed border-gray-300' }} bg-gray-50 hover:bg-emerald-50/50 hover:border-emerald-500 transition-all cursor-pointer group overflow-hidden">

                                {{-- Hidden Inputs --}}
                                <input type="file" id="image" name="image"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30"
                                    accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this)">
                                <input type="hidden" name="remove_image" id="remove_image" value="0">

                                {{-- Placeholder State --}}
                                <div id="upload-placeholder"
                                    class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none z-10 p-4 text-center transition-opacity duration-300 {{ $announcement->image_path ? 'opacity-0' : '' }}">
                                    <div
                                        class="w-10 h-10 rounded-full bg-white shadow-sm border border-gray-200 text-emerald-600 flex items-center justify-center mb-2 group-hover:scale-110 group-hover:shadow-md transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M4 14.899a7 7 0 1 1 15.718 -2.908a7 7 0 1 1 -5.718 2.908" />
                                            <path d="M12 12v9" />
                                            <path d="M9 16l3 -3l3 3" />
                                        </svg>
                                    </div>
                                    <p
                                        class="text-sm font-bold text-gray-700 group-hover:text-emerald-700 transition-colors">
                                        Upload Banner</p>
                                    <p class="text-xs text-gray-400 mt-1 font-medium">PNG/JPG · Recommended 1200×600
                                    </p>
                                </div>

                                {{-- Live Preview State --}}
                                <div id="image-preview"
                                    class="{{ $announcement->image_path ? '' : 'hidden' }} absolute inset-0 z-20 bg-gray-100">
                                    <img id="preview-img"
                                        src="{{ $announcement->image_path ? Storage::url($announcement->image_path) : '' }}"
                                        class="w-full h-full object-cover">

                                    {{-- Actions Overlay --}}
                                    <div
                                        class="absolute inset-0 bg-black/50 flex items-center justify-center gap-4 opacity-0 hover:opacity-100 transition-opacity duration-300 backdrop-blur-sm z-40">
                                        <button type="button" onclick="document.getElementById('image').click()"
                                            class="btn btn-circle bg-white border-0 text-gray-800 hover:bg-gray-100 hover:scale-105 transition-all shadow-xl w-12 h-12"
                                            title="Replace Image">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                            </svg>
                                        </button>
                                        <button type="button" onclick="removeImage(event)"
                                            class="btn btn-circle bg-red-500 border-0 text-white hover:bg-red-600 hover:scale-105 transition-all shadow-xl w-12 h-12"
                                            title="Remove Image">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 6l-12 12" />
                                                <path d="M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Preview Script --}}
                        <script>
                            function previewImage(input) {
                                const file = input.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                        document.getElementById('preview-img').src = e.target.result;
                                        document.getElementById('image-preview').classList.remove('hidden');
                                        document.getElementById('upload-placeholder').classList.add('opacity-0');

                                        // Update border style for filled state
                                        const container = document.getElementById('dropzone-container');
                                        container.classList.remove('border-dashed', 'border-gray-300');
                                        container.classList.add('border-transparent');

                                        // Reset remove flag if user uploads new image
                                        document.getElementById('remove_image').value = '0';
                                    };
                                    reader.readAsDataURL(file);
                                }
                            }

                            function removeImage(event) {
                                // Prevent the file input from opening when clicking remove
                                event.preventDefault();
                                event.stopPropagation();

                                const input = document.getElementById('image');
                                input.value = '';

                                // Set remove flag to true (1)
                                document.getElementById('remove_image').value = '1';

                                document.getElementById('image-preview').classList.add('hidden');
                                document.getElementById('upload-placeholder').classList.remove('opacity-0');
                                document.getElementById('preview-img').src = '';

                                // Reset border style for empty state
                                const container = document.getElementById('dropzone-container');
                                container.classList.add('border-dashed', 'border-gray-300');
                                container.classList.remove('border-transparent');
                            }
                        </script>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-6 pt-6 mt-6 border-t border-gray-100">
                            <a href="{{ route('announcements.index') }}"
                                class="text-gray-500 font-semibold hover:text-gray-800 hover:underline transition-colors text-sm">
                                Cancel
                            </a>
                            <button type="submit"
                                class="btn btn-warning shadow-lg shadow-warning/20 rounded-lg px-8 h-12 font-bold text-white flex items-center gap-2 hover:-translate-y-0.5 transition-transform">
                                <span class="icon-[tabler--device-floppy] size-5"></span>
                                Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>