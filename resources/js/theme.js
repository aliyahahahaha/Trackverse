/**
 * Theme Manager for TrackVerse
 * Handles System, Light, and Dark modes with OS preference detection.
 */

window.themeManager = {
    // Initialize the theme system
    init() {
        // Check for saved theme or default to system
        const savedTheme = localStorage.getItem('theme') || 'system';
        this.applyTheme(savedTheme);
        this.watchOSPreferences();
        this.updateUIState(savedTheme);
    },

    // Set the theme explicitly (user action)
    setTheme(theme) {
        localStorage.setItem('theme', theme);
        this.applyTheme(theme);
        this.updateUIState(theme);
    },

    // Resolve 'system' to actual 'light' or 'dark' and apply to DOM
    applyTheme(theme) {
        let resolvedTheme = theme;

        if (theme === 'system') {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            resolvedTheme = prefersDark ? 'dark' : 'light';
        }

        document.documentElement.setAttribute('data-theme', resolvedTheme);
    },

    // Listen for OS color scheme changes
    watchOSPreferences() {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            const currentTheme = localStorage.getItem('theme') || 'system';
            if (currentTheme === 'system') {
                this.applyTheme('system');
            }
        });
    },

    // Update the visual state of the theme switcher dropdown
    updateUIState(activeTheme) {
        // Remove active class from all buttons
        document.querySelectorAll('[data-theme-value]').forEach(btn => {
            btn.classList.remove('bg-base-content/5', 'text-primary', 'font-bold');
            btn.classList.add('font-medium');

            // Checkmark logic (if using checkmarks)
            const check = btn.querySelector('.theme-check');
            if (check) check.classList.add('hidden');
        });

        // Add active class to selected button
        const activeBtn = document.querySelector(`[data-theme-value="${activeTheme}"]`);
        if (activeBtn) {
            activeBtn.classList.add('bg-base-content/5', 'text-primary', 'font-bold');
            activeBtn.classList.remove('font-medium');

            const check = activeBtn.querySelector('.theme-check');
            if (check) check.classList.remove('hidden');
        }
    }
};

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    window.themeManager.init();
});

// Expose globally for inline scripts if needed
window.setTheme = (theme) => window.themeManager.setTheme(theme);
