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
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                display: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                obsidian: {
                    50: '#f4f4f5',
                    100: '#e4e4e7',
                    200: '#d4d4d8',
                    300: '#a1a1aa',
                    400: '#71717a',
                    500: '#52525b',
                    600: '#3f3f46',
                    700: '#27272a',
                    800: '#18181b',
                    900: '#09090b',
                    950: '#050505',
                },
                gold: {
                    50: '#fffcf2',
                    100: '#fff9e6',
                    200: '#ffefc2',
                    300: '#ffe08a',
                    400: '#f4ba18', // Primary Gold
                    500: '#f4ba18',
                    600: '#d9a110',
                    700: '#b38008',
                    800: '#8c6004',
                    900: '#664402',
                    950: '#402a01',
                }
            }
        },
    },

    plugins: [forms],
};
