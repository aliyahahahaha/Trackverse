<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <a href="{{ route('users.index') }}"
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        USER LIST
                    </a>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        UPDATE PROFILE
                    </div>
                </div>
            </div>

            <!-- Main Header Content -->
            <!-- Profile Identity Hero -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 mt-2">
                <div class="flex flex-col md:flex-row items-center gap-8 text-center md:text-left">
                    <!-- Profile Photo with Glow -->
                    <div class="relative group shrink-0">
                        <div
                            class="absolute -inset-1 bg-gradient-to-tr from-warning to-primary rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition-all duration-500">
                        </div>
                        <div
                            class="relative size-32 rounded-[2.5rem] bg-base-100 flex items-center justify-center text-primary shadow-xl border border-base-content/5 ring-1 ring-base-content/5 overflow-hidden">
                            @if($user->hasMedia('avatars'))
                                <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="{{ $user->name }}"
                                    class="w-full h-full object-cover">
                            @elseif(!empty($user->profile_photo_path))
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                                    <span
                                        class="text-3xl font-black text-primary tracking-tighter">{{ collect(explode(' ', $user->name))->map(fn($n) => $n[0])->take(2)->join('') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col md:flex-row items-center gap-3">
                            <h1 class="text-4xl font-black text-base-content tracking-tight leading-none">
                                Update Profile
                            </h1>
                            <div
                                class="inline-flex items-center gap-2.5 px-3 py-1 bg-primary/5 rounded-full shadow-sm">
                                <span class="relative flex h-1.5 w-1.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-primary"></span>
                                </span>
                                <span class="text-[10px] font-black text-primary uppercase tracking-[0.2em]">Edit Mode</span>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-y-3 gap-x-6">
                            <div class="flex items-center gap-2 text-sm font-bold text-base-content/40">
                                <span class="icon-[tabler--user] size-4 opacity-40"></span>
                                {{ $user->name }}
                            </div>
                            <div class="flex items-center gap-2 text-sm font-bold text-base-content/40">
                                <span class="icon-[tabler--calendar-event] size-4 opacity-40"></span>
                                Joined {{ $user->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Link -->
                <div class="flex items-center justify-center lg:justify-end gap-3 shrink-0">
                    <a href="{{ route('users.show', $user) }}"
                        class="btn btn-lg h-14 px-8 bg-[#1e293b] hover:bg-[#334155] text-white rounded-2xl shadow-xl shadow-slate-900/10 border-none transition-all gap-3 group">
                        <span class="icon-[tabler--external-link] size-4 group-hover:rotate-12 transition-transform opacity-60"></span>
                        <span class="text-[11px] uppercase font-black tracking-widest">View Profile</span>
                    </a>
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
                    <div
                        class="card bg-base-100 shadow-2xl shadow-base-content/[0.03] border border-base-content/5 rounded-[2.5rem] overflow-hidden group/card hover:border-primary/20 transition-all duration-500">
                        <div class="card-body p-8 text-center items-center">
                            <h3
                                class="text-[10px] font-bold uppercase tracking-widest text-base-content/30 mb-8 self-start flex items-center gap-2">
                                <div class="size-1.5 bg-primary/40 rounded-full"></div>
                                Change Avatar
                            </h3>

                            <div class="relative group/photo w-44 h-44">
                                <!-- Animated Border Surround -->
                                <div
                                    class="absolute -inset-2 bg-gradient-to-tr from-primary/20 via-primary/5 to-secondary/20 rounded-[3rem] opacity-0 group-hover/photo:opacity-100 transition-all duration-700 animate-pulse">
                                </div>

                                <div
                                    class="relative w-full h-full rounded-[2.5rem] border-2 border-dashed border-base-content/10 p-2 group-hover/photo:border-primary/40 transition-all">
                                    <div
                                        class="w-full h-full rounded-[2rem] bg-base-200/50 flex items-center justify-center overflow-hidden relative shadow-inner">
                                        @if($user->hasMedia('avatars'))
                                            <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="{{ $user->name }}"
                                                id="photo-preview"
                                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/photo:scale-110" />
                                        @elseif(!empty($user->profile_photo_path))
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                alt="{{ $user->name }}" id="photo-preview"
                                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/photo:scale-110" />
                                        @else
                                            <div id="photo-placeholder"
                                                class="text-base-content/10 group-hover/photo:text-primary/20 transition-colors duration-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                    <path
                                                        d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                                </svg>
                                            </div>
                                            <img src="" alt="Preview" id="photo-preview"
                                                class="absolute inset-0 w-full h-full object-cover hidden transition-transform duration-700 group-hover/photo:scale-110" />
                                        @endif
                                    </div>

                                    <!-- Hover Overlay -->
                                    <label for="profile_photo"
                                        class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-primary/80 opacity-0 group-hover/photo:opacity-100 transition-all duration-300 rounded-[2rem] cursor-pointer">
                                        <span class="icon-[tabler--camera] size-8 text-white mb-2"></span>
                                        <span class="text-[10px] font-black uppercase tracking-widest text-white">Upload
                                            New</span>
                                        <input type="file" name="profile_photo" id="profile_photo" class="hidden"
                                            accept="image/*" onchange="previewImage(this)">
                                    </label>
                                </div>
                            </div>

                            <div class="mt-8 space-y-1">
                                <p class="text-[10px] font-black uppercase tracking-widest text-base-content/20">MAX
                                    SIZE: 3MB</p>
                                <p class="text-[10px] font-bold text-base-content/10 uppercase tracking-tighter">JPG,
                                    PNG OR GIF</p>
                            </div>

                            @error('profile_photo')
                                <p class="mt-4 text-[10px] text-error font-bold uppercase tracking-widest">{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Role Status Card -->
                    <div
                        class="card bg-base-100 shadow-2xl shadow-base-content/[0.02] border border-base-content/5 rounded-[2.5rem] overflow-hidden hover:border-primary/20 transition-all duration-500">
                        <div class="card-body p-8">
                            <h3
                                class="text-[10px] font-bold uppercase tracking-widest text-base-content/30 mb-6 flex items-center gap-2">
                                <div class="size-1.5 bg-success/40 rounded-full"></div>
                                System Access
                            </h3>
                            <div class="flex items-center gap-4">
                                <div
                                    class="size-12 rounded-[1.25rem] bg-base-content/[0.03] border border-base-content/5 flex items-center justify-center text-primary shadow-inner">
                                    <span class="icon-[tabler--shield-check] size-6 opacity-60"></span>
                                </div>
                                <div>
                                    <div
                                        class="text-[10px] font-black uppercase tracking-widest text-base-content/20 mb-1">
                                        CURRENT ROLE</div>
                                    <div
                                        class="inline-flex items-center justify-center px-3 h-7 font-black text-[10px] uppercase tracking-[0.1em] rounded-full {{ $user->isAdmin() ? 'bg-primary text-white shadow-lg shadow-primary/20' : ($user->isTeamLeader() ? 'bg-secondary text-white shadow-lg shadow-secondary/20' : 'bg-base-content/10 text-base-content opacity-60') }}">
                                        {{ $user->role_label }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content: Form Fields -->
                <div class="lg:col-span-8 space-y-8">
                    <div
                        class="card bg-base-100 shadow-2xl shadow-base-content/[0.03] border border-base-content/5 rounded-[2.5rem] overflow-hidden">
                        <div class="card-body p-10 pt-8">
                            <h3 class="text-[10px] font-bold uppercase tracking-widest text-base-content/30 flex items-center gap-2.5 mb-10">
                                <div class="size-1.5 bg-primary/40 rounded-full"></div>
                                Account Configuration
                            </h3>

                            <div class="space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="form-control">
                                        <label for="name" class="label pb-2.5">
                                            <span class="text-[9px] uppercase font-black tracking-widest text-base-content/40 flex items-center gap-2">
                                                <span class="icon-[tabler--user] size-3.5 opacity-40"></span>
                                                Full Name
                                            </span>
                                        </label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                            class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-primary/30 focus:ring-4 focus:ring-primary/[0.03] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 placeholder:font-black py-8" 
                                            placeholder="e.g. John Doe" required />
                                        @error('name') <span class="text-[10px] text-error mt-2 font-bold uppercase tracking-widest">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-control">
                                        <label for="email" class="label pb-2.5">
                                            <span class="text-[9px] uppercase font-black tracking-widest text-base-content/40 flex items-center gap-2">
                                                <span class="icon-[tabler--mail] size-3.5 opacity-40"></span>
                                                Email Address
                                            </span>
                                        </label>
                                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                            class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-primary/30 focus:ring-4 focus:ring-primary/[0.03] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 placeholder:font-black py-8" 
                                            placeholder="e.g. john@example.com" required />
                                        @error('email') <span class="text-[10px] text-error mt-2 font-bold uppercase tracking-widest">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                @if(auth()->user()->isAdmin())
                                    @php
                                        $roleOptions = [
                                            [
                                                'value' => 'user',
                                                'label' => 'User',
                                                'description' => 'Regular access level',
                                                'icon' => '<span class="icon-[tabler--user] size-5"></span>'
                                            ],
                                            [
                                                'value' => 'team_leader',
                                                'label' => 'Team Leader',
                                                'description' => 'Can manage teams & projects',
                                                'icon' => '<span class="icon-[tabler--briefcase] size-5"></span>'
                                            ],
                                            [
                                                'value' => 'admin',
                                                'label' => 'Admin',
                                                'description' => 'Full administrative control',
                                                'icon' => '<span class="icon-[tabler--crown] size-5"></span>'
                                            ],
                                            [
                                                'value' => 'director',
                                                'label' => 'Director',
                                                'description' => 'Monitor all projects & tickets',
                                                'icon' => '<span class="icon-[tabler--building-skyscraper] size-5"></span>'
                                            ],
                                        ];
                                    @endphp
                                    <div class="form-control">
                                        <label class="label pb-2.5">
                                            <span class="text-[9px] uppercase font-black tracking-widest text-base-content/40 flex items-center gap-2">
                                                <span class="icon-[tabler--shield-lock] size-3.5 opacity-40"></span>
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
                                        @error('role') <span class="text-[10px] text-error mt-2 font-bold uppercase tracking-widest">{{ $message }}</span> @enderror
                                    </div>
                                @else
                                    <input type="hidden" name="role" value="{{ $user->role }}">
                                @endif

                                <!-- Password Section -->
                                <div class="pt-10 border-t border-base-content/5 mt-10">
                                    <div class="alert bg-primary/[0.03] border border-primary/10 rounded-2xl p-4 mb-10 flex items-start gap-3">
                                        <span class="icon-[tabler--info-circle] size-5 text-primary shrink-0 mt-0.5"></span>
                                        <p class="text-[10px] font-black text-primary/60 leading-relaxed uppercase tracking-widest">Leave password fields blank to keep current password.</p>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="form-control">
                                            <label for="password" class="label pb-2.5">
                                                <span class="text-[9px] uppercase font-black tracking-widest text-base-content/40 flex items-center gap-2">
                                                    <span class="icon-[tabler--lock] size-3.5 opacity-40"></span>
                                                    New Password
                                                </span>
                                            </label>
                                            <input type="password" name="password" id="password" 
                                                class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-primary/30 focus:ring-4 focus:ring-primary/[0.03] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 placeholder:font-black py-8" 
                                                placeholder="Min. 8 characters" />
                                            @error('password') <span class="text-[10px] text-error mt-2 font-bold uppercase tracking-widest">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-control">
                                            <label for="password_confirmation" class="label pb-2.5">
                                                <span class="text-[9px] uppercase font-black tracking-widest text-base-content/40 flex items-center gap-2">
                                                    <span class="icon-[tabler--lock-check] size-3.5 opacity-40"></span>
                                                    Confirm Password
                                                </span>
                                            </label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                                class="input input-lg w-full bg-base-content/[0.02] border-base-content/5 hover:bg-base-content/[0.04] focus:bg-base-100 focus:border-primary/30 focus:ring-4 focus:ring-primary/[0.03] transition-all font-bold text-sm rounded-2xl placeholder:text-base-content/20 placeholder:font-black py-8" 
                                                placeholder="Repeat new password" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="mt-12 flex items-center justify-end gap-3 pt-10 border-t border-base-content/5">
                                <a href="{{ route('users.index') }}" 
                                    class="btn bg-[#1e293b] hover:bg-[#334155] font-black uppercase tracking-widest text-[10px] text-white rounded-2xl px-10 h-14 border-none transition-all">
                                    CANCEL
                                </a>
                                <button type="submit" 
                                    class="btn btn-warning px-10 rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-xl shadow-warning/20 h-14 border-none group transition-all text-white">
                                    <span class="icon-[tabler--check] size-5 group-hover:scale-110 transition-transform"></span>
                                    SAVE CHANGES
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Security / 2FA Section (Outside main form) -->
        <div class="card bg-base-100 shadow-2xl shadow-base-content/[0.03] border border-base-content/5 rounded-[2.5rem] overflow-hidden mt-8 hover:border-error/10 transition-all duration-500">
            <div class="card-body p-14 pt-16 pb-14">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-base-content/30 flex items-center gap-2.5 mb-10">
                    <div class="size-1.5 bg-error/40 rounded-full"></div>
                    Two-Factor Authentication
                </h3>

                @if(!auth()->user()->two_factor_secret)
                    {{-- State: Not Enabled --}}
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-10">
                        <div class="max-w-xl">
                            <h4 class="text-xl font-black text-base-content mb-3 tracking-tight">Protect Your Account</h4>
                            <p class="text-sm font-medium text-base-content/50 leading-relaxed">Add an extra layer of security to your account by enabling two-factor authentication. Each login will require a secure token from your mobile device.</p>
                        </div>
                        <form method="POST" action="{{ route('two-factor.enable') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary font-black uppercase tracking-widest text-[10px] rounded-2xl px-8 h-14 border-none shadow-xl shadow-primary/20">
                                <span class="icon-[tabler--plus] size-4"></span>
                                Enable 2FA
                            </button>
                        </form>
                    </div>
                @else
                    {{-- State: Enabled (Confirmed or Unconfirmed) --}}
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-8 mb-12 border-b border-base-content/5 pb-12">
                        <div class="flex items-center gap-6">
                            <div class="size-16 rounded-2xl bg-success/10 text-success flex items-center justify-center shadow-inner">
                                <span class="icon-[tabler--shield-lock] size-8"></span>
                            </div>
                            <div>
                                <h4 class="text-xl font-black text-base-content mb-1.5 tracking-tight flex items-center gap-3">
                                    2FA Is Enabled
                                    @if(!auth()->user()->two_factor_confirmed_at)
                                        <span class="inline-flex items-center px-3 h-6 bg-warning/10 text-warning text-[9px] font-black uppercase tracking-widest rounded-full shadow-lg shadow-warning/10">SETUP REQUIRED</span>
                                    @else
                                        <span class="inline-flex items-center px-3 h-6 bg-success/10 text-success text-[9px] font-black uppercase tracking-widest rounded-full shadow-lg shadow-success/10">ACTIVE</span>
                                    @endif
                                </h4>
                                <p class="text-sm font-medium text-base-content/40 leading-relaxed max-w-md">Your account is secured with secondary authentication tokens.</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('two-factor.disable') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-error/5 hover:bg-error/10 text-error font-black uppercase tracking-widest text-[10px] rounded-2xl px-10 h-14 border-none transition-all group">
                                <span class="icon-[tabler--trash] size-5 group-hover:scale-110 transition-transform"></span>
                                Disable 2FA
                            </button>
                        </form>
                    </div>

                    @if(session('status') == 'two-factor-authentication-enabled' || !auth()->user()->two_factor_confirmed_at)
                        {{-- Setup / Confirmation Step --}}
                        <div class="bg-base-200/50 rounded-[2rem] p-10 border border-base-content/5 mb-12 shadow-inner ring-1 ring-base-content/[0.02]">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                                <div>
                                    <p class="font-black text-sm text-base-content mb-6 flex items-center gap-3 italic uppercase tracking-widest text-primary/60">
                                        <span class="size-6 bg-primary text-white flex items-center justify-center rounded-lg not-italic text-[10px]">01</span>
                                        Scan QR Code
                                    </p>
                                    <div class="p-6 bg-white inline-block rounded-3xl border border-base-content/10 shadow-2xl shadow-base-content/[0.05] mb-4">
                                        {!! request()->user()->twoFactorQrCodeSvg() !!}
                                    </div>
                                    <p class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest leading-relaxed">Scan this code with Google Authenticator or Authy</p>
                                </div>

                                <div>
                                    <p class="font-black text-sm text-base-content mb-6 flex items-center gap-3 italic uppercase tracking-widest text-primary/60">
                                        <span class="size-6 bg-primary text-white flex items-center justify-center rounded-lg not-italic text-[10px]">02</span>
                                        Confirm Access
                                    </p>
                                    <form method="POST" action="{{ route('two-factor.confirm') }}" class="flex flex-col gap-4 max-w-sm">
                                        @csrf
                                        <div class="form-control">
                                            <input type="text" name="code" class="input input-lg bg-base-100 border-base-content/10 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-2xl w-full font-mono text-center text-xl tracking-[0.5em] h-16 shadow-lg shadow-base-content/[0.02] placeholder:font-black placeholder:text-base-content/20" placeholder="000000" inputmode="numeric">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg font-black uppercase tracking-widest text-[10px] rounded-2xl h-14 border-none shadow-xl shadow-primary/20">
                                            <span class="icon-[tabler--check] size-5"></span>
                                            Verify & Enable
                                        </button>
                                    </form>
                                    @error('code') <span class="text-[10px] text-error mt-3 font-black uppercase tracking-widest block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(auth()->user()->two_factor_confirmed_at)
                        {{-- Recovery Codes --}}
                        <div class="bg-base-content/[0.02] rounded-[2rem] p-10 border border-base-content/5 shadow-inner">
                             <div class="flex items-center justify-between mb-8">
                                 <div>
                                     <h4 class="text-sm font-black text-base-content uppercase tracking-widest italic flex items-center gap-3">
                                         <span class="icon-[tabler--key] size-5 text-primary"></span>
                                         Recovery Codes
                                     </h4>
                                     <p class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest mt-1">Keep these codes in a safe place</p>
                                 </div>
                                 <form method="POST" action="{{ route('two-factor.recovery-codes') }}">
                                    @csrf
                                    <button type="submit" class="btn bg-base-100 hover:bg-base-200 border border-base-content/10 font-black uppercase tracking-widest text-[10px] rounded-xl px-5 h-10 transition-all">
                                        <span class="icon-[tabler--refresh] size-4"></span>
                                        Regenerate
                                    </button>
                                 </form>
                             </div>
                             <div class="bg-base-100 rounded-2xl p-6 border border-base-content/5 shadow-sm">
                                 <div class="grid grid-cols-2 md:grid-cols-4 gap-4 font-mono text-xs text-base-content/70">
                                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                        <div class="flex items-center gap-3 bg-base-content/[0.02] p-3 rounded-lg border border-base-content/[0.02]">
                                            <div class="size-1 bg-primary/40 rounded-full"></div>
                                            {{ $code }}
                                        </div>
                                    @endforeach
                                 </div>
                             </div>
                             <div class="flex items-center gap-3 mt-8 p-4 bg-primary/[0.03] rounded-xl border border-primary/5">
                                 <span class="icon-[tabler--alert-circle] size-5 text-primary shrink-0 opacity-60"></span>
                                 <p class="text-[10px] text-primary/60 font-black uppercase tracking-widest leading-relaxed">
                                    Store these codes in a secure password manager. They can be used to access your account if you lose your device.
                                 </p>
                             </div>
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
