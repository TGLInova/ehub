import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './config/bless-ui.php'
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Parkinsans', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: {
                    100: '#C1D2DD',
                    300: '#397ED3',
                    400: '#23538D',
                    500: '#113A6D',
                    DEFAULT: 'rgb(var(--color-primary))',
                }
            }
        },
    },
    plugins: [],
};
