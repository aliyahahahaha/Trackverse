<style>
    /* Fix FlyonUI Modal Opacity Issue */
    .overlay.modal {
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .overlay.modal.open,
    .overlay.modal[open] {
        opacity: 1 !important;
        visibility: visible !important;
    }

    .overlay.modal:not(.open):not([open]) {
        opacity: 0;
        visibility: hidden;
    }

    .overlay.modal .modal-dialog {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .overlay.modal.open .modal-dialog,
    .overlay.modal[open] .modal-dialog {
        opacity: 1 !important;
        transform: scale(1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Helper to find the main scrollable container
        const getScrollContainer = () => document.querySelector('.custom-scrollbar.overflow-y-auto') || document.querySelector('#layout-main-container div.overflow-y-auto');

        // Helper to perform a deep clean of all modal states
        const cleanAllModalStates = () => {
            // Restore scroll
            const scrollContainer = getScrollContainer();
            if (scrollContainer) {
                scrollContainer.style.overflow = '';
            }

            // Remove scroll lock from body/html if library added it
            document.body.classList.remove('overlay-open', 'overflow-hidden');
            document.documentElement.classList.remove('overlay-open', 'overflow-hidden');

            // CRITICAL: Kill ALL types of backdrop elements
            document.querySelectorAll('.hs-overlay-backdrop, .overlay-backdrop, [id$="-backdrop"]').forEach(el => {
                el.remove();
            });
        };

        // Open Logic
        document.addEventListener('click', function (e) {
            const trigger = e.target.closest('[data-overlay]');
            if (!trigger || trigger.closest('.modal')) return; // Ignore if inside modal (usually close btns)

            e.preventDefault();
            e.stopPropagation();

            const modalId = trigger.getAttribute('data-overlay');
            const modal = document.querySelector(modalId);

            if (modal) {
                // If the library JS exists and it's a standard one, let it handle (or force it)
                if (window.HSOverlay && typeof window.HSOverlay.open === 'function') {
                    window.HSOverlay.open(modal);
                }

                // CRITICAL: Remove hidden class and inline styles FIRST
                modal.classList.remove('hidden');
                modal.classList.add('open', 'overlay-open');
                modal.setAttribute('open', '');

                // Then set the display styles (this overrides any previous display:none)
                modal.style.display = 'flex';
                modal.style.opacity = '1';
                modal.style.visibility = 'visible';
                modal.style.pointerEvents = 'auto';
                modal.style.zIndex = '9999';

                const scrollContainer = getScrollContainer();
                if (scrollContainer) {
                    scrollContainer.style.overflow = 'hidden';
                }
            }
        });

        // Close Logic (Universal)
        const closeOverlay = (modal) => {
            if (!modal) return;

            // Try library close first
            if (window.HSOverlay && typeof window.HSOverlay.close === 'function') {
                window.HSOverlay.close(modal);
            }

            modal.classList.remove('open', 'overlay-open');
            modal.classList.add('hidden');
            modal.removeAttribute('open');

            // CRITICAL: Set display to none explicitly (not empty string)
            modal.style.display = 'none';
            modal.style.opacity = '0';
            modal.style.visibility = 'hidden';
            modal.style.pointerEvents = 'none';

            cleanAllModalStates();
        };

        // Handle close triggers
        document.addEventListener('click', function (e) {
            // Only target elements specifically meant to close modals
            const closeTrigger = e.target.closest('[data-close-modal], .modal-close-btn');
            if (closeTrigger) {
                e.preventDefault();
                e.stopPropagation();
                
                const modalId = closeTrigger.getAttribute('data-close-modal');
                let modal = null;
                
                if (modalId) {
                    modal = document.querySelector(modalId);
                } else {
                    // Fallback: find the closest modal parent
                    modal = closeTrigger.closest('.modal');
                }
                
                if (modal) {
                    closeOverlay(modal);
                }
            }
        });

        // Backdrop click
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('overlay') && e.target.classList.contains('modal')) {
                closeOverlay(e.target);
            }
        });

        // ESC key support
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const openModal = document.querySelector('.modal.open, .modal[open], .modal.overlay-open');
                if (openModal) closeOverlay(openModal);
            }
        });
    });
</script>