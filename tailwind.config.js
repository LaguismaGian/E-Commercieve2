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
                // Your Storefront Colors
                'brand-orange': '#F47953', 
                'brand-red':    '#F83737', 
                'hero-bg':      '#F2D9CF', 
                'section-bg':   '#FFF8F8', 
            },
            fontFamily: {
                'sans': ['Inter', 'sans-serif'],
                'serif': ['"Instrument Serif"', 'serif'], // Becomes font-serif
                'inria': ['"Inria Serif"', 'serif'],      // Becomes font-inria
            },
            screens: {
                // extra-small breakpoint used for mobile adjustments in the Admin nav
                'xs': '475px',
            },
            keyframes: {
                // smooth fade-out animation used for the Success/Error Toast Notifications
                fadeOut: {
                    'to': { 
                        opacity: '0', 
                        visibility: 'hidden', 
                        height: '0', 
                        margin: '0', 
                        padding: '0' 
                    },
                }
            },
            animation: {
                'fade-out': 'fadeOut 0.5s ease-out 3s forwards',
            }
        },
    },
    plugins: [],
}