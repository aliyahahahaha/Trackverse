import flyonui from 'flyonui';
import iconify from '@iconify/tailwind4';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './node_modules/flyonui/dist/js/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto'],
            },
        },
    },
    plugins: [
        flyonui,
        iconify,
    ],
    flyonui: {
        themes: [
            {
                light: {
                    primary: '#7e22ce',
                    'primary-content': '#ffffff',
                    secondary: '#9333ea',
                    accent: '#37cdbe',
                    neutral: '#3d4451',
                    'base-100': '#ffffff',
                    info: '#0ca5e9',    /* sky-500 */
                    success: '#10b981', /* emerald-500 */
                    warning: '#f59e0b', /* amber-500 */
                    error: '#ef4444',   /* red-500 */
                },
            },
            {
                dark: {
                    primary: '#a855f7', // Lighter purple for dark mode contrast
                    'primary-content': '#ffffff',
                    secondary: '#c084fc',
                    accent: '#37cdbe',
                    neutral: '#1e293b', // Slate 800
                    'neutral-content': '#f8fafc',
                    'base-100': '#0f172a', // Slate 900
                    'base-200': '#1e293b', // Slate 800 (Cards)
                    'base-300': '#334155', // Slate 700
                    'base-content': '#f8fafc', // Slate 50
                    info: '#3abff8',
                    success: '#36d399',
                    warning: '#fbbd23',
                    error: '#f87272',
                },
            },
        ],
    },
}
