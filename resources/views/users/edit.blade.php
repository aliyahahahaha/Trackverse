<x-app-layout>
    <x-slot name="header">
        <div class="space-y-6">
            <!-- Breadcrumbs -->
            <nav class="flex items-center text-[10px] font-black uppercase tracking-[0.15em] text-base-content/30">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('users.index') }}" class="hover:text-base-content transition-colors">User Management</a></li>
                    <li class="opacity-30"><svg viewBox="0 0 24 24" class="size-2.5" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg></li>
                    <li class="text-base-content/60">{{ $user->name }}</li>
                    <li class="opacity-30"><svg viewBox="0 0 24 24" class="size-2.5" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg></li>
                    <li class="text-base-content/60">Profile Settings</li>
                </ol>
            </nav>

            <!-- Page Title Section -->
            <div class="flex items-center gap-4">
                <div class="size-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary shadow-sm border border-primary/5 ring-4 ring-primary/5 overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M12 14v4" /><path d="M10 16h4" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-3xl text-base-content tracking-tight leading-none mb-1.5">
                        {{ __('Update Profile') }}
                    </h2>
                    <p class="text-[10px] font-black text-base-content/30 uppercase tracking-[0.1em]">Modify account and system preferences</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 mt-8 pb-20">
        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
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
                                        @if($user->hasMedia('avatars'))
                                            <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="{{ $user->name }}" id="photo-preview" class="absolute inset-0 w-full h-full object-cover" />
                                        @elseif(!empty($user->profile_photo_path))
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" id="photo-preview" class="absolute inset-0 w-full h-full object-cover" />
                                        @else
                                            <div id="photo-placeholder" class="text-primary/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                                </svg>
                                            </div>
                                            <img src="" alt="Preview" id="photo-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                                        @endif
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

                    <!-- Role Status Card -->
                    <div class="card bg-base-100 shadow-2xl shadow-base-content/[0.02] border border-base-content/5 rounded-[2rem] overflow-hidden">
                        <div class="card-body p-8">
                             <h3 class="text-[9px] font-black uppercase tracking-[0.2em] text-base-content/30 mb-6 flex items-center gap-2">
                                 <div class="size-1.5 bg-success/40 rounded-full"></div>
                                 System Access
                             </h3>
                             <div class="flex items-center gap-4">
                                 <div class="size-12 rounded-xl bg-base-content/[0.03] border border-base-content/5 flex items-center justify-center text-base-content/70">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2l4 -4" /><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" /></svg>
                                 </div>
                                 <div>
                                     <div class="text-[10px] font-black uppercase tracking-widest text-base-content/20 mb-0.5">CURRENT ROLE</div>
                                     <div class="badge badge-lg h-7 font-black text-[10px] uppercase tracking-widest border-none {{ $user->isAdmin() ? 'bg-primary/10 text-primary' : ($user->isTeamLeader() ? 'bg-secondary/10 text-secondary' : 'bg-base-200 text-base-content/60') }}">
                                         {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                     </div>
                                 </div>
                             </div>
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
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
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
                                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                            class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-base-content/20 focus:ring-4 focus:ring-base-content/[0.02] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 py-8" 
                                            placeholder="e.g. john@example.com" required />
                                        @error('email') <span class="text-[10px] text-error mt-2 font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                @if(auth()->user()->isAdmin())
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
                                            :selected="old('role', $user->role)"
                                            :options="$roleOptions"
                                        />
                                        @error('role') <span class="text-[10px] text-error mt-2 font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                                    </div>
                                @else
                                    <input type="hidden" name="role" value="{{ $user->role }}">
                                @endif

                                <!-- Password Section -->
                                <div class="pt-6 border-t border-base-content/5">
                                    <div class="alert bg-blue-50/50 border-none rounded-2xl p-4 mb-8 flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-blue-500 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9h.01" /><path d="M11 12h1v4h1" /><path d="M12 3a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /></svg>
                                        <p class="text-[11px] font-bold text-blue-600/80 leading-relaxed uppercase tracking-tight">Leave the password fields blank if you don't want to change the current password.</p>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="form-control">
                                            <label for="password" class="label pb-2.5">
                                                <span class="text-[9px] uppercase font-black tracking-[0.2em] text-base-content/40 flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                                                    New Password
                                                </span>
                                            </label>
                                            <input type="password" name="password" id="password" 
                                                class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-base-content/20 focus:ring-4 focus:ring-base-content/[0.02] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 py-8" 
                                                placeholder="Min. 8 characters" />
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
                                                placeholder="Repeat new password" />
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
                                    class="btn btn-warning px-8 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-warning/20 h-12 min-h-[48px] border-none group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Security / 2FA Section (Outside main form) -->
                <div class="card bg-base-100 shadow-2xl shadow-base-content/[0.03] border border-base-content/5 rounded-[2rem] overflow-hidden mt-8">
                    <div class="card-body p-14 pt-16 pb-14">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-base-content/30 flex items-center gap-2.5 mb-8">
                            <div class="size-1.5 bg-error/40 rounded-full"></div>
                            Two-Factor Authentication
                        </h3>

                        @if(! auth()->user()->two_factor_secret)
                            {{-- State: Not Enabled --}}
                            <div class="space-y-6">
                                <div class="max-w-xl">
                                    <h4 class="text-base font-bold text-base-content mb-3">Add additional security</h4>
                                    <p class="text-sm text-base-content/60 leading-relaxed">Enable two-factor authentication to protect your account with a secure, random token.</p>
                                </div>
                                <form method="POST" action="{{ route('two-factor.enable') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary font-black uppercase tracking-widest text-[10px] rounded-xl px-6 min-h-[44px] h-11">
                                        Enable 2FA
                                    </button>
                                </form>
                            </div>
                        @else
                            {{-- State: Enabled (Confirmed or Unconfirmed) --}}
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-8 mb-10 border-b border-base-content/5 pb-10">
                                <div>
                                    <h4 class="text-base font-bold text-base-content mb-2 flex items-center gap-2">
                                        2FA is currently enabled
                                        @if(! auth()->user()->two_factor_confirmed_at)
                                            <span class="badge badge-warning badge-xs text-[9px] font-black uppercase tracking-wider">Finish Setup</span>
                                        @else
                                            <span class="badge badge-success badge-xs text-[9px] font-black uppercase tracking-wider">Active</span>
                                        @endif
                                    </h4>
                                    <p class="text-sm text-base-content/60 leading-relaxed max-w-md">Your account is secured. authentication tokens are required for login.</p>
                                </div>
                                <form method="POST" action="{{ route('two-factor.disable') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-outline font-black uppercase tracking-widest text-[10px] rounded-xl px-6 min-h-[44px] h-11 hover:text-white">
                                        Disable 2FA
                                    </button>
                                </form>
                            </div>

                            @if(session('status') == 'two-factor-authentication-enabled' || ! auth()->user()->two_factor_confirmed_at)
                                {{-- Setup / Confirmation Step --}}
                                <div class="bg-base-200/50 rounded-2xl p-8 border border-base-content/5 mb-10">
                                    <p class="font-bold text-sm text-base-content mb-5">
                                        1. Scan this QR code with your authenticator app (Google Auth, Authy, etc).
                                    </p>
                                    <div class="p-4 bg-white inline-block rounded-xl border border-base-content/10 shadow-sm mb-8">
                                        {!! request()->user()->twoFactorQrCodeSvg() !!}
                                    </div>

                                    <p class="font-bold text-sm text-base-content mb-5">
                                        2. Enter the code from your app to confirm.
                                    </p>
                                    <form method="POST" action="{{ route('two-factor.confirm') }}" class="flex items-start gap-4">
                                        @csrf
                                        <div class="form-control">
                                            <input type="text" name="code" class="input bg-base-100 border-base-content/10 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-xl w-40 font-mono text-center tracking-widest" placeholder="123 456" inputmode="numeric">
                                        </div>
                                        <button type="submit" class="btn btn-primary font-black uppercase tracking-widest text-[10px] rounded-xl">Confirm</button>
                                    </form>
                                    @error('code') <span class="text-[10px] text-error mt-2 font-black uppercase tracking-widest block">{{ $message }}</span> @enderror
                                </div>
                            @endif

                            @if(auth()->user()->two_factor_confirmed_at)
                                {{-- Recovery Codes --}}
                                <div>
                                     <div class="flex items-center justify-between mb-5">
                                         <h4 class="text-sm font-bold text-base-content">Recovery Codes</h4>
                                         <form method="POST" action="{{ route('two-factor.recovery-codes') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-xs font-bold uppercase tracking-widest">Regenerate</button>
                                         </form>
                                     </div>
                                     <div class="bg-base-content/[0.02] rounded-xl p-5 border border-base-content/5">
                                         <div class="grid grid-cols-2 gap-x-4 gap-y-3 font-mono text-xs text-base-content/70">
                                            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                                <div class="flex items-center gap-2">
                                                    <div class="size-1.5 rounded-full bg-base-content/20"></div>
                                                    {{ $code }}
                                                </div>
                                            @endforeach
                                         </div>
                                     </div>
                                     <p class="text-[10px] text-base-content/40 font-medium mt-4 leading-relaxed">
                                        Store these codes in a secure password manager. They can be used to access your account if you lose your device.
                                     </p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
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