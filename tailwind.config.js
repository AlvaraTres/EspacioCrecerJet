const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        container: {
            center: true,
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            keyframes: {
                'fade-in-left': {
                    '0%': {
                        opacity: '0',
                        transform: 'translateX(-30px)'
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateX(0)'
                    },
                },
                'fade-in-right': {
                    '0%': {
                        opacity: '0',
                        transform: 'translateX(30px)'
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateX(0)'
                    },
                },
            },
            animation: {
                'fade-in-left' : 'fade-in-left 1.5s ease-out',
                'fade-in-right' : 'fade-in-right 1.5s ease-out',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
        animation: ["motion-safe"],
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
