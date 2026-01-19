<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('trackverse.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme Script -->
    <script type="text/javascript">
        (function () {
            try {
                const root = document.documentElement;
                const savedTheme = localStorage.getItem('theme') || 'system';
                let resolvedTheme = savedTheme;
                if (savedTheme === 'system') {
                    resolvedTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                root.setAttribute('data-theme', resolvedTheme);
            } catch (e) {
                console.warn('Early theme script error:', e);
            }
        })();
    </script>
    @stack('styles')
</head>

<body class="bg-base-200">
    <!-- Layout wrapper - Full Height Screen -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Fixed Navigation Area -->
        @include('layouts.sidebar')

        <!-- Main Content Area - Scrollable Section -->
        <div id="layout-main-container" class="flex flex-col flex-1 min-w-0 h-full overflow-hidden">
            <!-- Header - Sticky Top -->
            @include('layouts.header')

            <!-- Main Content Pane - Independent Scroll -->
            <div class="flex-1 overflow-y-auto overflow-x-hidden custom-scrollbar">
                <main class="w-full max-w-[1440px] px-6 py-8 mx-auto space-y-8">
                    @if (isset($header))
                        <div class="mb-4">
                            {{ $header }}
                        </div>
                    @endif

                    <div class="pb-10">
                        @if(isset($slot))
                            {{ $slot }}
                        @else
                            @yield('content')
                        @endif
                    </div>
                </main>

                <footer class="w-full max-w-[1440px] px-8 py-10 mx-auto border-t border-base-content/5 mt-10">
                    <div class="flex items-center justify-between">
                        <p class="text-base-content/40 font-black uppercase italic tracking-tighter text-[10px]">
                            &copy;{{ date('Y') }} TrackVerse Platform
                        </p>
                        <div class="flex gap-4">
                            <span
                                class="text-[9px] font-black uppercase tracking-widest text-base-content/20">Operational
                                Status: Healthy</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- FlyonUI JavaScript -->


    <script>
        document.addEventListener('submit', function (e) {
            const form = e.target;
            const submitButtons = form.querySelectorAll('button[type="submit"]:not([disabled])');
            if (form.checkValidity && form.checkValidity()) {
                submitButtons.forEach(btn => {
                    btn.disabled = true;
                    if (btn.classList.contains('btn-primary')) {
                        btn.innerHTML = '<span class="loading loading-spinner loading-xs mr-2"></span>Processing...';
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>