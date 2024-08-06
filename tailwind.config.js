import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'bg1': "url('/img/bg1.jpg')",
                'bg2': "url('/img/bg2.jpg')",
                'bg3': "url('/img/bg3.jpg')",
                'bg4': "url('/img/bg4.jpg')",
                'bg5': "url('/img/bg5.jpg')",
                'bg6': "url('/img/bg6.jpg')",
                'bg7': "url('/img/bg7.jpg')",
            },
        },
    },

    plugins: [forms, require('flowbite/plugin')({
        charts :true,
    })],
    darkMode: 'media'
};

plugins: [
    require('flowbite/plugin')({
        charts: true,
    }),
    // ... other plugins
  ]
