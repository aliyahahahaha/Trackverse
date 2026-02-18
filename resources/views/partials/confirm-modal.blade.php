<!-- Confirmation Modal Component (Theme-Aware) -->
<div id="trackverse-confirm-modal"
    class="fixed inset-0 z-[99999] hidden items-center justify-center p-6 font-sans antialiased overflow-hidden">
    <!-- Backdrop -->
    <div id="confirm-backdrop"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300 opacity-0"></div>

    <!-- Modal Card -->
    <div id="confirm-card"
        class="relative w-full max-w-[440px] bg-base-100 border border-base-content/10 rounded-[40px] p-10 shadow-2xl transition-all duration-300 transform scale-90 opacity-0 text-center">

        <!-- Icon Stage -->
        <div class="relative w-20 h-20 mx-auto mb-8">
            <div class="absolute inset-0 bg-error/10 rounded-full animate-ping opacity-20"></div>
            <div
                class="relative w-20 h-20 bg-error/10 text-error rounded-full flex items-center justify-center border-4 border-base-100 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-10" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 9v4"></path>
                    <path d="M12 17h.01"></path>
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                </svg>
            </div>
        </div>

        <!-- Content -->
        <h3 id="confirm-title" class="text-2xl font-black text-base-content tracking-tight mb-3">Confirm Action</h3>
        <p id="confirm-message" class="text-sm font-medium text-base-content/50 leading-relaxed mb-10">Are you sure you
            want to proceed with this operation?</p>

        <!-- Buttons -->
        <div class="flex gap-4">
            <button id="confirm-cancel"
                class="flex-1 h-14 bg-base-200 hover:bg-base-300 hover:text-white text-base-content/60 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all active:scale-[0.98]">
                Cancel
            </button>
            <button id="confirm-ok"
                class="flex-1 h-14 bg-error text-error-content rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-error/20 hover:shadow-xl hover:shadow-error/30 transition-all active:scale-[0.98]">
                Yes, Confirm
            </button>
        </div>
    </div>
</div>

<script>
    (function () {
        const modal = document.getElementById('trackverse-confirm-modal');
        const card = document.getElementById('confirm-card');
        const backdrop = document.getElementById('confirm-backdrop');
        const titleEl = document.getElementById('confirm-title');
        const messageEl = document.getElementById('confirm-message');
        const okBtn = document.getElementById('confirm-ok');
        const cancelBtn = document.getElementById('confirm-cancel');

        let currentConfirmCallback = null;

        window.showTrackverseConfirm = function (options) {
            titleEl.innerText = options.title || 'Confirm Action';
            messageEl.innerText = options.message || 'Are you sure?';
            okBtn.innerText = options.confirmText || 'Yes, Confirm';
            currentConfirmCallback = options.onConfirm;

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Force reflow
            void modal.offsetWidth;

            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            card.classList.remove('opacity-0', 'scale-90');
            card.classList.add('opacity-100', 'scale-100');
        };

        function closeModal() {
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            card.classList.remove('opacity-100', 'scale-100');
            card.classList.add('opacity-0', 'scale-90');

            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }

        okBtn.onclick = () => {
            if (currentConfirmCallback) currentConfirmCallback();
            closeModal();
        };

        cancelBtn.onclick = closeModal;
        backdrop.onclick = closeModal;

        // Global Interceptor for data-confirm
        document.addEventListener('click', function (e) {
            const trigger = e.target.closest('[data-confirm]');
            if (!trigger) return;

            e.preventDefault();
            const form = trigger.closest('form');

            window.showTrackverseConfirm({
                title: trigger.getAttribute('data-confirm-title') || 'Warning',
                message: trigger.getAttribute('data-confirm') || 'Are you sure?',
                confirmText: trigger.getAttribute('data-confirm-text') || 'Proceed',
                onConfirm: () => {
                    if (form) {
                        // Allow some small timeout for the modal close animation to start
                        setTimeout(() => form.submit(), 100);
                    }
                }
            });
        }, true);
    })();
</script>