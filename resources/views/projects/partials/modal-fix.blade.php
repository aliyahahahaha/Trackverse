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
        // Ensure FlyonUI modals work correctly
        const modalTriggers = document.querySelectorAll('[data-overlay]');

        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', function (e) {
                e.preventDefault();
                const modalId = this.getAttribute('data-overlay');
                const modal = document.querySelector(modalId);

                if (modal) {
                    // Remove hidden class and add open class
                    modal.classList.remove('hidden');
                    modal.classList.add('open');
                    modal.setAttribute('open', '');

                    // Force reflow to ensure transition works
                    modal.offsetHeight;

                    // Set styles directly as fallback
                    modal.style.opacity = '1';
                    modal.style.visibility = 'visible';
                    modal.style.display = 'flex';

                    // Prevent body scroll
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Handle modal close buttons
        document.addEventListener('click', function (e) {
            const closeBtn = e.target.closest('[data-overlay^="#"]');
            if (closeBtn && closeBtn.closest('.modal')) {
                const modal = closeBtn.closest('.modal');
                modal.classList.remove('open');
                modal.classList.add('hidden');
                modal.removeAttribute('open');
                modal.style.opacity = '';
                modal.style.visibility = '';
                modal.style.display = '';
                document.body.style.overflow = '';
            }
        });

        // Close modal when clicking backdrop
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('overlay') && e.target.classList.contains('modal')) {
                e.target.classList.remove('open');
                e.target.classList.add('hidden');
                e.target.removeAttribute('open');
                e.target.style.opacity = '';
                e.target.style.visibility = '';
                e.target.style.display = '';
                document.body.style.overflow = '';
            }
        });
    });
</script>