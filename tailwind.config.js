import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    
    darkMode: 'class',

    theme: {
        screens: {
            'xs': '20em', // xsmall-width: 20em
            'sm': '30em', // mobile-width: 30em
            'md': '50em', // tablet-width: 50em
            'lg': '64em', // ~1024px - common breakpoint
            'xl': '80em', // ~1280px - common breakpoint
            '2xl': '96em', // ~1536px - common breakpoint
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            // Primary colors - Exact match to SASS $color-primary* variables
            primary: {
                light: '#03d898',
                DEFAULT: '#03a678',
                hover: '#02745f',
                dark: '#014141',
            },
            // Secondary colors - Exact match to SASS $color-secondary* variables
            secondary: {
                light: '#fcb336',
                DEFAULT: '#f07605',
                hover: '#721703',
                dark: '#360302',
            },
            // Grayscale - Exact match to SASS variables
            white: '#FFFFFF',
            'light-gray': '#CCCCCC',
            'mid-gray': '#999999',
            gray: '#666666',
            'dark-gray': '#333333', // Matching $black in SASS
            'true-black': '#000000',
        },
        fontFamily: {
            'display': ['DDC Hardware', ...defaultTheme.fontFamily.sans],
            'mono': ['Roboto Mono', ...defaultTheme.fontFamily.mono],
            'sans': ['Open Sans', ...defaultTheme.fontFamily.sans],
        },
        fontSize: {
            // Match the exact SASS font sizes
            'xs': '0.75rem',
            'sm': '0.875rem',
            'base': '1rem',
            'lg': '1.125rem',
            'xl': '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.6rem', // $font-size-p: 1.6rem
            '4xl': '1.8rem', // $font-size-h6: 1.8rem
            '5xl': '2.2rem', // $font-size-h5: 2.2rem
            '6xl': '2.6rem', // $font-size-h4: 2.6rem
            '7xl': '3.2rem', // $font-size-h3: 3.2rem
            '8xl': '3.6rem', // $font-size-h2: 3.6rem
            '9xl': '4rem',   // $font-size-h1: 4rem
        },
        fontWeight: {
            'light': 300,    // $font-weight-h5: 300
            'normal': 400,   // $font-weight-p, $font-weight-h1, $font-weight-h2: normal
            'bold': 700,
            'extrabold': 800, // $font-weight-h3, $font-weight-h4, $font-weight-h6: 800
        },
        borderRadius: {
            'none': '0px',    // $radius-square: 0px
            DEFAULT: '0.25rem', // common default
            'md': '0.375rem',   // common medium
            'lg': '0.5rem',     // common large
            'xl': '0.75rem',    // common x-large
            'standard': '20px', // $radius-standard: 20px
            'full': '100px',    // $radius-round: 100px
        },
        spacing: {
            // Standard spacing + SASS spacing values
            '0': '0px',
            'px': '1px',
            '0.5': '0.125rem',
            '1': '0.25rem',
            '1.5': '0.375rem',
            '2': '0.5rem',
            '2.5': '0.625rem',
            '3': '0.75rem',
            '3.5': '0.875rem',
            '4': '1rem', // $spacing-xnarrow: 1rem
            '5': '1.25rem',
            '6': '1.5rem',
            '7': '1.75rem',
            '8': '2rem', // $spacing-narrow: 2rem
            '9': '2.25rem',
            '10': '2.5rem',
            '11': '2.75rem',
            '12': '3rem', // $spacing-standard: 3rem
            '14': '3.5rem',
            '16': '4rem', // $spacing-wide: 4rem
            '20': '5rem', // $spacing-xwide: 5rem
            '24': '6rem',
            '28': '7rem',
            '32': '8rem',
            '36': '9rem',
            '40': '10rem',
            '44': '11rem',
            '48': '12rem',
            '52': '13rem',
            '56': '14rem',
            '60': '15rem',
            '64': '16rem',
            '72': '18rem',
            '80': '20rem',
            '96': '24rem',
        },
        extend: {
            lineHeight: {
                'tight': '1.2', // $line-height-h1 through h6: 1.2
                'normal': '1.5', // $line-height-p: 1.5
            },
            boxShadow: {
                // Exact match to SASS shadow variables
                'layer0': '1px 1px 2px rgba(51, 51, 51, 0.6)',
                'layer1': '3px 3px 3px rgba(51, 51, 51, 0.6)',
                'layer2': '5px 5px 4px rgba(51, 51, 51, 0.6)',
                'layer0-inverse': '-1px -1px 2px rgba(51, 51, 51, 0.6)',
                'layer1-inverse': '-3px -3px 3px rgba(51, 51, 51, 0.6)',
                'layer2-inverse': '-5px -5px 4px rgba(51, 51, 51, 0.6)',
            },
            zIndex: {
                // Exact match to SASS z-index variables
                'buried': -1,      // $z-index-burried: -1
                'zero': 0,         // $z-index-zero: 0
                'bottom': 100,     // $z-index-bottom: 100
                'lowest': 200,     // $z-index-lowest: 200
                'lower': 300,      // $z-index-lower: 300
                'low': 400,        // $z-index-low: 400
                'standard': 500,   // $z-index-standard: 500
                'high': 600,       // $z-index-high: 600
                'higher': 700,     // $z-index-higher: 700
                'highest': 800,    // $z-index-highest: 800
                'top': 900,        // $z-index-top: 900
                'nines': 999,      // $z-index-nines: 999
                'spaced': 1000,    // $z-index-spaced: 1000
            },
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        color: theme('colors.dark-gray'),
                        maxWidth: 'none',
                        fontFamily: theme('fontFamily.mono'),
                        fontSize: theme('fontSize.3xl'),
                        fontWeight: theme('fontWeight.normal'),
                        lineHeight: theme('lineHeight.normal'),
                        a: {
                            color: theme('colors.primary.DEFAULT'),
                            textDecoration: 'none',
                            '&:hover': {
                                color: theme('colors.primary.hover'),
                            },
                        },
                        'h1': {
                            fontFamily: theme('fontFamily.display'),
                            fontSize: theme('fontSize.9xl'),
                            color: theme('colors.primary.DEFAULT'),
                            fontWeight: theme('fontWeight.normal'),
                            lineHeight: theme('lineHeight.tight'),
                            marginBottom: '1rem',
                        },
                        'h2': {
                            fontFamily: theme('fontFamily.display'),
                            fontSize: theme('fontSize.8xl'),
                            color: theme('colors.primary.DEFAULT'),
                            fontWeight: theme('fontWeight.normal'),
                            lineHeight: theme('lineHeight.tight'),
                            marginBottom: '1rem',
                        },
                        'h3': {
                            fontFamily: theme('fontFamily.mono'),
                            fontSize: theme('fontSize.7xl'),
                            fontWeight: theme('fontWeight.extrabold'),
                            lineHeight: theme('lineHeight.tight'),
                            margin: '0',
                        },
                        'h4': {
                            fontFamily: theme('fontFamily.mono'),
                            fontSize: theme('fontSize.6xl'),
                            fontWeight: theme('fontWeight.extrabold'),
                            lineHeight: theme('lineHeight.tight'),
                            margin: '0',
                        },
                        'h5': {
                            fontFamily: theme('fontFamily.mono'),
                            fontSize: theme('fontSize.5xl'),
                            fontWeight: theme('fontWeight.light'),
                            lineHeight: theme('lineHeight.tight'),
                            margin: '0',
                        },
                        'h6': {
                            fontFamily: theme('fontFamily.mono'),
                            fontSize: theme('fontSize.4xl'),
                            fontWeight: theme('fontWeight.extrabold'),
                            lineHeight: theme('lineHeight.tight'),
                            margin: '0',
                        },
                        code: {
                            fontFamily: theme('fontFamily.mono'),
                            color: theme('colors.dark-gray'),
                            backgroundColor: theme('colors.light-gray'),
                            borderRadius: theme('borderRadius.standard'),
                            paddingTop: theme('spacing.1'),
                            paddingRight: theme('spacing.2'),
                            paddingBottom: theme('spacing.1'),
                            paddingLeft: theme('spacing.2'),
                        },
                        'code::before': {
                            content: 'none',
                        },
                        'code::after': {
                            content: 'none',
                        },
                        pre: {
                            backgroundColor: theme('colors.light-gray'),
                            color: theme('colors.dark-gray'),
                            borderRadius: theme('borderRadius.standard'),
                        },
                    },
                },
                dark: {
                    css: {
                        color: theme('colors.light-gray'),
                        a: {
                            color: theme('colors.primary.light'),
                            '&:hover': {
                                color: theme('colors.white'),
                            },
                        },
                        'h1, h2, h3, h4, h5, h6': {
                            color: theme('colors.white'),
                        },
                        code: {
                            color: theme('colors.light-gray'),
                            backgroundColor: theme('colors.dark-gray'),
                        },
                        pre: {
                            backgroundColor: theme('colors.dark-gray'),
                            color: theme('colors.light-gray'),
                        },
                    },
                },
            }),
        },
    },

    plugins: [
        forms,
        typography,
    ],
};
