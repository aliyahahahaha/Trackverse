@extends('layouts.guest')

@section('title', 'Two-Factor Authentication - ' . config('app.name'))

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
                    <h2 class="text-2xl font-bold text-slate-900">Two-Factor Auth</h2>
                    <p class="text-slate-500 font-medium text-xs">Please confirm access to your account.</p>
                </div>

                <div x-data="{ recovery: false }">
                    <form action="{{ route('two-factor.login') }}" method="POST" class="flex flex-col gap-4">
                        @csrf

                        <!-- Code Input -->
                        <div class="form-control" x-show="!recovery">
                            <label class="label pb-1">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Authentication
                                    Code</span>
                            </label>
                            <input type="text" name="code" inputmode="numeric" autofocus x-bind:required="!recovery"
                                class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none text-center tracking-[0.5em]"
                                placeholder="123456">
                            @error('code')
                                <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Recovery Code Input -->
                        <div class="form-control" x-show="recovery" style="display: none;">
                            <label class="label pb-1">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Recovery
                                    Code</span>
                            </label>
                            <input type="text" name="recovery_code" x-bind:required="recovery"
                                class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                                placeholder="Recovery Code">
                            @error('recovery_code')
                                <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full h-[46px] mt-2 rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-purple-600/20 hover:shadow-purple-600/40 hover:scale-[1.01] active:scale-[0.98] transition-all">
                            Authenticate
                        </button>

                        <!-- Toggle Recovery -->
                        <button type="button"
                            class="text-xs font-bold text-slate-400 hover:text-purple-600 transition-colors mt-2"
                            @click="recovery = !recovery"
                            x-text="recovery ? 'Use an authentication code' : 'Use a recovery code'">
                        </button>
                    </form>
                </div>

                <div class="mt-auto pt-6 text-center md:text-left">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© {{ date('Y') }} TrackVerse
                    </p>
                </div>
            </div>

            <!-- Right Column: Hero (Visible on Desktop) -->
            <div
                class="hidden md:flex w-1/2 bg-slate-900 relative items-center justify-center text-center p-10 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070&auto=format&fit=crop"
                    alt="Security" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">

                <div class="absolute inset-0 bg-gradient-to-br from-purple-900/90 via-slate-900/90 to-slate-900/95"></div>

                <div class="absolute -top-20 -right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col items-center gap-5 max-w-sm">
                    <div
                        class="h-20 w-20 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-2xl shadow-purple-900/20 ring-4 ring-white/10">
                        <img src="{{ asset('trackverse.png') }}" class="h-10 w-10 object-contain" alt="TrackVerse App Icon">
                    </div>

                    <h2 class="text-2xl font-bold text-white tracking-tight">Secure Access</h2>
                    <p class="text-slate-300 text-sm leading-relaxed font-medium">
                        Your account is protected with two-factor authentication. Please enter your code to continue.
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection