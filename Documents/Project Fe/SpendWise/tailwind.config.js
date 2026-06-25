import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Fredoka"', '"Nunito"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                kpink: '#FFB6D9',
                klavender: '#DCC6FF',
                kblue: '#BFE8FF',
                kmint: '#B9FBC0',
                kpeach: '#FFD6BA',
                kbutter: '#FFF3B0',
                kcream: '#FFFDF8',
                kcard: '#FFFFFF',
                ktext: '#4A4A4A',
            },
            borderRadius: {
                '3xl': '1.5rem',
                '4xl': '2rem',
                '5xl': '2.5rem',
            },
            animation: {
                'float': 'float 4s ease-in-out infinite',
                'bounce-soft': 'bounce-soft 2s ease-in-out infinite',
                'twinkle': 'twinkle 3s ease-in-out infinite',
                'wiggle': 'wiggle 1s ease-in-out infinite',
                'pop': 'pop 0.3s ease-out',
                'slide-up': 'slideUp 0.5s ease-out',
                'fade-in': 'fadeIn 0.5s ease-out',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-8px)' },
                },
                'bounce-soft': {
                    '0%, 100%': { transform: 'translateY(0) scale(1)' },
                    '50%': { transform: 'translateY(-4px) scale(1.02)' },
                },
                twinkle: {
                    '0%, 100%': { opacity: '0.3', transform: 'scale(0.8)' },
                    '50%': { opacity: '1', transform: 'scale(1.1)' },
                },
                wiggle: {
                    '0%, 100%': { transform: 'rotate(0deg)' },
                    '25%': { transform: 'rotate(-5deg)' },
                    '75%': { transform: 'rotate(5deg)' },
                },
                pop: {
                    '0%': { transform: 'scale(0.8)', opacity: '0' },
                    '100%': { transform: 'scale(1)', opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
            },
        },
    },

    plugins: [forms],
};
