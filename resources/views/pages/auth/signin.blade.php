@extends('layouts.guest')

@section('title', 'Login - ' . config('app.name'))

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
                    <h2 class="text-2xl font-bold text-slate-900">Welcome Back</h2>
                    <p class="text-slate-500 font-medium text-xs">Planning faster. Focus on growth.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-control">
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}"
                            class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                            required>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="form-control relative">
                        <input type="password" name="password" id="passwordInput" placeholder="Password"
                            class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                            required>
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors focus:outline-none">
                            <span id="eyeIcon" class="icon-[tabler--eye] size-5"></span>
                        </button>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember / Forgot -->
                    <div class="flex items-center justify-between mt-0.5">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="remember"
                                class="checkbox checkbox-xs rounded border-slate-300 checked:border-purple-600 checked:bg-purple-600">
                            <span
                                class="text-xs font-semibold text-slate-500 group-hover:text-purple-600 transition-colors">Remember
                                me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs font-bold text-slate-400 hover:text-purple-600 transition-colors">Forgot
                                Password?</a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full h-[46px] mt-2 rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-purple-600/20 hover:shadow-purple-600/40 hover:scale-[1.01] active:scale-[0.98] transition-all">
                        Sign In
                    </button>

                </form>



                <!-- Mobile Footer Link -->
                <div class="mt-6 text-center md:hidden">
                    <p class="text-xs text-slate-500 font-medium">
                        Don't have an account? <a href="{{ route('register') }}"
                            class="text-purple-600 font-bold hover:underline">Create account</a>
                    </p>
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
                    alt="University Campus"
                    class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">

                <div class="absolute inset-0 bg-gradient-to-br from-purple-900/90 via-slate-900/90 to-slate-900/95"></div>

                <div class="absolute -top-20 -right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col items-center gap-5 max-w-sm">
                    <div
                        class="h-20 w-20 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-2xl shadow-purple-900/20 ring-4 ring-white/10">
                        <img src="{{ asset('trackverse.png') }}" class="h-10 w-10 object-contain" alt="TrackVerse App Icon">
                    </div>

                    <h2 class="text-2xl font-bold text-white tracking-tight">New to TrackVerse?</h2>
                    <p class="text-slate-300 text-sm leading-relaxed font-medium">
                        Register your details to create an account and get started with your project management
                        journey today.
                    </p>

                    <a href="{{ route('register') }}"
                        class="group relative px-6 py-2.5 rounded-lg border-2 border-white/30 text-white font-bold text-xs uppercase tracking-wider hover:bg-white hover:text-purple-900 transition-all duration-300 mt-4 overflow-hidden">
                        <span class="relative z-10 flex items-center gap-2">
                            Register Now
                            <span class="icon-[tabler--arrow-right] group-hover:translate-x-1 transition-transform"></span>
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.remove('icon-[tabler--eye]');
                eyeIcon.classList.add('icon-[tabler--eye-off]');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('icon-[tabler--eye-off]');
                eyeIcon.classList.add('icon-[tabler--eye]');
            }
        }
    </script>
@endsection