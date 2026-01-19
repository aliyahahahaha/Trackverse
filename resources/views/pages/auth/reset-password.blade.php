@extends('layouts.guest')

@section('title', 'Reset Password - ' . config('app.name'))

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-[#F3F4F6] p-4 font-sans">

        <!-- Main Card - Optimized for Compactness -->
        <div
            class="w-full max-w-[900px] bg-white rounded-[24px] shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col md:flex-row relative z-10 min-h-[500px]">

            <!-- Left Column: Form -->
            <div class="w-full md:w-1/2 p-8 md:p-10 lg:p-12 flex flex-col justify-center bg-white relative">

                <div class="flex flex-col gap-1.5 mb-6 md:mb-8 text-left">
                    <div class="flex items-center gap-2 mb-1.5">
                        <div class="h-8 w-8 rounded-lg bg-purple-50 flex items-center justify-center text-primary">
                            <img src="{{ asset('trackverse.png') }}" class="h-5 w-auto" alt="Logo">
                        </div>
                        <span class="text-lg font-bold text-slate-800 tracking-tight uppercase">TrackVerse</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Reset Password</h2>
                    <p class="text-slate-500 font-medium text-xs">Create a new, secure password for your account.</p>
                </div>

                <form action="{{ route('password.update') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Input -->
                    <div class="form-control">
                        <label class="text-xs font-bold text-slate-700 mb-1.5 ml-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $request->email) }}"
                            class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                            readonly required>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- New Password Input -->
                    <div class="form-control relative">
                        <label class="text-xs font-bold text-slate-700 mb-1.5 ml-1">New Password</label>
                        <input type="password" name="password" id="passwordInput" placeholder="············"
                            class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                            required>
                        <button type="button" onclick="togglePassword('passwordInput', 'eyeIcon')"
                            class="absolute right-4 top-[35px] text-slate-400 hover:text-slate-600 transition-colors">
                            <span class="icon-[tabler--eye] size-5" id="eyeIcon"></span>
                        </button>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="form-control relative">
                        <label class="text-xs font-bold text-slate-700 mb-1.5 ml-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="passwordConfirmInput"
                            placeholder="············"
                            class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                            required>
                        <button type="button" onclick="togglePassword('passwordConfirmInput', 'eyeIconConfirm')"
                            class="absolute right-4 top-[35px] text-slate-400 hover:text-slate-600 transition-colors">
                            <span class="icon-[tabler--eye] size-5" id="eyeIconConfirm"></span>
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full h-[46px] mt-4 rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-purple-600/20 hover:shadow-purple-600/40 hover:scale-[1.01] active:scale-[0.98] transition-all">
                        Reset Password
                    </button>

                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}"
                        class="text-xs font-bold text-slate-400 hover:text-purple-600 transition-colors uppercase tracking-wider flex items-center justify-center gap-2">
                        <span class="icon-[tabler--arrow-left] size-4"></span>
                        Back to Login
                    </a>
                </div>

                <div class="mt-auto pt-6 text-center md:text-left">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© {{ date('Y') }} TrackVerse
                    </p>
                </div>
            </div>

            <!-- Right Column: Hero (Visible on Desktop) -->
            <div
                class="hidden md:flex w-1/2 bg-slate-900 relative items-center justify-center text-center p-10 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop"
                    alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">

                <div class="absolute inset-0 bg-gradient-to-br from-purple-900/90 via-slate-900/90 to-slate-900/95"></div>

                <div class="absolute -top-20 -right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col items-center gap-5 max-w-sm">
                    <div
                        class="h-20 w-20 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-2xl shadow-purple-900/20 ring-4 ring-white/10">
                        <img src="{{ asset('trackverse.png') }}" class="h-10 w-10 object-contain" alt="TrackVerse App Icon">
                    </div>

                    <h2 class="text-2xl font-bold text-white tracking-tight">Secure Your Account</h2>
                    <p class="text-slate-300 text-sm leading-relaxed font-medium">
                        Using a strong, unique password helps keep your project data and personal information safe.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('icon-[tabler--eye]');
                icon.classList.add('icon-[tabler--eye-off]');
            } else {
                input.type = 'password';
                icon.classList.remove('icon-[tabler--eye-off]');
                icon.classList.add('icon-[tabler--eye]');
            }
        }
    </script>
@endsection