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
        fontFamily: {
            sans: ['Poppins', 'sans-serif'],
            serif: ['Poppins', 'serif'],
        },
        extend: {
            colors: {
                primary: '#383838',
                accent: '#FF7D00',
            },
        },
    },
    plugins: [forms],
};
