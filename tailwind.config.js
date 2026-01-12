import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        colors: {
                phoenix: {
                teal: "#00A8B5",
                deep: "#007E88",
                dark: "#0F172A",
                white: "#F8FAFC",
                gray: "#E2E8F0",
                },
            },
        },
    },

    plugins: [forms],
};
