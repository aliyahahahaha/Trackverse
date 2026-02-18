@extends('layouts.guest')

@section('title', 'Register - ' . config('app.name'))

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-[#F3F4F6] p-4 font-sans">





        <!-- Main Card - Optimized for Compactness -->
        <div
            class="w-full max-w-[960px] bg-white rounded-[24px] shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col md:flex-row relative z-10 min-h-[500px]">

            <!-- Left Column: Registration Form -->
            <div class="w-full md:w-1/2 p-8 md:p-10 lg:p-12 flex flex-col justify-center bg-white relative">

                <!-- Mobile Logo -->
                <div class="flex flex-col gap-1.5 mb-6 md:mb-6 text-left">
                    <div class="flex items-center gap-2 mb-1.5">
                        <div class="h-8 w-8 rounded-lg bg-purple-50 flex items-center justify-center text-primary">
                            <img src="{{ asset('trackverse.png') }}" class="h-5 w-auto" alt="Logo">
                        </div>
                        <span class="text-lg font-bold text-slate-800 tracking-tight uppercase">TrackVerse</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Create Account</h2>
                    <p class="text-slate-500 font-medium text-xs">Join us and start shipping today.</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    <!-- Name Input -->
                    <div class="form-control">
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}"
                            class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                            required>
                        @error('name')
                            <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="form-control">
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}"
                            class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                            required>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Row -->
                    <div class="flex flex-col md:flex-row gap-4">
                        <!-- Password Input -->
                        <div class="form-control relative w-full">
                            <input type="password" name="password" id="passwordInput" placeholder="Password"
                                class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                                required>
                            <button type="button" onclick="togglePassword('passwordInput', 'eyeIcon')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors focus:outline-none">
                                <span id="eyeIcon" class="icon-[tabler--eye] size-5"></span>
                            </button>
                            @error('password')
                                <span class="text-red-500 text-xs mt-1.5 font-bold ml-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-control relative w-full">
                            <input type="password" name="password_confirmation" id="confirmPasswordInput"
                                placeholder="Confirm"
                                class="w-full h-[46px] bg-slate-50 border border-slate-200 rounded-lg px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all outline-none"
                                required>
                            <button type="button" onclick="togglePassword('confirmPasswordInput', 'confirmEyeIcon')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors focus:outline-none">
                                <span id="confirmEyeIcon" class="icon-[tabler--eye] size-5"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-center mt-0.5">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="terms"
                                class="checkbox checkbox-xs rounded border-slate-300 checked:border-purple-600 checked:bg-purple-600"
                                required>
                            <span
                                class="text-xs font-semibold text-slate-500 group-hover:text-purple-600 transition-colors">
                                I agree to the <a href="javascript:void(0)" onclick="openModal('privacyModal')"
                                    class="text-purple-600 hover:underline">Privacy Policy</a> & <a
                                    href="javascript:void(0)" onclick="openModal('termsModal')"
                                    class="text-purple-600 hover:underline">Terms</a>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full h-[46px] mt-2 rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-purple-600/20 hover:shadow-purple-600/40 hover:scale-[1.01] active:scale-[0.98] transition-all">
                        Register
                    </button>

                </form>



                <!-- Mobile Footer Link -->
                <div class="mt-6 text-center md:hidden">
                    <p class="text-xs text-slate-500 font-medium">
                        Already a member? <a href="{{ route('login') }}"
                            class="text-purple-600 font-bold hover:underline">Sign In</a>
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
                <!-- Background Image -->
                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop"
                    alt="Library" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">

                <!-- Dark Overlay Gradient -->
                <div class="absolute inset-0 bg-gradient-to-br from-purple-900/90 via-slate-900/90 to-slate-900/95"></div>

                <!-- Decorative Circles -->
                <div class="absolute top-20 -left-20 w-80 h-80 bg-purple-500/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 right-0 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>

                <!-- Content -->
                <div class="relative z-10 flex flex-col items-center gap-5 max-w-sm">
                    <div
                        class="h-20 w-20 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-2xl shadow-purple-900/20 ring-4 ring-white/10">
                        <img src="{{ asset('trackverse.png') }}" class="h-10 w-10 object-contain" alt="TrackVerse App Icon">
                    </div>

                    <h2 class="text-2xl font-bold text-white tracking-tight">Already a Member?</h2>
                    <p class="text-slate-300 text-sm leading-relaxed font-medium">
                        Log in to your portal to access your projects, track progress, and collaborate with your team.
                    </p>

                    <a href="{{ route('login') }}"
                        class="group relative px-6 py-2.5 rounded-lg border-2 border-white/30 text-white font-bold text-xs uppercase tracking-wider hover:bg-white hover:text-purple-900 transition-all duration-300 mt-4 overflow-hidden">
                        <span class="relative z-10 flex items-center gap-2">
                            Sign In
                            <span class="icon-[tabler--arrow-right] group-hover:translate-x-1 transition-transform"></span>
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div id="privacyModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300 ease-out"
        onclick="if(event.target === this) closeModal('privacyModal')">
        <div
            class="bg-white w-full max-w-lg mx-4 rounded-2xl shadow-2xl overflow-hidden transform scale-95 transition-all duration-300 ease-out flex flex-col max-h-[85vh]">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
                <h3 class="text-lg font-bold text-slate-800">Privacy Policy</h3>
                <button type="button" onclick="closeModal('privacyModal')"
                    class="text-slate-400 hover:text-slate-600 transition-colors rounded-full p-1 hover:bg-slate-50">
                    <span class="icon-[tabler--x] size-5"></span>
                </button>
            </div>

            <!-- Content -->
            <div
                class="p-6 overflow-y-auto text-sm text-slate-600 space-y-4 leading-relaxed scrollbar-thin scrollbar-thumb-slate-200 scrollbar-track-transparent">
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-2">Last Updated:
                    {{ date('F j, Y') }}
                </p>
                <p><strong>1. Introduction</strong><br>Welcome to TrackVerse. We value your privacy and are committed to
                    protecting your personal data. This policy outlines how we collect, use, and safeguard your information.
                </p>
                <p><strong>2. Data We Collect</strong><br>We collect information you provide directly, such as your name,
                    email address, and profile data when you register. We may also collect usage data to improve our
                    platform services.</p>
                <p><strong>3. How We Use Your Data</strong><br>Your data is used to provide, maintain, and improve
                    TrackVerse services, communicate with you, and ensure platform security. We do not sell your personal
                    data to third parties.</p>
                <p><strong>4. Data Security</strong><br>We implement robust security measures to protect your data from
                    unauthorized access, alteration, or destruction. However, no internet transmission is completely secure.
                </p>
                <p><strong>5. Your Rights</strong><br>You have the right to access, correct, or delete your personal data.
                    Contact our support team for assistance with these requests.</p>
                <p><strong>6. Contact Us</strong><br>If you have any questions about this Privacy Policy, please contact us
                    at support@trackverse.com.</p>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end shrink-0">
                <button type="button" onclick="closeModal('privacyModal')"
                    class="px-5 py-2 rounded-lg bg-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider hover:bg-slate-300 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div id="termsModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300 ease-out"
        onclick="if(event.target === this) closeModal('termsModal')">
        <div
            class="bg-white w-full max-w-lg mx-4 rounded-2xl shadow-2xl overflow-hidden transform scale-95 transition-all duration-300 ease-out flex flex-col max-h-[85vh]">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
                <h3 class="text-lg font-bold text-slate-800">Terms & Conditions</h3>
                <button type="button" onclick="closeModal('termsModal')"
                    class="text-slate-400 hover:text-slate-600 transition-colors rounded-full p-1 hover:bg-slate-50">
                    <span class="icon-[tabler--x] size-5"></span>
                </button>
            </div>

            <!-- Content -->
            <div
                class="p-6 overflow-y-auto text-sm text-slate-600 space-y-4 leading-relaxed scrollbar-thin scrollbar-thumb-slate-200 scrollbar-track-transparent">
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-2">Last Updated:
                    {{ date('F j, Y') }}
                </p>
                <p><strong>1. Acceptance of Terms</strong><br>By accessing and using TrackVerse, you agree to comply with
                    and be bound by these Terms and Conditions. If you do not agree, please do not use our services.</p>
                <p><strong>2. User Accounts</strong><br>You are responsible for maintaining the confidentiality of your
                    account credentials and for all activities that occur under your account. You must notify us immediately
                    of any unauthorized use.</p>
                <p><strong>3. Use of Services</strong><br>TrackVerse is provided for academic and project management
                    purposes. You agree not to use the platform for any illegal or unauthorized activities.</p>
                <p><strong>4. Content Ownership</strong><br>You retain ownership of the content you submit to TrackVerse.
                    However, you grant us a license to use, store, and display your content as necessary to provide our
                    services.</p>
                <p><strong>5. Termination</strong><br>We reserve the right to suspend or terminate your access to TrackVerse
                    at our sole discretion, without notice, for conduct that we believe violates these Terms.</p>
                <p><strong>6. Changes to Terms</strong><br>We may modify these Terms at any time. Your continued use of the
                    platform after changes constitutes your acceptance of the new Terms.</p>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end shrink-0">
                <button type="button" onclick="closeModal('termsModal')"
                    class="px-5 py-2 rounded-lg bg-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider hover:bg-slate-300 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, eyeIconId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(eyeIconId);

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

        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('opacity-0', 'pointer-events-none');

                const content = modal.firstElementChild;
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('opacity-0', 'pointer-events-none');

                const content = modal.firstElementChild;
                content.classList.remove('scale-100');
                content.classList.add('scale-95');
            }
        }

        // Close on ESC key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeModal('privacyModal');
                closeModal('termsModal');
            }
        });
    </script>
@endsection