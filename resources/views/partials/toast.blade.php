@if(session('success') || session('error') || session('warning') || session('info'))
    <div x-data="{ 
                show: true,
                init() {
                    setTimeout(() => this.show = false, 5000);
                }
            }" x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 transform translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95" class="fixed bottom-6 right-6 z-[9999] w-full max-w-sm"
        @click="show = false">
        <div
            class="bg-base-100 rounded-[2rem] shadow-2xl shadow-black/10 border border-base-content/5 p-4 flex items-center gap-4 cursor-pointer hover:scale-[1.02] transition-transform">
            <div class="shrink-0 size-12 rounded-2xl flex items-center justify-center 
                    {{ session('success') ? 'bg-success/10 text-success' : '' }}
                    {{ session('error') ? 'bg-error/10 text-error' : '' }}
                    {{ session('warning') ? 'bg-warning/10 text-warning' : '' }}
                    {{ session('info') ? 'bg-info/10 text-info' : '' }}
                ">
                @if(session('success'))
                    <span class="icon-[tabler--circle-check] size-6"></span>
                @elseif(session('error'))
                    <span class="icon-[tabler--alert-circle] size-6"></span>
                @elseif(session('warning'))
                    <span class="icon-[tabler--alert-triangle] size-6"></span>
                @else
                    <span class="icon-[tabler--info-circle] size-6"></span>
                @endif
            </div>

            <div class="grow min-w-0">
                <h4 class="text-[11px] font-black uppercase tracking-widest opacity-30 mb-0.5">Notification</h4>
                <p class="text-sm font-bold text-base-content truncate">
                    {{ session('success') ?? session('error') ?? session('warning') ?? session('info') }}
                </p>
            </div>

            <button
                class="size-8 rounded-xl hover:bg-base-200 flex items-center justify-center text-base-content/20 transition-colors">
                <span class="icon-[tabler--x] size-4"></span>
            </button>
        </div>
    </div>
@endif