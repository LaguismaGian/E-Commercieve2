/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/View/Components/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                'brand-orange': '#F47953', // primary accent – buttons, prices, cart icon, active nav
                'brand-red':    '#F83737', // danger – logout icon
                'hero-bg':      '#F2D9CF', // hero section fallback background
                'section-bg':   '#F5ECEA', // featured products & new designs background
            },
            fontFamily: {
                // main body font
                'sans':  ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                // headings font
                'serif': ['Inria Serif', 'ui-serif', 'Georgia', 'serif'],
            },
        },
    },
    plugins: [],
}