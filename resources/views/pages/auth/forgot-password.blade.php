@extends('layouts.guest')

@section('title', 'Forgot Password - ' . config('app.name'))

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
          <h2 class="text-2xl font-bold text-slate-900">Forgot Password?</h2>
          <p class="text-slate-500 font-medium text-xs">Enter your email to reset your password.</p>
        </div>

        @session('status')
          <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-700 text-xs font-semibold">
            {{ $value }}
          </div>
        @endsession

        <form action="{{ route('password.email') }}" method="POST" class="flex flex-col gap-4">
          @csrf

          <!-- Email Input -->
          <div class="form-control">
            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}"
              class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
              required autofocus>
            @error('email')
              <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
            @enderror
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="w-full h-[46px] mt-2 rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-purple-600/20 hover:shadow-purple-600/40 hover:scale-[1.01] active:scale-[0.98] transition-all">
            Send Reset Link
          </button>

          <!-- Back to Login -->
          <a href="{{ route('login') }}"
            class="flex items-center justify-center gap-2 w-full h-[46px] rounded-lg border border-slate-200 text-slate-600 font-bold text-xs uppercase tracking-wider hover:bg-slate-50 hover:text-slate-800 transition-all">
            <span class="icon-[tabler--arrow-left] size-4"></span>
            Back to Login
          </a>

        </form>

        <div class="mt-auto pt-6 text-center md:text-left">
          <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">© {{ date('Y') }} TrackVerse
          </p>
        </div>
      </div>

      <!-- Right Column: Hero (Visible on Desktop) -->
      <div
        class="hidden md:flex w-1/2 bg-slate-900 relative items-center justify-center text-center p-10 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop"
          alt="University Campus" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">

        <div class="absolute inset-0 bg-gradient-to-br from-purple-900/90 via-slate-900/90 to-slate-900/95"></div>

        <div class="absolute -top-20 -right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>

        <div class="relative z-10 flex flex-col items-center gap-5 max-w-sm">
          <div
            class="h-20 w-20 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-2xl shadow-purple-900/20 ring-4 ring-white/10">
            <img src="{{ asset('trackverse.png') }}" class="h-10 w-10 object-contain" alt="TrackVerse App Icon">
          </div>

          <h2 class="text-2xl font-bold text-white tracking-tight">Account Recovery</h2>
          <p class="text-slate-300 text-sm leading-relaxed font-medium">
            Don't worry, it happens to the best of us. We'll help you get back into your account in no time.
          </p>
        </div>
      </div>

    </div>
  </div>
@endsection