<x-app-layout>
    <x-slot name="header">
        <div class="space-y-6">
            <!-- Breadcrumbs -->
            <nav class="flex items-center text-[10px] font-black uppercase tracking-[0.15em] text-base-content/30">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('users.index') }}" class="hover:text-base-content transition-colors">User Management</a></li>
                    <li class="opacity-30"><svg viewBox="0 0 24 24" class="size-2.5" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg></li>
                    <li class="text-base-content/60">Add New User</li>
                </ol>
            </nav>

            <!-- Page Title Section -->
            <div class="flex items-center gap-4">
                <div class="size-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary shadow-sm border border-primary/5 ring-4 ring-primary/5 overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="8.5" cy="7" r="4" />
                        <line x1="20" y1="8" x2="20" y2="14" />
                        <line x1="23" y1="11" x2="17" y2="11" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-3xl text-base-content tracking-tight leading-none mb-1.5">
                        {{ __('Create User') }}
                    </h2>
                    <p class="text-[10px] font-black text-base-content/30 uppercase tracking-[0.1em]">Onboard new team member to system</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 mt-8 pb-20">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left Sidebar: Profile Photo -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="card bg-base-100 shadow-2xl shadow-base-content/[0.03] border border-base-content/5 rounded-[2rem] overflow-hidden">
                        <div class="card-body p-8 text-center items-center">
                            <h3 class="text-[9px] font-black uppercase tracking-[0.2em] text-base-content/30 mb-8 self-start">
                                Profile Photo
                            </h3>
                            
                            <div class="relative group w-40 h-40">
                                <div class="w-full h-full rounded-full border-2 border-dashed border-primary/30 p-2 group-hover:border-primary/50 transition-all">
                                    <div class="w-full h-full rounded-full bg-primary/5 flex items-center justify-center overflow-hidden relative">
                                        <div id="photo-placeholder" class="text-primary/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                            </svg>
                                        </div>
                                        <img src="" alt="Preview" id="photo-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8 space-y-2">
                                <div class="flex items-center justify-center gap-2">
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-base-content/30">Allowed formats</p>
                                    <label for="profile_photo" class="btn btn-circle btn-xs bg-primary hover:bg-primary/90 border-none text-white shadow-lg shadow-primary/20 transition-all cursor-pointer hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                            <path d="M13.5 6.5l4 4" />
                                        </svg>
                                        <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*" onchange="previewImage(this)">
                                    </label>
                                </div>
                                <p class="text-[9px] font-bold text-base-content/15 uppercase tracking-tighter">JPG, PNG, GIF • MAX 3MB</p>
                            </div>
                            
                            @error('profile_photo')
                                <p class="mt-4 text-[10px] text-error font-black uppercase tracking-widest">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Content: Form Fields -->
                <div class="lg:col-span-8 space-y-8">
                    <div class="card bg-base-100 shadow-2xl shadow-base-content/[0.03] border border-base-content/5 rounded-[2rem] overflow-hidden">
                        <div class="card-body p-10 pt-8">
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-base-content/30 flex items-center gap-2.5 mb-10">
                                <div class="size-1.5 bg-primary/40 rounded-full"></div>
                                Account Configuration
                            </h3>

                            <div class="space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="form-control">
                                        <label for="name" class="label pb-2.5">
                                            <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                                Full Name
                                            </span>
                                        </label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                            class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-base-content/20 focus:ring-4 focus:ring-base-content/[0.02] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 py-8" 
                                            placeholder="e.g. John Doe" required />
                                        @error('name') <span class="text-[10px] text-error mt-2 font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-control">
                                        <label for="email" class="label pb-2.5">
                                            <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7l9 6l9 -6" /><path d="M3 7l0 10a2 2 0 0 0 2 2h14a2 2 0 0 0 2 -2v-10" /></svg>
                                                Email Address
                                            </span>
                                        </label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                            class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-base-content/20 focus:ring-4 focus:ring-base-content/[0.02] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 py-8" 
                                            placeholder="e.g. john@example.com" required />
                                        @error('email') <span class="text-[10px] text-error mt-2 font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                @php
                                    $roleOptions = [
                                        [
                                            'value' => 'user', 
                                            'label' => 'Standard User', 
                                            'description' => 'Regular access level', 
                                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>'
                                        ],
                                        [
                                            'value' => 'team_leader', 
                                            'label' => 'Team Leader', 
                                            'description' => 'Can manage teams & projects', 
                                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1 -7 0a5 5 0 0 0 -7 0v-9z" /><path d="M5 21v-7" /></svg>'
                                        ],
                                        [
                                            'value' => 'admin', 
                                            'label' => 'System Administrator', 
                                            'description' => 'Full administrative control', 
                                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z" /></svg>'
                                        ],
                                    ];
                                @endphp

                                <div class="form-control">
                                    <label class="label pb-2.5">
                                        <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z" /></svg>
                                            System Role
                                        </span>
                                    </label>
                                    <x-ui.advance-select 
                                        name="role" 
                                        placeholder="Select Role"
                                        :multiple="false"
                                        :selected="old('role', 'user')"
                                        :options="$roleOptions"
                                    />
                                    @error('role') <span class="text-[10px] text-error mt-2 font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                                </div>

                                <!-- Password Section -->
                                <div class="pt-6 border-t border-base-content/5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="form-control">
                                            <label for="password" class="label pb-2.5">
                                                <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                                                    Set Password
                                                </span>
                                            </label>
                                            <input type="password" name="password" id="password" 
                                                class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-base-content/20 focus:ring-4 focus:ring-base-content/[0.02] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 py-8" 
                                                placeholder="Min. 8 characters" required />
                                            @error('password') <span class="text-[10px] text-error mt-2 font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-control">
                                            <label for="password_confirmation" class="label pb-2.5">
                                                <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10" /></svg>
                                                    Confirm Password
                                                </span>
                                            </label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                                class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-base-content/20 focus:ring-4 focus:ring-base-content/[0.02] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 py-8" 
                                                placeholder="Repeat password" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="mt-12 flex items-center justify-end gap-3 pt-10 border-t border-base-content/5">
                                <a href="{{ route('users.index') }}" 
                                    class="btn btn-ghost font-black uppercase tracking-[0.2em] text-[10px] rounded-xl px-8 h-12 min-h-[48px] border border-transparent hover:bg-base-content/5 transition-all">
                                    Cancel
                                </a>
                                <button type="submit" 
                                    class="btn btn-primary px-8 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-primary/20 h-12 min-h-[48px] border-none group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 5l0 14" /><path d="M5 12l14 0" />
                                    </svg>
                                    Create User
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Image Preview Script -->
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById('photo-preview');
                    var placeholder = document.getElementById('photo-placeholder');
                    
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if(placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
