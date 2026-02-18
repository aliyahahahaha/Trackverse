import './bootstrap';
import './theme';
import 'flyonui';
import { HSSelect } from 'flyonui/dist/index.js';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

window.Alpine = Alpine;
window.HSSelect = HSSelect; // Expose HSSelect globally
Alpine.plugin(collapse);
Alpine.start();

// Ensure FlyonUI components are initialized
document.addEventListener('DOMContentLoaded', () => {
    if (window.HSStaticMethods) {
        window.HSStaticMethods.autoInit();
    }
});

